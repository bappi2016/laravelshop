<?php

namespace App\Http\Controllers;

use App\Order;
use App\Product;
use App\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // create a middleware to login the admin user panel
    public function __construct()
    {
        $this->middleware('auth:admin');
    }



    public function index()
    {
        # code...
        $product = new Product();
        $order = new Order();
        $user = new User();
        return view('admin.dashboard',compact('product','order','user'));
    }
}
