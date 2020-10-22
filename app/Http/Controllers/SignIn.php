<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SignIn extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        if (!Auth::check()){

            if ($request->has(['email', 'password'])){

                $request->flashExcept('password');

                $validatedData = $request->validate([
                    'email' => 'required|email:filter',
                    'password' => 'required|min:5|max:20'
                ]);

                if (Auth::attempt($validatedData)) {
                    return redirect('/todo');
                } else {
                    return view('signin', ['error' => ['Incorrect email or password']]);
                }
            } else {
                return redirect('/signin');
            }
        } else {
            return redirect('/todo');
        }
    }
}
