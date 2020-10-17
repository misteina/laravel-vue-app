<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SignIn;
use App\Http\Controllers\SignUp;
use App\Http\Controllers\ListToDos;
use App\Http\Controllers\AddToDo;
use App\Http\Controllers\DeleteToDo;

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

Route::redirect('/', '/todo');

Route::get('/todo', ListToDos::class);

Route::post('/todo/add', AddToDo::class);

Route::get('/todo/delete', DeleteToDo::class);

Route::post('/signin', SignIn::class)->name('signin');

Route::post('/signup', SignUp::class);
