<?php

namespace App\Http\Controllers;

use App\Models\Indication;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Throwable;
use Illuminate\Http\Request;

class IndicationController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:indication-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:indication-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:indication-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $data = Indication::orderBy('name')->get();
        return response()->view('indications.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return response()->view('indications.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        return DB::transaction(function () use ($request) {
            Indication::create([
                'name' => $request->name
            ]);
            return redirect()->route('indications.index')
                ->with('success', 'Показание добавлено успешно');
        });
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $indication = Indication::find($id);
        return response()->view('indications.show', compact('indication'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $indication = Indication::find($id);
        return response()->view('indications.edit', compact('indication'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        return DB::transaction(function () use ($request, $id) {
            Indication::where('id', $id)->update([
                'name' => $request->name
            ]);
            return redirect()->route('indications.index')
                ->with('success', 'Показание изменено успешно');
        });
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id)
    {
        DB::beginTransaction();
        try {
            Indication::find($id)->delete();
            DB::commit();
            return redirect()->route('indications.index')
                ->with('success', 'Показание успешно удалено.');
        } catch (Throwable $e) {
            DB::rollBack();
            if ($e->getCode() === '23000') return redirect()->route('indications.index')
                ->with('danger', 'Данное показание используется в услугах. Невозможно удалить.');
            return redirect()->route('indications.index')
                ->with('danger', 'Произошла ошибка: ' . $e->getMessage());
        }
    }
}
