<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
//use Illuminate\Support\Facades\Log;
use Exception;

class AddToDo extends Controller {
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request) {

        if (Auth::check()){

            $todoTitle = $request->input('title', null);
            $todoBody = $request->input('body', 'No body');
            $todoCategory = $request->input('category', 'other');

            if ($todoTitle === null || empty(trim($todoTitle))){
                return response()->json(['error' => 'No title']);
            }
            if (strlen(trim($todoTitle)) > 50){
                $todoTitle = substr($todoTitle, 50).'...';
            }
            if (strlen($todoBody) > 500){
                $todoBody = substr($todoBody, 500).'...';
            }
            if (!ctype_alpha($todoCategory)){
                return response()->json(['error' => 'No category']);
            }

            try {
                DB::table('user_todos')->updateOrInsert(
                    ['id' => Auth::id()],
                    [
                        'todo' => '{"time":{"title":"My title","body":"Todo details","category":"other"}}'
                    ]
                );
            } catch (Exception $e) {
                return response()->json(['error' => $e->getMessage()]);
            }

            return response()->json(['success' => 'done']);

        } else {
            return response()->json(['show' => 'todo']);
        }
    }
}
