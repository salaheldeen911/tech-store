<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\OrderService;
use App\Models\Order;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function showAllOrders(Request $request, OrderService $service)
    {
        if ($request->ajax()) {
            $data = Order::with(["products" => fn ($q) => $q->withTrashed()])
                ->with(["address" => fn ($q) => $q->withTrashed()])
                ->with('user')->orderBy('id', 'DESC')->get();
            // $data = Order::orderBy('id', 'DESC')->get();
            // dd($data);
            return $service->dataTable($data);
        }
    }
    public function index()
    {
        return view("admin.orders.index");
    }

    public function show($id)
    {
        $order = Order::where('id', $id)
            ->with(["products" => fn ($q) => $q->withTrashed()])
            ->with(["address" => fn ($q) => $q->withTrashed()])
            ->with('user')
            ->first();
        return view('admin.orders.show')->with("order", $order);
    }

    public function destroy(Order $order)
    {
        $this->authorize('delete', $order);

        $order->delete();
        return redirect()->route('admin.orders.index');
    }
}
