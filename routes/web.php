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

Route::get('lang',function (){
    session(['lang_loc'=>request('loc')]);
    return back();
});
Route::group(['middleware' => 'Lang'], function () {
    Route::group(['middleware' => ['auth']], function () {
        #####
        Route::resource('discounts','DiscountController');
        Route::view('transfered_patients', 'style.transfered_patients');
        Route::get('transferred/edit/{id}', 'Front\TransferController@edit');
        Route::put('transferred/{id}', 'Front\TransferController@update');
        Route::prefix('doctor')->group(function () {
            Route::get('patients/{id}', 'Doctor\PatientController@show');
            Route::post('patient/{id}/files', 'Doctor\PatientController@storeFiles');
            Route::get('appointments/last', 'Doctor\AppointmentController@last')->name('doctor.last,appointments');
            Route::get('diagnosis', 'Doctor\DiagnosisController@index')->name('doctor.diagnosis');
            Route::get('diagnosis/{id}', 'Doctor\DiagnosisController@show')->name('doctor.diagnosis.show');
        });
        Route::get('page/{page}', function (\App\Model\Page $page) {
            return view('style.page.show', compact('page'));
        });
        Route::get('report', function() {
          return view('style.report');
        });
        Route::get('export-report', function() {
          return Excel::download(new ReportExport, 'report.xlsx');
        })->name('export_report');
        Route::get('report-print', function() {
          return view('style.report-print');
        })->name('report_print');
        ###
        Route::get('/search/patient', 'HomeController@searchPatient');
        // Route::get('/dashboard', 'HomeController@dashboard');
        Route::get('/dashboard_doctor', 'HomeController@dashboard_doctor');
        Route::get('/', 'HomeController@dashboard');
        Route::get('/home', 'HomeController@home');
        Route::get('search', 'HomeController@search');
        Route::get('add/patient', 'HomeController@create');
        Route::post('add/patient', 'HomeController@store');
        Route::get('patients/{id}/edit', 'HomeController@edit');
        Route::put('patients/{id}', 'HomeController@update');
        Route::post('patients/delete/{id}', 'HomeController@destroy');
        Route::get('patients/{id}', 'HomeController@show');
        Route::get('instructions', 'HomeController@instructions');
        Route::get('forms', 'HomeController@forms');
        Route::get('no_access', 'HomeController@no_access');

        Route::post('file/upload', 'HomeController@upload_files');
        Route::post('delete/file', 'HomeController@delete_files');

        Route::resource('appointments', 'Appointments');
        Route::post('appointments/multi_delete', 'Appointments@multi_delete');
        Route::post('get/patient', 'Appointments@get_patient');
        Route::post('load/users', 'Appointments@get_users');
        Route::post('load/period', 'Appointments@get_period');

        Route::resource('invoices', 'Invoices');
        Route::post('invoices/multi_delete', 'Invoices@multi_delete');
        Route::post('load/users/doctor', 'Invoices@get_doctors');
        Route::post('load/users/accountant', 'Invoices@get_accountant');
        Route::post('load/period/invoice', 'Invoices@get_period');

        Route::resource('diagnosis', 'Diagnosis');
        Route::post('diagnosis/multi_delete', 'Diagnosis@multi_delete');
        Route::post('load/period/diagnosis', 'Diagnosis@get_period');
        Route::post('load/users/doctor', 'Diagnosis@get_doctors');
        Route::post('company_edit', 'HomeController@company_edit');
        Route::POST('savePatient', 'HomeController@savePatient');
        Route::POST('file_add', 'HomeController@file_add');
        Route::POST('saveFile', 'HomeController@saveFile');
        Route::POST('deleteFile', 'HomeController@deleteFile')->name('deleteFile');
        Route::post('get_doctors', 'HomeController@get_doctors');
        Route::post('save_tahveel_patient', 'HomeController@save_tahveel_patient');
        Route::post('update_tahveel_patient', 'HomeController@update_tahveel_patient');
        Route::get('tahveel', 'HomeController@tahveel');
        Route::resource('tasnefat', 'Tasnefats');
        Route::post('tasnefat/multi_delete', 'Tasnefats@multi_delete');
        Route::post('category_add', 'Tasnefats@category_add');
        Route::post('category_edit', 'Tasnefats@category_edit');
        Route::post('save_category', 'Tasnefats@save_category');
        Route::post('update_category', 'Tasnefats@update_category');
        //product routes
        Route::resource('product', 'Products');
        Route::post('product/multi_delete', 'Products@multi_delete');
        Route::post('product_add', 'Products@product_add');
        Route::post('product_edit', 'Products@product_edit');
        Route::post('save_product', 'Products@save_product');
        Route::post('update_product', 'Products@update_product');
        Route::post('product/multi_delete', 'Products@multi_delete');

        Route::get('create_invoice', 'Invoices@create_invoice');
        Route::post('get_patient_detail_invoice', 'Invoices@get_patient_detail_invoice');
        Route::post('invoice_items_inv', 'Invoices@invoice_items_inv');
        Route::post('save_invoice', 'Invoices@save_invoice');
        Route::get('invoice_print/{id}', 'Invoices@invoice_print');

        //tasdeed ziarah
        Route::resource('tasdeed', 'Tasdeed');
        Route::get('tasdeed_invoice/{id}', 'Tasdeed@tasdeed_invoice');
        Route::post('get_doctors_tasdeed', 'Tasdeed@get_doctors_tasdeed');
        Route::post('update_invoice', 'Tasdeed@update_invoice');


        //expenses main type
        Route::resource('expense_main', 'Expense_main');
        Route::post('expense_main/multi_delete', 'Expense_main@multi_delete');
        Route::post('expense_main_add', 'Expense_main@expense_main_add');
        Route::post('expense_main_edit', 'Expense_main@expense_main_edit');
        Route::post('save_expense_main', 'Expense_main@save_expense_main');
        Route::post('update_expense_main', 'Expense_main@update_expense_main');

        //expenses sub type
        Route::resource('expense_sub', 'Expenses_sub');
        Route::post('expense_sub/multi_delete', 'Expenses_sub@multi_delete');
        Route::post('expense_sub_add', 'Expenses_sub@expense_sub_add');
        Route::post('expense_sub_edit', 'Expenses_sub@expense_sub_edit');
        Route::post('save_expense_sub', 'Expenses_sub@save_expense_sub');
        Route::post('update_expense_sub', 'Expenses_sub@update_expense_sub');

        //expenses
        Route::resource('expense', 'Expense');
        Route::get('create_expense', 'Expense@create_expense');
        Route::post('get_expense_sub', 'Expense@get_expense_sub');
        Route::post('invoice_items_exp', 'Expense@invoice_items_exp');
        Route::post('save_invoice_exp', 'Expense@save_invoice_exp');
        Route::get('invoice_print_expense/{id}', 'Expense@invoice_print_expense');
        Route::post('expense/multi_delete', 'Expense@multi_delete');

        //appoints
        Route::resource('appoints', 'Appoints');

        Route::get('appoints_print/{appoint}', function(\App\Model\Appoint $appoint) {
          return view('style.appoints.print',compact('appoint'));
        });
        Route::get('appoints_doctor', 'Appoints@appoints_doctor');
        Route::post('get_appoints_new', 'Appoints@get_appoints_new');
        Route::post('patient_select', 'Appoints@patient_select');
        Route::post('confirm_booking', 'Appoints@confirm_booking');
        Route::post('cancel_booking', 'Appoints@cancel_booking');
        Route::post('change_status', 'Appoints@change_status');
        Route::post('confirm_change', 'Appoints@confirm_change');
        Route::post('confirm_call', 'Appoints@confirm_call');

        Route::get('/doctor_layout', 'HomeController@doctor_layout');
        Route::post('get_patient_detail', 'HomeController@get_patient_detail');
        Route::post('get_products', 'HomeController@get_products');
        Route::post('invoice_items', 'HomeController@invoice_items');
        Route::post('save_treatment', 'HomeController@save_treatment');
        Route::get('doctor_layout_1', 'HomeController@doctor_layout_1');

        Route::post('tasdeed_count', 'HomeController@tasdeed_count');

        //reports
        Route::get('khazina', 'Reports@khazina');
        Route::get('patient_report', 'Reports@patient_report');
        Route::post('get_report_khazina', 'Reports@get_report_khazina');
        Route::post('get_report_patient', 'Reports@get_report_patient');
        Route::post('get_report_clinic_doctor', 'Reports@get_report_clinic_doctor');
        Route::post('get_report_doctor', 'Reports@get_report_doctor');
        Route::post('get_doctors_report', 'Reports@get_doctors_report');
        Route::get('clinic_doctor_report', 'Reports@clinic_doctor_report');
        Route::get('doctor_report', 'Reports@doctor_report');
    });
    Auth::routes();
});
