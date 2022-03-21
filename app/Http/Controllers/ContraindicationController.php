<?php

namespace App\Http\Controllers;

use App\Models\Contraindication;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Throwable;

class ContraindicationController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:contraindication-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:contraindication-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:contraindication-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $data = Contraindication::orderBy('name')->get();
        return response()->view('contraindications.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return response()->view('contraindications.create');
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
            Contraindication::create([
                'name' => $request->name
            ]);
            return redirect()->route('contraindications.index')
                ->with('success', 'Противопоказание добавлено успешно');
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
        $contraindication = Contraindication::find($id);
        return response()->view('contraindications.show', compact('contraindication'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $contraindication = Contraindication::find($id);
        return response()->view('contraindications.edit', compact('contraindication'));
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
            Contraindication::where('id', $id)->update([
                'name' => $request->name
            ]);
            return redirect()->route('contraindications.index')
                ->with('success', 'Противопоказание изменено успешно');
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
            Contraindication::find($id)->delete();
            DB::commit();
            return redirect()->route('contraindications.index')
                ->with('success', 'Противопоказание успешно удалено.');
        } catch (Throwable $e) {
            DB::rollBack();
            if ($e->getCode() === '23000') return redirect()->route('contraindications.index')
                ->with('danger', 'Данное противопоказание используется в услугах. Невозможно удалить.');
            return redirect()->route('contraindications.index')
                ->with('danger', 'Произошла ошибка: ' . $e->getMessage());
        }
    }
}
