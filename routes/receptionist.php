<?php

use Illuminate\Support\Facades\Route;

// livewire
Route::group(['namespace' => '\App\Http\Livewire\Receptionist'], function () {
    Route::get('/', \Home::class)->name('home');
});
