<?php

use App\Http\Controllers\ConvertionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function() {
    return view('index');
});

Route::get('/convert', [ConvertionController::class, 'index']);
