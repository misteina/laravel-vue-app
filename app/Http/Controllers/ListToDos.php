<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;

class ListToDos extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request) {

        if (Auth::check()){

            $todosFrom = $request->input('from', '2020-10-10 00:00:00');
            $todosTo = $request->input('to', date("Y-m-d 23:59:59"));
            $todosCategory = $request->input('category', 'all');

            if (!$this->validateDate($todosFrom) || !$this->validateDate($todosTo)){
                $todosFrom = '2020-10-10 00:00:00';
                $todosTo = date("Y-m-d 23:59:59");
            }

            if (!ctype_alpha($todosCategory)){
                $todosCategory = 'all';
            }

            $todos = DB::table('user_todos')->select('todo')
                ->where('id', Auth::id())
                ->get();

            $todos = json_decode($todos[0]->todo, true);

            $todoList = [];

            if ($todosCategory !== 'all'){
                foreach ($todos as $time => $todo){
                    $dateFrom = date_create($todosFrom);
                    $dateTo = date_create($todosTo);
                    $addedTime = date_create($time);
                    if ($todosCategory === $todo['category'] && $addedTime >= $dateFrom && $addedTime <= $dateTo){
                        array_push($todoList, [$time => $todo]);
                    }
                }
            } else {
                foreach ($todos as $time => $todo){
                    $dateFrom = date_create($todosFrom);
                    $dateTo = date_create($todosTo);
                    $addedTime = date_create($time);
                    if ($addedTime >= $dateFrom && $addedTime <= $dateTo){
                        array_push($todoList, [$time => $todo]);
                    }
                }
            }

            return response()->json($todoList);

        } else {
            return response()->json(['error' => 'unauthorized']);
        }
    }

    private function validateDate($date, $format = 'Y-m-d H:i:s') {
        $d = date_create_from_format($format, $date);
        return $d && $d->format($format) === $date;
    }
}
