<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Products;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //

    public function create(Request $request) {
        $order = Order::create([
            'id_ptvc' => $request->id_ptvc,
            'id_pttt' => $request->id_pttt,
            'id_user' => $request->id_user,
            'status' => $request->status,
            'datetime' => $request->datetime,
            'amount' => $request->amount,
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address
        ]);


        foreach($request->item as $item ){
            $orderdetails = OrderDetails::create([
                'id_product' => $item['id_product'],
                'id_order' => $order->id,
                'price' => $item['price'],
                'quantity' => $item['quantity']
            ]);
        }


        return response()->json([
            "message" => "success",
            "statusCode" => 200,
            "data" => $order
        ]);
    }

    public function getOrderByUser(string $id) {
        $order = Order::where("id_user", "=", $id)->get();
        return response()->json($order);
    }


    public function getOrderByID(string $id) {
        $order = Order::where("id", "=", $id)->first();

        $details = OrderDetails::where("id_order", "=", $order->id)->get();

        $details = $details->map(function ($item) {
            return [
                'product' => Products::where("id", "=", $item->id_product)->first(),
                'qty' => $item->quantity
             ] ;
        });

        return response()->json([
            "order" => $order,
            "details" => $details
        ]);
    }


    public function getAllOrder() {
        $orders = Order::all();
        return view("order", compact('orders'));
    }
}
