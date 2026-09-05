<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ViberController;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/send', function () {
//     return view('viber.form');
// });

Route::post('/send-message', [ViberController::class, 'sendMessage']);
