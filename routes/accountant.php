<?php


use Illuminate\Support\Facades\Route;

// livewire
Route::group(['namespace' => '\App\Http\Livewire\Accountant'], function () {
    Route::get('/', \Home::class)->name('home');
});
