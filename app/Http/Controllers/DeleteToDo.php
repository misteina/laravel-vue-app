<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;

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

            if (!$this->validateDate($todoId)){
                return response()->json(['error' => 'No Id']);
            }

            DB::table('user_todos')
                ->where('id', Auth::id())
                ->update(['todo' => DB::raw('JSON_MERGE_PATCH(todo, \'{"'.$todoId.'": null}\')')]);

            return response()->json(['success' => 'done']);
            
        } else {
            return response()->json(['error' => 'unauthorized']);
        }
    }

    private function validateDate($date, $format = 'Y-m-d H:i:s') {
        $d = date_create_from_format($format, $date);
        return $d && $d->format($format) === $date;
    }
}
