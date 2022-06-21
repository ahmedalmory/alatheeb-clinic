<?php


use Illuminate\Support\Facades\Route;
Route::prefix('doctor')->as('doctor.')->group(function (){
    Route::get('/','DashboardController@index')->name('dashboard.index');
    Route::view('/window','doctor.window')->name('window');
});
