<?php

namespace App\Http\Controllers;

use App\Http\Requests\Service\ServiceRequest;
use App\Http\Requests\Service\ServiceUpdateRequest;
use App\Models\Contraindication;
use App\Models\Indication;
use App\Models\Service;
use App\Models\ServiceContraindication;
use App\Models\ServiceIndication;
use App\Models\ServiceType;
use App\Models\Worker;
use App\Models\WorkerService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Throwable;

class ServiceController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:service-create', ['only' => ['create', 'store', 'check']]);
        $this->middleware('permission:service-edit', ['only' => ['edit', 'update','check']]);
        $this->middleware('permission:service-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $types = ServiceType::with('services')
            ->whereHas('services', function ($q) {
                return $q->orderBy('services.name');
            })
            ->orderBy('id')->get();

        return response()->view('services/index', [
            'types' => $types
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $types = ServiceType::orderBy('name')->get();
        $indications = Indication::orderBy('name')->get();
        $contraindications = Contraindication::orderBy('name')->get();
        $workers = Worker::with('post')
            ->whereHas('post',function ($q){
            return $q->where('name', 'like', '%врач%');
        })
            ->orderBy('last_name')->get();
        return response()->view('services/create', [
            'types' => $types,
            'indications' => $indications,
            'contraindications' => $contraindications,
            'workers' => $workers,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(ServiceRequest $request)
    {
        DB::beginTransaction();
        try {
            $url = Storage::disk('public')->put('services', $request->img);
            $service = Service::create([
                'img' => 'storage/' . $url,
                'name' => $request->name,
                'price' => $request->price,
                'description' => $request->description,
                'service_type_id' => $request->service_type_id
            ]);
            if (!is_null($request->indications)) {
                foreach ($request->indications as $id):
                    ServiceIndication::create([
                        'service_id' => $service->id,
                        'indication_id' => $id
                    ]);
                endforeach;
            }
            if (!is_null($request->contraindications)) {
                foreach ($request->contraindications as $id):
                    ServiceContraindication::create([
                        'service_id' => $service->id,
                        'contraindication_id' => $id
                    ]);
                endforeach;
            }
            if (!is_null($request->workers)) {
                foreach ($request->workers as $id):
                    WorkerService::create([
                        'service_id' => $service->id,
                        'worker_id' => $id
                    ]);
                endforeach;
            }
            DB::commit();
            return redirect()->route('services.create')
                ->with('success', 'Услуга <b class="font-bold">' . $service->name . '</b> добавлена успешно');
        } catch (Throwable $e) {
            DB::rollBack();
            Storage::disk('public')->delete($url);
            if ($e->getCode() === '23000') {
                return redirect()->route('services.create')
                    ->with('danger', 'Услуга с таким названием уже существует.');
            }
            return redirect()->route('services.create')
                ->with('danger', 'Произошла ошибка: ' . $e->getMessage());
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
        $service = Service::with('serviceType', 'workers.post', 'contraindications', 'indications')
            ->where('id', $id)->first();
        return response()->view('services/show', [
            'service' => $service,
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
        $service = Service::with('serviceType', 'workers.post', 'contraindications', 'indications')->where('id', $id)->first();
        $types = ServiceType::orderBy('name')->get();
        $indications = Indication::orderBy('name')->get();
        $contraindications = Contraindication::orderBy('name')->get();
        $workers = Worker::with('post')
            ->whereHas('post',function ($q){
                return $q->where('name', 'like', '%врач%');
            })
            ->orderBy('last_name')->get();
        return response()->view('services/edit', [
            'service' => $service,
            'types' => $types,
            'indications' => $indications,
            'contraindications' => $contraindications,
            'workers' => $workers,
            'activeIndications' => $service->indications->pluck('id')->toArray(),
            'activeContraindications' => $service->contraindications->pluck('id')->toArray(),
            'activeWorkers' => $service->workers->pluck('id')->toArray(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(ServiceUpdateRequest $request, int $id)
    {
        DB::beginTransaction();
        try {
            $iService = Service::with('indications', 'contraindications', 'workers')->find($id);
            $data = [
                'name' => $request->name,
                'price' => $request->price,
                'description' => $request->description,
                'service_type_id' => $request->service_type_id
            ];
            if (!empty($request->img)) {
                $url = Storage::disk('public')->put('services', $request->img);
                $data['img'] = 'storage/' . $url;
            }
            $service = Service::where('id', $id)->update($data);
            $iIndications = $iService->indications->pluck('id')->toArray();
            $iContraindications = $iService->contraindications->pluck('id')->toArray();
            $iWorkers = $iService->workers->pluck('id')->toArray();
            if (count(array_diff($iIndications, $request->indications)) !== 0) {
                ServiceIndication::where('id', $id)->delete();
                if (!is_null($request->indications)) {
                    foreach ($request->indications as $idi):
                        ServiceIndication::create([
                            'service_id' => $service->id,
                            'indication_id' => $idi
                        ]);
                    endforeach;
                }
            }
            if (count(array_diff($iContraindications, $request->contraindications)) !== 0) {
                ServiceContraindication::where('id', $id)->delete();
                if (!is_null($request->contraindications)) {
                    foreach ($request->contraindications as $idi):
                        ServiceContraindication::create([
                            'service_id' => $service->id,
                            'contraindication_id' => $idi
                        ]);
                    endforeach;
                }
            }
            if (count(array_diff($iWorkers, $request->workers)) !== 0) {
                WorkerService::where('id', $id)->delete();
                if (!is_null($request->workers)) {
                    foreach ($request->workers as $idi):
                        WorkerService::create([
                            'service_id' => $service->id,
                            'worker_id' => $idi
                        ]);
                    endforeach;
                }
            }
            DB::commit();
            Storage::disk('public')->delete($iService->img);
            return redirect()->route('services.edit', $id)
                ->with('success', 'Услуга <b>' . $iService->name . '</b> изменено успешно');
        } catch (Throwable $e) {
            DB::rollBack();
            if (!empty($url)) Storage::disk('public')->delete($url);
            if ($e->getCode() === '23000') {
                return redirect()->route('services.edit', $id)
                    ->with('danger', 'Услуга с таким названием уже существует.');
            }
            return redirect()->route('services.edit', $id)
                ->with('danger', 'Произошла ошибка: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        return DB::transaction(function () use ($id) {
            ServiceIndication::where('service_id', $id)->delete();
            ServiceContraindication::where('service_id', $id)->delete();
            WorkerService::where('service_id', $id)->delete();
            Service::where('id', $id)->delete();
            return redirect()->route('services.index')
                ->with('success', 'Услуга удалена успешно');
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
            $serv = Service::where('id', $request->id)->first();
            $id = $serv->id;
        }
        $service = Service::where('name', $request->name)->first();
        $message = 'Название свободно';
        $status = true;
        if (!is_null($service)) {
            $message = 'Такая услуга уже существует';
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
