<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
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
            $todoCategory = $request->input('category', 'other');

            if ($todoTitle === null || empty(trim($todoTitle))){
                return response()->json(['error' => 'No title']);
            }
            if (strlen($todoBody) > 500){
                $todoBody = substr($todoBody, 500).'...';
            }
            if (!ctype_alpha($todoCategory)){
                return response()->json(['error' => 'No category']);
            }

            DB::table('user_todos')->updateOrInsert(
                ['id' => Auth::id()],
                [
                    'todo' => DB::raw(
                        'JSON_MERGE_PRESERVE(IFNULL(todo, \'[]\'),'.json_encode(
                            [
                                date('Y-m-d H:i:s') => [
                                    'category' => $todoCategory,
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
