<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', [MainController::class, 'index']);
Route::post('/tasks', [MainController::class, 'store']);
Route::put('/tasks/{id}', [MainController::class, 'update']);
