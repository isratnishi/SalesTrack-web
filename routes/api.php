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
Route::post('register', 'UserController@register');
Route::post('login', 'UserController@authenticate');
Route::get('open', 'DataController@open');

Route::group(['middleware' => ['jwt.verify']], function () {
    Route::get('user', 'UserController@getAuthenticatedUser');
    Route::get('closed', 'DataController@closed');

});

Route::post('/logincheck', 'APIController@login');
Route::get('/getVisit/{id}', 'APIController@getAllVisit');
Route::get('/getUser/{email}', 'APIController@getUser');
Route::post('/saveVisit', 'APIController@saveVisit');

Route::get('/getSaleVisit/{id}', 'APIController@getAllSaleVisit');
Route::post('/deleteSaleVisit/{id}', 'APIController@deleteSaleVisit');
Route::get('/getSiteName/{id}', 'APIController@getSiteName');
Route::get('/getProductName/{id}', 'APIController@getProductName');

Route::post('/deleteSale/{id}', 'APIController@deleteSale');