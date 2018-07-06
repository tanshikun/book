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
Route::get('/exit_login','view\memberController@exit_login');

Route::get('/categroy','view\bookController@toCategroy');
Route::get('/categroy/parent_id/{parent_id}','view\bookController@getCategroyByParentId');

Route::get('/product/categroy_id/{categroy_id}','view\bookController@toProduct');

Route::get('/product/{product_id}','view\bookController@toProductContent');

Route::get('/cart/add/{product_id}','view\cartController@addCart');

Route::get('/cart','view\cartController@toCart');

Route::get('/cart/deleteCart','view\cartController@deleteCart');
Route::get('/order_submit/{product_ids}','view\cartController@toOrderSubmit')->middleware('check_login');
//收货地址填写
Route::post('/order_address/{product_ids}','view\cartController@toOrderAddress');
Route::any('/order_list','view\cartController@toOrderList')->middleware('check_login');
//取消订单
Route::post('/order_cancel/{order_no}','view\cartController@toOrderCancel');









//管理后台的路由
Route::group(['prefix'=>'admin'],function(){
    //主页
     Route::get('index','admin\indexController@toIndex');
     //产品管理
     Route::get('categroy','admin\categroyController@toCategroy');
     //管理员登录
     Route::get('login','admin\indexController@toLogin');
     //订单列表
     Route::get('orderList','admin\orderController@toOrderList');
     //会员管理
     Route::get('member','admin\memberController@toMember');
     Route::post('login','admin\indexController@login');
     //产品添加
     Route::get('categroy_add','admin\categroyController@toCategroyAdd');
     Route::post('toLogin','admin\loginController@toLogin');
     Route::post('categroy/add','admin\categroyController@toCategroyTypeAdd');
     Route::post('categroy/del','admin\categroyController@toCategroyTypeDel');

     Route::get('product','admin\categroyController@toProduct');

});
     Route::get('admin/categroy_edit','admin\categroyController@categroyEdit');
     Route::post('admin/categroy/edit','admin\categroyController@toCategroyEdit');
     //产品详情
     Route::get('admin/product_content/{id}','admin\categroyController@toProductContent');
     Route::get('admin/product_add','admin\categroyController@toProductAdd');
     Route::get('admin/product/add','admin\categroyController@ProductAdd');
     //产品添加一级分类
     Route::get('admin/product/parent_id/{parent_id}','admin\categroyController@ProductTypeAdd');
     //产品添加二级分类
     Route::get('/admin/categroy/product_add/{id}','admin\categroyController@product_add');
     //产品添加
     Route::post('admin/productadd','admin\contentController@productadd');
     //产品编辑:回选进入编辑页面
     Route::get('/admin/productEdit/{id}','admin\contentController@productEdit');
     //产品编辑:编辑完成，提交数据
     Route::post('admin/product_edit','admin\contentController@product_edit');
     //产品删除
     Route::post('admin/product/del','admin\contentController@product_del');
     //查看订单详情
     Route::get('admin/order_content/{id}','admin\orderController@order_content');
     Route::post('admin/send_goods/{id}','admin\orderController@send_goods');
     //我的桌面
     Route::get('admin/welcome','admin\indexController@welcome');
     //退出管理员登录
     Route::get('admin/exist_login','admin\indexController@exist_login');

