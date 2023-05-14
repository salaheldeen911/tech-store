<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\CartProduct;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\User;
use App\Notifications\NewOrderNotification;
use Illuminate\Support\Facades\Notification;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', auth()->user()->id)
            ->with(["products" => fn ($q) => $q->withTrashed()])
            ->with(["address" => fn ($q) => $q->withTrashed()])
            ->get();

        return view("user.orders")->with("orders", $orders);
    }

    public function userOrders()
    {
        $orders = Order::where('user_id', auth()->user()->id)
            ->with(["products" => fn ($q) => $q->withTrashed()])
            ->with(["address" => fn ($q) => $q->withTrashed()])
            ->get();

        return view("user.orders")->with("orders", $orders);
    }

    public function store()
    {
        $order = Order::create([
            "user_id" => auth()->user()->id,
            "address_id" => auth()->user()->address->id
        ]);

        $cartproducts = CartProduct::where('cart_id', auth()->user()->cart->id);
        $totals = 0;
        $totalItems = 0;

        foreach ($cartproducts->get() as $cartproduct) {
            $product = Product::where('id', $cartproduct->product_id);

            $count = $cartproduct->count;
            $totalPrice = $product->first()->getAttributes()['final_price'] * $count;

            $totals += $totalPrice;
            $totalItems += $count;

            $product->update([
                "quantity" => $product->first()->quantity - $count,
                "sold" => $product->first()->sold + $count
            ]);

            OrderProduct::create([
                "order_id" => $order->id,
                "product_id" => $cartproduct->product_id,
                "count" => $count,
                "total" => $totalPrice
            ]);
        }

        $order->update([
            "total" => $totals,
            "total_items" => $totalItems
        ]);

        $cartproducts->delete();

        $admins = User::role(['super_admin', 'admin'])->get();

        Notification::send($admins, new NewOrderNotification($order));

        return redirect()->route('orders');
    }
}
