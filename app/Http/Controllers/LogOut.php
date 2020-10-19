<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogOut extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        Auth::logout();
        if (Auth::check()){
            return response()->json(['error' => 'failed']);
        } else {
            return redirect('signin');
        }
    }
}
