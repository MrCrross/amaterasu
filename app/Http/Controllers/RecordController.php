<?php

namespace App\Http\Controllers;

use App\Models\Record;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RecordController extends Controller
{
    //

    public function create(Request $request){
        DB::beginTransaction();
        try{
            Record::create([
                'first_name'=>$request->first_name,
                'last_name'=>$request->last_name,
                'phone'=>$request->phone,
                'service_id'=>$request->service_id,
                'status'=>1
            ]);
            DB::commit();
            return response()->json([
                'status'=>'success',
                'message'=>'Спасибо, что оставили заявку. Позже с Вами свяжется нашс отрудник!'
            ]);
        }catch (\Throwable $e){
            DB::rollBack();
            return response()->json([
                'status'=>'error',
                'message'=>$e
            ]);
        }
    }
}
