<?php

use App\Http\Controllers\CompletedController;
use App\Http\Controllers\TodoController;
use App\Http\Livewire\EditTodoList;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});


Route::group(['middleware' => 'auth', 'verified'], function(){
    
    //Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    //TodoApp
    Route::resource('todos', TodoController::class);

    //COmpleted Tasks
    Route::get('completedTasks', [CompletedController::class, 'index'])->name('completed');
});