<?php

namespace App\Http\Controllers;

use App\Http\Requests\RecordRequest;
use App\Models\Client;
use App\Models\Order;
use App\Models\Record;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Throwable;

class RecordController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:record-list', ['only' => ['index']]);
        $this->middleware('permission:record-update', ['only' => ['edit', 'update']]);
    }

    public function index()
    {
        return view('records.index', [
            'records' => Record::with('service.workers.post')->get()
        ]);
    }

    public function store(RecordRequest $request)
    {
        if(!is_null(Client::where('phone', $request->phone)->pluck('id')->first())){
            return redirect()->route('main')->with('success', 'Данный номер телефона есть в базе пользователей. Войдите в свою учетную запись.');
        }
        DB::beginTransaction();
        try {
            Record::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'phone' => $request->phone,
                'service_id' => $request->service_id,
            ]);
            DB::commit();
            return redirect()->route('main')->with('success', 'Спасибо, что оставили заявку. Позже с Вами свяжется наш сотрудник!');
        } catch (Throwable $e) {
            DB::rollBack();
            $message = $e->getMessage();
            if ($e->getCode() === '23000')
                $message = 'Заявка Вами уже оставлена. Дождитесь, когда с Вами свяжется сотрудник.';
            return redirect()->route('main')->with('danger', $message);
        }
    }

    public function storeClient(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'service_id' => 'required|numeric'
            ]);
            $client = Client::where('id', $id)->first();
            Record::create([
                'first_name' => $client->first_name,
                'last_name' => $client->last_name,
                'phone' => $client->phone,
                'service_id' => $request->service_id,
            ]);
            DB::commit();
            return redirect()->route('main')->with('success', 'Спасибо, что оставили заявку. Позже с Вами свяжется наш сотрудник!');
        } catch (Throwable $e) {
            DB::rollBack();
            $message = $e->getMessage();
            if ($e->getCode() === '23000')
                $message = 'Заявка Вами уже оставлена. Дождитесь, когда с Вами свяжется сотрудник.';
            return redirect()->route('main')->with('danger', $message);
        }
    }

    /**
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'worker_id' => 'required|numeric',
                'date' => 'required|date',
            ]);
            $data = Record::where('id', $id)->first();
            $client = Client::where('phone', $data->phone)->pluck('id')->first();
            if (is_null($client)) {
                $user = User::create([
                    'name' => 'client' . $id,
                    'password' => Hash::make('client' . $id),
                    'avatar' => 'storage/user.png'
                ]);
                $user->assignRole(Role::where('name', 'Клиент')->pluck('id')->first());
                $client = Client::create([
                    'last_name' => $data->last_name,
                    'first_name' => $data->first_name,
                    'phone' => $data->phone,
                    'user_id' => $user->id
                ]);
                Order::create([
                    'seance' => $request->date . " " . $request->time,
                    'service_id' => $data->service_id,
                    'worker_id' => $request->worker_id,
                    'client_id' => $client->id,
                    'status' => 1
                ]);
                Record::where('id', $id)->delete();
                DB::commit();
                return redirect()->route('records.index')->with('success', 'login:' . 'client' . $id . ';password:' . 'client' . $id . ';');
            } else {
                Order::create([
                    'seance' => $request->date . " " . $request->time,
                    'service_id' => $data->service_id,
                    'worker_id' => $request->worker_id,
                    'client_id' => $client,
                    'status' => 1
                ]);
                Record::where('id', $id)->delete();
                DB::commit();
                return redirect()->route('records.index')->with('success', 'Запись произошла успешно');
            }
        } catch (Throwable $e) {
            DB::rollBack();
            return redirect()->route('records.index')->with('danger', $e->getMessage());
        }
    }

}
