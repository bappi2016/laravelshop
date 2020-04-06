<?php

namespace App\Http\Controllers;

use App\User;
use App\Order;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public  function index(){
        $users = User::all();
        return view('admin.users.index',compact('users'));
    }



    public function show($id){
        // Find the exact user form exact order

        $orders = Order::where('user_id',$id)->get();
        // Return array back to user details page
        return view('admin.users.details',compact('orders'));
    }
}
