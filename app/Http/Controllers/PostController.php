<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:post-create', ['only' => ['create','store']]);
        $this->middleware('permission:post-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:post-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Post::orderBy('name')->get();
        return response()->view('posts.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->view('posts.create');
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
            Post::create([
                'name'=>$request->name
            ]);
            return redirect()->route('posts.index')
                ->with('success','Должность добавлена успешно');
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
        $post = Post::find($id);
        return response()->view('posts.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        return response()->view('posts.edit',compact('post'));
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
            Post::where('id',$id)->update([
                'name'=>$request->name
            ]);
            return redirect()->route('posts.index')
                ->with('success','Должность изменена успешно');
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
            Post::find($id)->delete();
            DB::commit();
            return redirect()->route('posts.index')
                ->with('success','Должность успешно удалена.');
        }catch (Throwable $e){
            DB::rollBack();
            if($e->getCode() === '23000') return redirect()->route('posts.index')
                ->with('danger','Данную должность занимают сотрудники. Невозможно удалить.');
            return redirect()->route('posts.index')
                ->with('danger','Произошла ошибка: ' .$e->getMessage());
        }
    }
}
