<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Schedule;
use App\Http\Controllers\SignIn;
use App\Http\Controllers\SignUp;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::redirect('/', '/schedule');
 
Route::get('/schedule', Schedule::class);

Route::match(['get', 'post'], '/signin', SignIn::class)->name('signin');

Route::match(['get', 'post'], '/signup', SignUp::class);
