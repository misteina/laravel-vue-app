<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Schedule extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        if ($request->expectsJson()){
            
        } else {
            return redirect()->route('signin');
        }
    }
}
