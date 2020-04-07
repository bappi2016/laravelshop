<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function index(){
        return view('front.registration.index');
    }

    public function store(Request $request){

        // Validate users input data
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
            'address' => 'required',

        ]);

        // Store the data on database
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'address' => $request->address,
        ]);

        // Show a session Message

        session()->flash('msg','You have successfully registered');

        // Sign the user in
        auth()->login($user);

        // Redirect to the users profile

        return redirect('/user/profile');

    }
}
