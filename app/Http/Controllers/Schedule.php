<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;

class Schedule extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request) {

        if (Auth::check()){

            if ($request->isMethod('get')){

                $todosFrom = $request->input('from', date("Y-m-d 00:00:00"));
                $todosTo = $request->input('to', date("Y-m-d 23:59:59"));
                $todosCategory = $request->input('category', 'all');

                if (!$this->validateDate($todosFrom) || !$this->validateDate($todosTo)){
                    $todosFrom = date("Y-m-d 00:00:00");
                    $todosTo = date("Y-m-d 23:59:59");
                }

                if (!ctype_alpha($scheduleType)){
                    $todosCategory = 'all';
                }

                if ($todosCategory === 'all'){

                    $todoList = DB::table('schedules')->select('title','body')
                        ->where('id', Auth::id())
                        ->where('todosFrom','>=',$todosFrom)
                        ->where('todosTo','<=',$todosTo)
                        ->orderBy('time', 'asc')
                        ->get();
                } else { 
                    $todoList = DB::table('schedules')->select('title','body')
                        ->where('id', Auth::id())
                        ->where('todosCategory', $todosCategory)
                        ->where('todosFrom','>=', $todosFrom)
                        ->where('todosTo','<=', $todosTo)
                        ->orderBy('time', 'asc')
                        ->get();
                }

                return response()->json($todoList);

            } else if ($request->isMethod('post')) {

                $todoTitle = $request->input('title', null);
                $todoBody = $request->input('body', 'No body');

                if ($todoTitle === null){
                    return response()->json(['error' => 'No title']);
                }
                if (strlen($todoBody) > 500){
                    $todoBody = substr($todoBody, 500).'...';
                }

                DB::table('schedules')->updateOrInsert(
                    [
                        'id' => Auth::id(),
                        'todo' => DB::raw(
                            'JSON_MERGE_PRESERVE(todo,'.json_encode(
                                [
                                    'title' => $todoTitle, 
                                    'body' => $todoBody,
                                    'time' => date('Y-m-d H:i:s')
                                ]).
                            ')'
                        )
                    ]
                );

                return response()->json(['status' => 'done']);
            } else {
                return response()->json(['error' => 'Bad request']);
            }
        } else {
            return response()->json(['show' => 'schedule']);
        }
    }

    private function validateDate($date, $format = 'Y-m-d H:i:s') {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) === $date;
    }
}
