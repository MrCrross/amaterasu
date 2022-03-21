<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Client;
use App\Models\Order;
use App\Models\Service;
use App\Models\Worker;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;

class OrderController extends Controller
{

    public function __construct()
    {

        $this->middleware('permission:order-list|order-create|order-edit|order-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:order-client-list', ['only' => ['record']]);
        $this->middleware('permission:order-worker-list', ['only' => ['schedule', 'close']]);
        $this->middleware('permission:order-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:order-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:order-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $orders = Order::with('client', 'worker.post', 'service')->where('status', 1)->orderBy('seance')->get();
        return response()->view('orders.index', [
            'orders' => $orders
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $clients = Client::orderBy('last_name')->get();
        $workers = Worker::with('post')->whereHas('post', function ($q) {
            return $q->where('name', 'like', '%врач%');
        })->orderBy('last_name')->get();
        $services = Service::orderBy('name')->get();
        return response()->view('orders.create', [
            'clients' => $clients,
            'workers' => $workers,
            'services' => $services
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(OrderRequest $request)
    {
        DB::beginTransaction();
        try {
            Order::create([
                'client_id' => $request->client_id,
                'worker_id' => $request->worker_id,
                'service_id' => $request->service_id,
                'seance' => $request->date . " " . $request->time,
            ]);
            DB::commit();
            return redirect()->route('orders.create')->with('success', 'Запись произведена успешна');
        } catch (Throwable $e) {
            DB::rollBack();
            return redirect()->route('orders.create')->with('danger', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $order = Order::with('client', 'worker.post', 'service')
            ->where('id', $id)
            ->first();
        return response()->view('orders.show', [
            'order' => $order
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $order = Order::with('client', 'worker.post', 'service')
            ->where('id', $id)
            ->first();
        $clients = Client::orderBy('last_name')->get();
        $workers = Worker::with('post')->whereHas('post', function ($q) {
            return $q->where('name', 'like', '%врач%');
        })->orderBy('last_name')->get();
        $services = Service::orderBy('name')->get();
        return response()->view('orders.edit', [
            'order' => $order,
            'clients' => $clients,
            'workers' => $workers,
            'services' => $services
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param OrderRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(OrderRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            Order::where('id', $id)->update([
                'seance' => $request->date . " " . $request->time,
                'service_id' => $request->service_id,
                'worker_id' => $request->worker_id,
                'client_id' => $request->client_id,
            ]);
            DB::commit();
            return redirect()->route('records.index')->with('success', 'Запись изменена успешна');
        } catch (Throwable $e) {
            DB::rollBack();
            return redirect()->route('records.index')->with('danger', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        $order = Order::where('id', $id)->first();
        Order::where('id', $id)->delete();
        return redirect()->route('orders.index')->with('success', 'Запись на ' . $order->seance . " отменена");
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function close($id)
    {
        Order::where('id', $id)->update([
            'status' => 2
        ]);
        $order = Order::where('id', $id)->first();
        if(in_array('Врач',Auth::user()->getRoleNames()->toArray()))
            return redirect()->route('orders.schedule',$id)->with('success', 'Запись на ' . $order->seance . " выполнена");
        return redirect()->route('orders.index')->with('success', 'Запись на ' . $order->seance . " выполнена");
    }

    /**
     * @param $id
     * @return Response
     */
    public function record($id)
    {
        $orders = Order::where('client_id', $id)->where('status',1)->orderBy('seance')->get();
        return response()->view('orders.my', [
            'orders' => $orders
        ]);
    }

    /**
     * @param $id
     * @return Response
     */
    public function schedule($id)
    {
        $orders = Order::where('worker_id', $id)->where('status',1)->orderBy('seance')->get();
        return response()->view('orders.my', [
            'orders' => $orders
        ]);
    }
}
