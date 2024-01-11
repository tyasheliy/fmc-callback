<?php

use App\Http\Controllers\ConvertionController;
use Illuminate\Support\Facades\Route;

Route::get('/convert', [ConvertionController::class, 'convert']);
