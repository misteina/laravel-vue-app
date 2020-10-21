<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Views extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $path = $request->path();

        if (!Auth::check() && $path === 'todo'){

            return redirect('signin');

        } else if (Auth::check() && ($path === 'signin' || $path === 'signup')) {
            
            return redirect('todo');
        }

        return view($path);
    }
}
