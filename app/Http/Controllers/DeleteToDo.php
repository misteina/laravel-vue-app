<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DeleteToDo extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request) {

        if (Auth::check()){

            $todoId = $request->input('id', null);

            if (!$this.validateDate($todoId)){
                return response()->json(['error' => 'No Id']);
            }

            DB::table('user_todos')
                ->where('id', Auth::id())
                ->update(['todo' => DB::raw('JSON_MERGE_PATCH(todo, {"'.$todoId.'": null})')]
            );

            return response()->json(['status' => 'done']);
            
        } else {
            return response()->json(['show' => 'todo']);
        }
    }

    private function validateDate($date, $format = 'Y-m-d H:i:s') {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) === $date;
    }
}
