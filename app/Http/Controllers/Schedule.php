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

            $schedulePeriod = $request->input('period', 'today');
            $scheduleType = $request->input('type', 'other');

            if ($request->isMethod('get')){

                if ($schedulePeriod !== 'today' && $schedulePeriod !== 'all' && !$this->validateDate($schedulePeriod)){
                    $schedulePeriod = 'today';
                }

                if (!ctype_alpha($scheduleType)){
                    $scheduleType = 'other';
                }

                if ($schedulePeriod === 'today'){
                    try {
                        DB::table('schedules')->where('id', Auth::id());
                    } catch (Exception $e) {
                        Log::error($e->getMessage());
                        return response()->json(['error' => 'An error was encountered']);
                    }
                } else if ($this->validateDate($schedulePeriod)) {

                } else if ($schedulePeriod === 'all') {

                }
                

            } else if ($request->isMethod('post')) {

            } else {
                return response()->json(['error' => 'Bad request']);
            }
        } else {
            return response()->json(['show' => 'schedule']);
        }
    }

    private function validateDate($date, $format = 'Y-m-d') {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) === $date;
    }
}
