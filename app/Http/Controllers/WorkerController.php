<?php

namespace App\Http\Controllers;

use App\Http\Requests\Worker\WorkerCreateRequest;
use App\Http\Requests\Worker\WorkerUpdateRequest;
use App\Models\Post;
use App\Models\ServiceType;
use App\Models\User;
use App\Models\Worker;
use App\Models\WorkerService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use Throwable;

class WorkerController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:worker-create', ['only' => ['create', 'store', 'check']]);
        $this->middleware('permission:worker-edit', ['only' => ['edit', 'update', 'check']]);
        $this->middleware('permission:worker-delete', ['only' => ['destroy']]);
    }

    /**
     * @param string $birthday
     * @return false|float
     */
    private function getAge(string $birthday)
    {
        $now = date('Y-m-d');
        return floor((strtotime($now) - strtotime($birthday)) / (60 * 60 * 24 * 365));
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $posts = new Post();
        $posts = $posts->with('workers');
        if (!Auth::check() or in_array('Клиент', Auth::user()->getRoleNames()->toArray())) {
            $posts = $posts->where('name', 'like', '%врач%');
        }
        $posts = $posts->orderBy('name')->get();
        return response()->view('workers.index', [
            'posts' => $posts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $posts = Post::orderBy('name')->get();
        $services = ServiceType::with('services')->whereHas('services', function ($q) {
            return $q->orderBy('services.name');
        })->orderBy('service_types.id')->get();
        $roles = Role::pluck('name', 'name')->all();
        return response()->view('workers.create', [
            'posts' => $posts,
            'services' => $services,
            'roles' => $roles
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param WorkerCreateRequest $request
     * @return RedirectResponse
     */
    public function store(WorkerCreateRequest $request)
    {
        DB::beginTransaction();
        try {
            $url = Storage::disk('public')->put('workers', $request->img);
            $user = User::create([
                'name' => $request->name,
                'password' => Hash::make($request->password),
                'avatar' => 'storage/' . $url
            ]);
            $user->assignRole($request->roles);
            $worker = Worker::create([
                'img' => 'storage/' . $url,
                'last_name' => $request->last_name,
                'first_name' => $request->first_name,
                'birthday' => $request->birthday,
                'description' => $request->description,
                'post_id' => $request->post_id,
                'user_id' => $user->id
            ]);
            if (!is_null($request->services)) {
                foreach ($request->services as $id):
                    WorkerService::create([
                        'service_id' => $id,
                        'worker_id' => $worker->id
                    ]);
                endforeach;
            }
            DB::commit();
            return redirect()->route('workers.create')
                ->with('success', 'Работник <b class="font-bold">' . $worker->name . '</b> добавлен успешно');
        } catch (Throwable $e) {
            DB::rollBack();
            Storage::disk('public')->delete($url);
            return redirect()->route('workers.create')
                ->with('danger', 'Произошла ошибка: ' . $e);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $worker = Worker::with('services', 'post')->where('id', $id)->first();
        $types = ServiceType::with('services')
            ->whereHas('services', function ($q) use ($worker) {
                return $q->whereIn('id', $worker->services->pluck('id')->toArray());
            })
            ->get();
        $age = $this->getAge($worker->birthday);
        return response()->view('workers.show', [
            'worker' => $worker,
            'types' => $types,
            'age' => $age
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $worker = Worker::with('services','post')->where('id',$id)->first();
        $posts = Post::orderBy('name')->get();
        $services = ServiceType::with('services')->whereHas('services', function ($q) {
            return $q->orderBy('services.name');
        })->orderBy('service_types.id')->get();
        return response()->view('workers.edit', [
            'worker'=>$worker,
            'posts' => $posts,
            'services' => $services,
            'activeServices'=>$worker->services->pluck('id')->toArray()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param WorkerUpdateRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(WorkerUpdateRequest $request, int $id)
    {
        DB::beginTransaction();
        try {
            $iWorker = Worker::with('services', 'post')->find($id);
            $data = [
                'last_name' => $request->last_name,
                'first_name' => $request->first_name,
                'description' => $request->description,
                'birthday' => $request->birthday,
                'post_id' => $request->post_id,
            ];
            if (!empty($request->img)) {
                $url = Storage::disk('public')->put('workers', $request->img);
                $data['img'] = 'storage/' . $url;
            }
            $worker = Worker::where('id',$id)->update($data);
            $iServices =$iWorker->services->pluck('id')->toArray();
            if (count(array_diff($iServices, $request->services)) !== 0) {
                WorkerService::where('id', $id)->delete();
                if (!is_null($request->services)) {
                    foreach ($request->services as $idi):
                        WorkerService::create([
                            'service_id' => $idi,
                            'worker_id' => $worker->id
                        ]);
                    endforeach;
                }
            }
            DB::commit();
            Storage::disk('public')->delete($iWorker->img);
            return redirect()->route('workers.edit', $id)
                ->with('success', 'Работник <b class="font-bold">' . $iWorker->name . '</b> изменен успешно');
        } catch (Throwable $e) {
            DB::rollBack();
            if (!empty($url)) Storage::disk('public')->delete($url);
            return redirect()->route('workers.edit', $id)
                ->with('danger', 'Произошла ошибка: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        return DB::transaction(function () use ($id) {
            $user_id = Worker::where('id', $id)->pluck('id')->first();
            WorkerService::where('worker_id', $id)->delete();
            Worker::where('id', $id)->delete();
            User::where('id',$user_id)->delete();
            return redirect()->route('workers.index')
                ->with('success', 'Работник удален успешно');
        });
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function check(Request $request)
    {
        $id = 0;
        if (!is_null($request->id)) {
            $serv = User::where('id', $request->id)->first();
            $id = $serv->id;
        }
        $service = User::where('name', $request->name)->first();
        $message = 'Логин свободен';
        $status = true;
        if (!is_null($service)) {
            $message = 'Логин занят';
            $status = false;
            if ($service->id === $id) {
                $message = '';
            }
        }
        return response()->json([
            'status' => $status,
            'message' => $message
        ]);
    }
}
