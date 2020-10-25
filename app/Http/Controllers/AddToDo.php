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
            $scheduleTime = $request->input('time', null);

            $errors = [];

            if ($todoTitle === null || empty(trim($todoTitle))){
                array_push($errors, 'No title');
            }
            if (strlen(trim($todoTitle)) > 50){
                $todoTitle = substr($todoTitle, 50).'...';
            }
            if (strlen($todoBody) > 500){
                $todoBody = substr($todoBody, 500).'...';
            }
            if (!ctype_alpha($todoCategory)){
                array_push($errors, 'No category filled');
            }
            if (!$this->validateDate($scheduleTime) || date_create($scheduleTime) > date_create('now')){
                array_push($errors, 'Invalid schedule time');
            }

            if (count($errors) === 0){
                $todo = [
                    $scheduleTime =>
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
                            'JSON_MERGE_PATCH(IFNULL(todo, \'{}\'), \''.
                                json_encode($todo).
                            '\')'
                        )
                    ]
                );

                return response()->json(['success' => 'done']);
            } else {
                return response()->json(['error' => $errors]);
            }
        } else {
            return response()->json(['error' => 'unauthorized']);
        }
    }

    private function validateDate($date, $format = 'Y-m-d H:i') {
        $d = date_create_from_format($format, $date);
        return $d && $d->format($format) === $date;
    }
}
