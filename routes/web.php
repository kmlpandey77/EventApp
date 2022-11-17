<?php

use App\Http\Controllers;
use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('/', Controllers\EventController::class);

require __DIR__.'/auth.php';
