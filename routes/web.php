<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Views;
use App\Http\Controllers\SignIn;
use App\Http\Controllers\SignUp;
use App\Http\Controllers\ListToDos;
use App\Http\Controllers\AddToDo;
use App\Http\Controllers\DeleteToDo;
use App\Http\Controllers\LogOut;

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

Route::get('/todo', Views::class);

Route::get('/signup', Views::class);

Route::get('/signin', Views::class);

Route::post('/todo/list', ListToDos::class);

Route::post('/todo/add', AddToDo::class);

Route::post('/todo/delete', DeleteToDo::class);

Route::post('/signin', SignIn::class)->name('signin');

Route::post('/signup', SignUp::class);

Route::post('/logout', LogOut::class);
