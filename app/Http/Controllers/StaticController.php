<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class StaticController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:static-print', ['only' => ['index']]);
    }

    public function index(Request $request)
    {
        $services = new Service();
        $services = Order::with('service')
            ->select(DB::raw('max(service_id) as service_id, COUNT(service_id) AS count'));
        if($request->from!=null){
            $services= $services->where('seance',">=",Carbon::parse($request->from)->format('Y-m-d H:i:s'))
                ->where('seance',"<=",Carbon::parse($request->to)->format('Y-m-d H:i:s'));
        }
        $services=$services ->groupBy('service_id')->get();
        return view('static/index', [
            'services'=>$services,
            "min"=>Carbon::parse(Order::min("seance"))->format('Y-m-d'),
            "max"=>Carbon::parse(Order::max("seance"))->format('Y-m-d'),
        ]);
    }
}
