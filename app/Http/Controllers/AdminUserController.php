<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminUserController extends Controller
{

    public function __construct()
    {
        // this middleware will protect all the bellow method
        $this->middleware('guest:admin')->except('logout');
    }

    public  function  index(){
        return view('admin.login');
    }

    public  function  store(Request $request){

//        dd($request->all());

        // Validate the users input

        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required',

        ]);


        // Loged the User in

        $credentials = $request->only('email','password');

        if (! Auth::guard('admin')->attempt($credentials)){
            return back()->withErrors([
                'message'=> 'Wrong credentials,Please try again'
            ]);
        }

        // Session Messages

        session()->flash('msg','You have been logged in');

        // Redirect
        return redirect('/admin');


    }

    public function logout(){
        auth()->guard('admin')->logout();

        // Show a session message
        session()->flash('msg','You have beeb logged out');

        // Redirect
        return redirect('/admin/login');

    }
}
