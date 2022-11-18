<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Actions;


Route::prefix('events',)->group(function (){
    Route::get('/', Actions\Events\ListEvent::class);
});