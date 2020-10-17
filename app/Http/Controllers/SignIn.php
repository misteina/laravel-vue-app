<?php

namespace App\Http\Controllers;

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

                $validatedData = $request->validate([
                    'email' => 'required|email:filter',
                    'password' => 'required|min:5|max:20'
                ]);

                if (Auth::attempt($validatedData)) {
                    return response()->json(['show' => 'todo']);
                } else {
                    return response()->json(['error' => 'Incorrect email or password']);
                }
            } else {
                return response()->json(['error' => 'Fill your email and password']);
            }
        } else {
            return response()->json(['show' => 'todo']);
        }
    }
}
