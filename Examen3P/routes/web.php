<?php

use App\Http\Controllers\ClockController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/time', [ClockController::class, 'getTime']);