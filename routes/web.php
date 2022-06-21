<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

use Illuminate\Support\Facades\Route;
use App\Exports\ReportExport;


Route::get('/', function () {
   if(auth()->user()->isDoctor()){
       return redirect('/doctor');
    }elseif(auth()->user()->isReceptionist()){
        return redirect('/receptionist');
    }elseif(auth()->user()->isAccountant()){
        return redirect('/accountant');
    }  elseif(auth()->user()->isAdmin()){
        return redirect('/admin');
    }
})->middleware('auth');
Route::get('lang',function (){
    session(['lang_loc'=>request('loc')]);
    return back();
});

Auth::routes();
