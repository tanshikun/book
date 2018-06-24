<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
  return view('welcome');
});


/*Route::get('/',function(){
    return member::all();
});*/

Route::get('/login', 'view\memberController@toLogin');
Route::get('/safe/code','SafeCode@safecode');
Route::get('/register','view\memberController@toRegister');
Route::post('/ajax_tel','view\memberController@ajax_tel');
Route::post('/ajax_email','view\memberController@ajax_email');
Route::post('/ajax_on_login','view\memberController@ajax_on_login');
Route::post('/logup','view\memberController@logup');


Route::get('/categroy','view\bookController@toCategroy');
Route::get('/categroy/parent_id/{parent_id}','view\bookController@getCategroyByParentId');

Route::get('/product/categroy_id/{categroy_id}','view\bookController@toProduct');

Route::get('/product/{product_id}','view\bookController@toProductContent');

Route::get('/cart/add/{product_id}','view\cartController@addCart');

Route::get('/cart','view\cartController@toCart');

Route::get('/cart/deleteCart','view\cartController@deleteCart');
Route::get('/order_submit/{product_ids}','view\cartController@toOrderSubmit')->middleware('check_login');
Route::get('/order_list/{product_ids}','view\cartController@toOrderList')->middleware('check_login');

