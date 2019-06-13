<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::group([
    'prefix' => 'auth',
], function () {
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
});
Route::resource('customer', 'CustomerController');
Route::resource('service', 'ServiceController');
Route::get('service/category/{id}', 'ServiceController@showServicesByCategory');
Route::resource('category', 'ServiceCategoryController');


//Route::resource('customer', 'CustomerController')->middleware('jwt.auth');
/*Route::get('/detalle/{year?}', [
    'middleware' => 'testyear',
    'uses' => 'PeliculaController@detalle',
    'as' => 'detalle.pelicula'
]);*/
//pendiente para las turas con atenticacion
/*Route::group(['prefix' => 'customer'], function(){
    Route::get('/', [
        'middleware' => 'jwt.auth',
        'uses' => 'CustomerController@index',
        'as' => 'customer.index'
    ]);
    Route::post('/', [
        'uses' => 'CustomerController@store',
        'as' => 'customer.store'
    ]);
});*/
