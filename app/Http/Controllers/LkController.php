<?php

namespace App\Http\Controllers;

use App\Http\Requests\LkRequest;
use App\Models\Client;
use App\Models\User;
use App\Models\Worker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Throwable;

class LkController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $authUser = User::find($id);
        $user = null;
        $roles = $authUser->getRoleNames()->toArray();
        if (in_array('Врач', $roles) or in_array('Приемная', $roles)) {
            $user = Worker::with('user', 'post')->where('user_id', $id)->first();
        }
        if (in_array('Клиент', $roles)) {
            $user = Client::with('user')->where('user_id', $id)->first();
        }
        return response()->view('lk.index', ['auth' => $authUser, 'user' => $user]);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $authUser = User::find($id);
        $user = null;
        $roles = $authUser->getRoleNames()->toArray();
        if (in_array('Врач', $roles) or in_array('Приемная', $roles)) {
            $user = Worker::with('user', 'post')->where('user_id', $id)->first();
        }
        if (in_array('Клиент', $roles)) {
            $user = Client::with('user')->where('user_id', $id)->first();
        }
        return response()->view('lk.edit', ['auth' => $authUser, 'user' => $user]);
    }

    public function update(LkRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $user = User::where('id',$id)->with('clients','workers')->first();
            $dataUser=[
                'name'=>$request->name
            ];
            if(!is_null($request->password)){
                $dataUser['password'] =  Hash::make($request->password);
            }
            if(!is_null($request->avatar)){
                Storage::disk('public')->delete($user->avatar);
                $url = Storage::disk('public')->put('users', $request->avatar);
                $dataUser['avatar'] =  'storage/'.$url;
            }
            User::where('id',$id)->update($dataUser);
            $data =[];
            if(!is_null($request->last_name)){
                $data['last_name']=$request->last_name;
                $data['first_name']=$request->first_name;
            }
            if(!is_null($request->img)){
                Storage::disk('public')->delete($user->workers[0]->img);
                $url = Storage::disk('public')->put('workers', $request->img);
                $data['img'] =  'storage/'.$url;
            }
            if(!is_null($request->birthday)){
                $data['birthday']=$request->birthday;
            }
            if(!is_null($request->phone)){
                $data['phone']=$request->phone;
            }
            if(count($user->clients)!==0){
                Client::where('user_id',$id)->update($data);
            }
            if(count($user->workers)!==0){
                Worker::where('user_id',$id)->update($data);
            }
            DB::commit();
            return redirect()->route('lk.index',$id)
                ->with('success', 'Личные данные успешно изменены.');
        } catch (Throwable $e) {
            DB::rollBack();
            return redirect()->route('lk.index',$id)
                ->with('danger', 'Произошла ошибка: ' . $e->getMessage());
        }
    }
}
