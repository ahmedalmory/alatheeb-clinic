<?php

/*
|--------------------------------------------------------------------------
| Web Admin Panel Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

app()->singleton('admin', function () {
   return 'admin';
});

\L::Panel(app('admin')); /// Set Lang redirect to admin
\L::LangNonymous(); // Run Route Lang 'namespace' => 'Admin',

Route::group(['prefix' => app('admin'), 'middleware' => 'Lang'], function () {

   Route::get('theme/{id}', 'Admin\Dashboard@theme');
   Route::group(['middleware' => 'admin_guest'], function () {

      Route::get('login', 'Admin\AdminAuthenticated@login_page');
      Route::post('login', 'Admin\AdminAuthenticated@login_post');

      Route::post('reset/password', 'Admin\AdminAuthenticated@reset_password');
      Route::get('password/reset/{token}', 'Admin\AdminAuthenticated@reset_password_final');
      Route::post('password/reset/{token}', 'Admin\AdminAuthenticated@reset_password_change');
   });
   /*
   |--------------------------------------------------------------------------
   | Web Routes
   |--------------------------------------------------------------------------
   | Do not delete any written comments in this file
   | These comments are related to the application (it)
   | If you want to delete it, do this after you have finished using the application
   | For any errors you may encounter, please go to this link and put your problem
   | phpanonymous.com/it/issues
    */

   Route::group(['middleware' => 'admin:admin'], function () {
      //////// Admin Routes /* Start */ //////////////
      Route::get('/', 'Admin\Dashboard@home');
      Route::any('logout', 'Admin\AdminAuthenticated@logout');

      Route::get('setting', 'Admin\Dashboard@setting');
      Route::post('setting', 'Admin\Dashboard@setting_post');
      Route::resource('relationship', 'Admin\RelationshipController');
      Route::post('relationship/multi_delete', 'Admin\RelationshipController@multi_delete');
      Route::resource('nationalities', 'Admin\NationalitiesController');
      Route::resource('cities', 'Admin\CityController');
      Route::post('nationalities/multi_delete', 'Admin\NationalitiesController@multi_delete');
      Route::post('cities/multi_delete', 'Admin\CityController@multi_delete');
      Route::resource('patients', 'Admin\PatientsController');
      Route::post('patients/multi_delete', 'Admin\PatientsController@multi_delete');

      Route::post('file/upload', 'Admin\PatientsController@upload_files');
      Route::post('delete/file', 'Admin\PatientsController@delete_files');
      Route::resource('departments', 'Admin\DepartmentsController');
      Route::resource('products', 'Admin\ProductController');
      Route::post('products/multi_delete', 'Admin\ProductController@multi_delete');

      Route::resource('groups', 'Admin\GroupsController');
      Route::post('groups/multi_delete', 'Admin\GroupsController@multi_delete');
      Route::resource('users', 'Admin\UsersController');
      Route::post('users/multi_delete', 'Admin\UsersController@multi_delete');
      Route::resource('forms', 'Admin\FormsController');
      Route::post('forms/multi_delete', 'Admin\FormsController@multi_delete');
      Route::resource('pages', 'Admin\Pages');
      Route::post('pages/multi_delete', 'Admin\Pages@multi_delete');

      Route::resource('appointments', 'Admin\Appointments');
      Route::post('appointments/multi_delete', 'Admin\Appointments@multi_delete');
      Route::post('get/patient', 'Admin\Appointments@get_patient');
      Route::post('load/users', 'Admin\Appointments@get_users');
      Route::post('load/period', 'Admin\Appointments@get_period');

      Route::resource('invoices', 'Admin\Invoices');
      Route::post('invoices/multi_delete', 'Admin\Invoices@multi_delete');
      Route::post('load/users/doctor', 'Admin\Invoices@get_doctors');
      Route::post('load/users/accountant', 'Admin\Invoices@get_accountant');
      Route::post('load/period/invoice', 'Admin\Invoices@get_period');

      Route::resource('diagnosis', 'Admin\Diagnosis');
      Route::post('diagnosis/multi_delete', 'Admin\Diagnosis@multi_delete');
      Route::post('load/period/diagnosis', 'Admin\Diagnosis@get_period');
      Route::post('load/users/doctor', 'Admin\Diagnosis@get_doctors');
      
      Route::resource('slides', 'Admin\Slides');
      //////// Admin Routes /* End */ //////////////
   });

});
