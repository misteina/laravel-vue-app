<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Exception;


class SignUp extends Controller
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

            if ($request->has(['email', 'name', 'password'])){

                $request->flashExcept('password');

                $request->validate([
                    'name' => 'required|min:2|max:30|regex:/^[a-zA-Z ]+$/i',
                    'email' => 'required|email:filter',
                    'password' => 'required|min:5|max:20'
                ]);

                $validatedData = $request->only('email', 'name', 'password');

                $validatedData['password'] = Hash::make($request->password);

                try {
                    $id = DB::table('users')->insertGetId($validatedData);
                } catch (Exception $e){
                    return view('/signup', ['error' => ['Your email exists']]);
                }

                if (is_int($id)){
                    return redirect('/signin')->with('registered', true);
                } else {
                    return view('/signup', ['error' => ['An error was encountered']]);
                }
            } else {
                return redirect('/signup');
            }
        } else {
            return redirect('/todo');
        }
    }
}
