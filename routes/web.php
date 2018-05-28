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

Route::get('/',function(){


    return redirect('/home/index');
});
// 后台
Route::group([],function(){
    // 首页
    Route::get('admin/index','admin\IndexController@index');
    // 用户
    Route::resource('admin/user','admin\UserController');
    Route::get('admin/userajax','admin\UserAjaxController@uajax');
    Route::get('admin/unajax','admin\UserAjaxController@unajax');
    // 分类
    Route::resource('admin/cate','admin\CatesController');
    // 商品
    Route::resource('admin/good','admin\GoodsController');
    Route::get('admin/goodAjax','admin\GoodsAjaxController@GoodsAjax');
    Route::post('admin/good/delete','admin\GoodsAjaxController@delete');
    // 广告
    Route::resource('admin/adver','admin\adverController');
    Route::post('admin/adver/ajax','admin\adverAjaxController@ajax');
    Route::post('admin/adver/delete','admin\adverAjaxController@delete');
    // 评论管理
    Route::get('admin/eval','admin\evalController@index');
    Route::get('admin/evalajax','admin\evalController@ajax');
    Route::get('admin/pinglun/{id}/{gid}','admin\evalController@pinglun');
    // 友情链接
    Route::resource('admin/links','admin\LinkController');
    Route::get('admin/linkajax','admin\LinkAjaxController@lajax');
    // 轮播
    Route::resource('admin/carouses','admin\CarousesController');
    Route::get('admin/carousesajax','admin\CarousesAjaxController@cajax');

     
});


// 前台
Route::group([],function(){

    // 首页
    Route::get('home/index','home\IndexController@index');
    Route::get('home/show','home\IndexController@show');
    Route::get('home/user','home\IndexController@user');
    // 列表页
    Route::get('home/list/{cid}','home\GoodsController@list');
    Route::get('home/cuxiao/{cid}','home\GoodsController@cuxiao');
    // 详情页
    Route::get('home/detail/{gid}','home\GoodsController@detail');
    //详情页加入购物车
    Route::get('home/cartsAjax/{gid}','home\GoodsController@cartsAjax');
        // 购物车
    Route::get('home/carts','home\cartsController@index');
    Route::get('home/ajax','home\cartsController@ajax');
    Route::get('home/number','home\cartsController@number');
    Route::get('home/CartStatus','home\cartsController@CartStatus');

    //确认订单信息
    Route::get('home/order','home\orderController@order');
    //修改地址提交的方法
    Route::post('home/add','home\orderController@add');
    //添加地址页面
    Route::get('home/tianjia','home\orderController@tianjia');
    //添加地址方法
    Route::get('home/insert','home\orderController@insert');
    //修改地址页面
    Route::get('home/address/{id}','home\orderController@address');
    //成功提交订单
    Route::get('home/paysce','home\paysceController@paysce');

    // 友情链接
    Route::get('home/links','home\LinksController@links');

    

});
