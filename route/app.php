<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\facade\Route;

Route::group('api',function (){
    Route::post('login','Login/login');
    Route::group(function (){
        Route::post('logout','Login/logout');
        Route::get('admin/role','Admin/role');
        Route::post('admin/disable','Admin/disable');
        Route::resource('admin','Admin');
        Route::resource('account','Account');
        Route::get('power/mod','Power/mod');
        Route::resource('power','Power');
        Route::get('role/power','Role/power');
        Route::resource('role','Role');
        Route::post('upload','Upload/index');
        Route::group('setting',function (){
            Route::get('notice','Setting/getNotice');
            Route::post('notice','Setting/setNotice');
        });
    })->middleware('login');
})->allowCrossDomain([
    'Access-Control-Allow-Headers'=>'*'
]);

Route::get('test','Test/index');

Route::any('/',function (){
   echo 'hello world';
});
