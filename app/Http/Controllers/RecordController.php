<?php

namespace App\Http\Controllers;

use App\Http\Requests\RecordRequest;
use App\Mail\Account;
use App\Models\Client;
use App\Models\Order;
use App\Models\Record;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
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
                'email' => $request->email,
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
                'email' => $client->email,
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
            $password = $this->gen_password();
            if (is_null($client)) {
                $user = User::create([
                    'name' => 'client' . $id,
                    'password' => Hash::make($password),
                    'avatar' => 'storage/user.png'
                ]);
                $user->assignRole(Role::where('name', 'Клиент')->pluck('id')->first());
                $client = Client::create([
                    'last_name' => $data->last_name,
                    'first_name' => $data->first_name,
                    'email' => $data->email,
                    'phone' => $data->phone,
                    'user_id' => $user->id
                ]);
                $order = Order::create([
                    'seance' => $request->date . " " . $request->time,
                    'service_id' => $data->service_id,
                    'worker_id' => $request->worker_id,
                    'client_id' => $client->id,
                    'status' => 1
                ]);
                $mailData = (object)[
                    'email'=>$data->email,
                    'login'=>'client' . $id,
                    'password'=>$password,
                    'seance'=>$order->seance,
                ];
                Mail::to($data->email)->send(new Account($mailData));
                Record::where('id', $id)->delete();
                DB::commit();
                return redirect()->route('records.index')->with('success', 'Запись произошла успешно. Личный кабинет пользователя создан. Данные для входа отправлены на указанную почту.');
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

    private function gen_password($length = 6)
    {
        $chars = 'qazxswedcvfrtgbnhyujmkiolp1234567890QAZXSWEDCVFRTGBNHYUJMKIOLP';
        $size = strlen($chars) - 1;
        $password = '';
        while($length--) {
            $password .= $chars[random_int(0, $size)];
        }
        return $password;
    }
}
