<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
//use Illuminate\Support\Facades\Log;
//use Exception;

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

            if ($todoTitle === null){
                return response()->json(['error' => 'No title']);
            }
            if (strlen($todoBody) > 500){
                $todoBody = substr($todoBody, 500).'...';
            }

            DB::table('user_todos')->updateOrInsert(
                ['id' => Auth::id()],
                [
                    'todo' => DB::raw(
                        'JSON_MERGE_PRESERVE(todo,'.json_encode(
                            [
                                date('Y-m-d H:i:s') => [
                                    'title' => $todoTitle, 
                                    'body' => $todoBody,
                                ]
                            ]).
                        ')'
                    )
                ]
            );

            return response()->json(['status' => 'done']);

        } else {
            return response()->json(['show' => 'todo']);
        }
    }
}
