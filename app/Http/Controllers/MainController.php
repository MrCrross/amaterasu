<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class MainController extends Controller
{

    public function index(){
        $services = Service::with('serviceType')
            ->limit(5)
            ->get();
        $offers = Service::with('serviceType')
            ->whereHas('serviceType',function($query){
                return $query->whereIn('id',[1,2]);
            })
            ->get();
        return view('welcome',[
            'services'=>$services,
            'offers'=>$offers,
        ]);
    }

}
