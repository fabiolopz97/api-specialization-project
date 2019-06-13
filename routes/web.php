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

Route::get('/', function () {
    return view('welcome');
});
// Example Route POST method
//Route::post('api/service', 'ServiceController@store');

/**
 * Customer api routes
 */
//Route::resource('customer', 'CustomerController');
//Route::post('customer/login', 'CustomerController@login');
/*Route::resource('service', 'ServiceController');
Route::get('service/category/{id}', 'ServiceController@showServicesByCategory');
Route::resource('category', 'ServiceCategoryController');*/


//Routes of the controller service
//Route::resource('api/service', 'ServiceController');
//Routes of the controller customer
//    Route::resource('api/customer', 'CustomerController');
//Routes of the controller employee
  //  Route::resource('api/employee', 'EmployeeController');
//Routes of the controller appointment
 //   Route::resource('api/appointment', 'AppointmentController');
