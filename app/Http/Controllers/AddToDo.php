<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
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

            $todo = [
                        date('Y-m-d H:i:s') =>
                        [
                            'title' => $todoTitle,
                            'body' => $todoBody,
                            'category'=> ucfirst(strtolower($todoCategory))
                        ]
                    ];

            DB::table('user_todos')->updateOrInsert(
                ['id' => Auth::id()],
                [
                    'todo' => DB::raw(
                        'JSON_MERGE_PRESERVE(IFNULL(todo, \'[]\'), \''.
                            json_encode($todo).
                        '\')'
                    )
                ]
            );

            if (App::environment('testing')) {
                $todos = DB::table('user_todos')->select('todo')
                    ->where('id', Auth::id())
                    ->get();

                return response()->json(['todos' => $todos]);
            }

            return response()->json([$todo]);

        } else {
            return response()->json(['error' => 'unauthorized']);
        }
    }
}
