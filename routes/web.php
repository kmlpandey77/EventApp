<?php

use App\Http\Controllers;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('events.index');
})->name('dashboard');

Route::resource('events', Controllers\EventController::class);

require __DIR__.'/auth.php';
