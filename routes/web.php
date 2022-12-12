<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PollController;
use App\Http\Controllers\PollOptionController;
use App\Http\Controllers\PollResultController;
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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get("/poll/create", [PollController::class, 'create'])->middleware('can:isAdmin');
Route::post("/poll", [PollController::class, 'store'])->middleware('can:isAdmin');
Route::get("/poll/{poll}", [PollController::class, 'show'])->middleware('can:isAdmin');
Route::delete("/polls/{poll}", [PollController::class, 'destroy'])->middleware('can:isAdmin');
Route::get("/polls/edit/{poll}", [PollController::class, 'edit'])->middleware('can:isAdmin');
Route::put("/polls/{poll}", [PollController::class, 'update'])->middleware('can:isAdmin');
Route::get("/polls/{poll}/report", [PollController::class, 'report'])->middleware('can:isAdmin');

Route::get("/poll/{poll}/pollOption/create", [PollOptionController::class, 'create'])->middleware('can:isAdmin');
Route::post("/poll/{poll}/pollOptions", [PollOptionController::class, 'store'])->middleware('can:isAdmin');
Route::get("/pollOptions/{poll}/edit", [PollOptionController::class, 'edit'])->middleware('can:isAdmin');
Route::put("/pollOptions/{poll}", [PollOptionController::class, 'update'])->middleware('can:isAdmin');

Route::get('/survey', [PollResultController::class, 'index'])->middleware('can:isUser');
Route::post('/survey', [PollResultController::class, 'store'])->middleware('can:isUser');
Route::get('/survey/report', [PollResultController::class, 'report'])->middleware('can:isUser');