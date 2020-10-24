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

            if ($request->has(['from', 'to', 'category'])){

                $todosFrom = $request->input('from').' 00:00:00';
                $todosTo = $request->input('to').' 23:59:59';
                $todosCategory = $request->input('category');

            } else {
                $todosFrom = date('Y-m-d 00:00:00');
                $todosTo = date("Y-m-d 23:59:59");
                $todosCategory = 'all';
            }

            if (!$this->validateDate($todosFrom) || !$this->validateDate($todosTo) || date_create($todosFrom) > date_create($todosTo) ){
                $todosFrom = '2020-10-10 00:00:00';
                $todosTo = date("Y-m-d 23:59:59");
            }

            if (!ctype_alpha($todosCategory)){
                $todosCategory = 'all';
            }

            $getTodos = DB::table('user_todos')->select('todo')
                ->where('id', Auth::id())
                ->get();

            if (count($getTodos) > 0){
                $todos = json_decode($getTodos[0]->todo, true);

                $todoList = [];
                $categories = [];

                if ($todosCategory !== 'all'){
                    foreach ($todos as $time => $todo){
                        $dateFrom = date_create($todosFrom);
                        $dateTo = date_create($todosTo);
                        $addedTime = date_create($time);
                        if ($todosCategory === $todo['category'] && $addedTime >= $dateFrom && $addedTime <= $dateTo){
                            $todoList[$time] = $todo;
                        }
                        if (!in_array($todo['category'], $categories)){
                            array_push($categories, $todo['category']);
                        }
                    }
                } else {
                    foreach ($todos as $time => $todo){
                        $dateFrom = date_create($todosFrom);
                        $dateTo = date_create($todosTo);
                        $addedTime = date_create($time);
                        if ($addedTime >= $dateFrom && $addedTime <= $dateTo){
                            $todoList[$time] = $todo;
                        }
                        if (!in_array($todo['category'], $categories)){
                            array_push($categories, $todo['category']);
                        }
                    }
                }

                krsort($todoList);

                $data = [$todoList, $categories];

            } else {
                $data = [];
            }

            if ($request->hasHeader('Request-Medium')){
                return response()->json($data);
            } else {
                return view('/todo', ['todoData' => $data]);
            }
        } else {
            return redirect('/signin');
        }
    }

    private function validateDate($date, $format = 'Y-m-d H:i:s') {
        $d = date_create_from_format($format, $date);
        return $d && $d->format($format) === $date;
    }
}
