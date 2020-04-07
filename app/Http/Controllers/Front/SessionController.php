<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SessionController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest')->except('logout'); // when a user is logged in , add guest middle were, so then dont go to login page agin
    }


    public function index(){
        return view('front.sessions.index');
    }

    public  function  store(Request $request){

        // First validate users input
        $validatedData = $request->validate([

            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Check if the user is exist
        $data = request(['email','password']);
        // if user didn't have right credentials
        if ( ! auth()->attempt($data) ){
            return back()->withErrors([
                'message' => 'Wrong Credentials , Please try again'
            ]);
        }

        // else
        return redirect('/user/profile');

    }

    public function logout(){
        auth()->logout();

        session()->flash('msg','You have successfully logged out');

        return redirect('user/login');
    }
}
