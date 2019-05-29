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

Route::get('/', 'SuperAdminController@index');
Route::get('/dashboard', 'SuperAdminController@index');

Route::get('/addProduct', 'SuperAdminController@addProduct');
Route::post('/save_product', 'SuperAdminController@save_product');
Route::get('/addProduct', 'SuperAdminController@products');
Route::get('/delete_product/{id}', 'SuperAdminController@delete_product');
Route::get('/edit_product/{id}', 'SuperAdminController@edit_product');
Route::post('/update_product', 'SuperAdminController@update_product');

Route::get('/addRegion', 'SuperAdminController@addRegion');
Route::post('/save_region', 'SuperAdminController@save_region');
Route::get('/addRegion', 'SuperAdminController@region');
Route::get('/delete_region/{id}', 'SuperAdminController@delete_product');
Route::get('/edit_region/{id}', 'SuperAdminController@edit_product');
Route::post('/update_region', 'SuperAdminController@update_product');

Route::get('/addSite', 'SuperAdminController@addSite');
Route::post('/saveSite', 'SuperAdminController@saveSite');
Route::get('/deleteSite/{id}', 'SuperAdminController@deleteSite');
Route::get('/editSite/{id}', 'SuperAdminController@editSite');
Route::post('/updateSite', 'SuperAdminController@updateSite');

Route::get('/addVisitSite', 'SuperAdminController@addVisitSite');
Route::post('/saveVisitSite', 'SuperAdminController@saveVisitSite');
Route::get('/addUser', 'SuperAdminController@addUser');
Route::post('/saveUser', 'SuperAdminController@saveUser');