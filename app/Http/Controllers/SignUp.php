<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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

            if ($request->has(['name', 'email', 'password'])){

                $validatedData = $request->validate([
                    'name' => 'required|min:2|max:30|regex:/^a-zA-Z\s/i',
                    'email' => 'required|email:filter',
                    'password' => 'required|min:5|max:20'
                ]);

                $validatedData['password'] = Hash::make($request->password);
                
                try {
                    DB::table('users')->insert($validatedData);
                } catch(Exception $e) {
                    //Log::error($e->getMessage());
                    return response()->json(['error' => $e->getMessage()]);
                }

                return response()->json(['show' => 'schedule']);
            } else {
                return response()->json(['error' => 'Fill the form completely']);
            }
        } else {
            return response()->json(['show' => 'schedule']);
        }
    }
}
