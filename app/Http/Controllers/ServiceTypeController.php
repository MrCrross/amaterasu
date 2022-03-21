<?php

namespace App\Http\Controllers;

use App\Models\ServiceType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class ServiceTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:type-create', ['only' => ['create','store']]);
        $this->middleware('permission:type-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:type-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = ServiceType::orderBy('name')->get();
        return response()->view('types.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->view('types.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|string|max:255'
        ]);

        return DB::transaction(function () use($request){
            ServiceType::create([
                'name'=>$request->name
            ]);
            return redirect()->route('types.index')
                ->with('success','Тип услуги добавлен успешно');
        });
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $type = ServiceType::find($id);
        return response()->view('types.show',compact('type'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $type = ServiceType::find($id);
        return response()->view('types.edit',compact('type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=>'required|string|max:255'
        ]);

        return DB::transaction(function () use($request,$id){
            ServiceType::where('id',$id)->update([
                'name'=>$request->name
            ]);
            return redirect()->route('types.index')
                ->with('success','Тип услуги изменен успешно');
        });
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $id)
    {
        DB::beginTransaction();
        try{
            ServiceType::find($id)->delete();
            DB::commit();
            return redirect()->route('types.index')
                ->with('success','Тип услуги успешно удален.');
        }catch (Throwable $e){
            DB::rollBack();
            if($e->getCode() === '23000') return redirect()->route('types.index')
                ->with('danger','Данный тип услуги занимают услуги. Невозможно удалить.');
            return redirect()->route('types.index')
                ->with('danger','Произошла ошибка: ' .$e->getMessage());
        }
    }
}
