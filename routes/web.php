<?php

use App\Actions;
use App\Http\Controllers;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('events.index');
})->name('dashboard');

//Events with controller
Route::resource('events', Controllers\EventController::class);

//Events with actions
Route::prefix('events-action')->name('events-action.')->group(function () {
    Route::get('/', Actions\Events\ListEvent::class)->name('index');
    Route::get('/create', Actions\Events\CreatEvent::class)->name('create');
    Route::post('/', [Actions\Events\CreatEvent::class, 'store'])->name('store');
    Route::get('/{event}/edit/', Actions\Events\UpdateEvent::class)->name('edit');
    Route::put('/{event}/', [Actions\Events\UpdateEvent::class, 'update'])->name('update');
    Route::delete('/{event}/', Actions\Events\DeleteEvent::class)->name('destroy');
});

require __DIR__.'/auth.php';
