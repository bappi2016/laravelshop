<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;

class OrderController extends Controller
{
    public function index(){
        $orders = Order::all();
        return view('admin.orders.index',compact('orders'));
    }

    public  function show($id){
        $order = Order::find($id);
        return view('admin.orders.details',compact('order'));
    }

    public function  confirm($id){

        // Find the order
        $order = Order::find($id);

        // Update the order
        $order->update(['status'=>1]);

        // Send a session message
        session()->flash('msg','The order has been updated to Confirmed' );

        // Redirect
        return redirect('admin/orders');


    }

    public  function  pending($id){

        // Find the order
        $order = Order::find($id);

        // Update the order
        $order->update(['status'=>0]);

        // Send a session message
        session()->flash('msg','The order has been updated to Pending' );

        // Redirect
        return redirect('admin/orders');
    }
}
