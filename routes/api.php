<?php

use Goodcatch\Modules\Core\Repositories\Admin\DataMapRepository;
use Illuminate\Support\Facades\Route;

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

/**
 *
 * @author allen <ali@goodcatch.cn>
 * 后台 路由
 *
 */
Route::prefix('Admin')->group(function(){
    Route::namespace('Admin')->prefix('goodcatch')->group(function(){
        Route::prefix(module_route_prefix())->group(function(){
            Route::prefix('approval')->name('approval.')->group(function(){
                Route::group(['middleware'=>'jwt.admin'], function(){

                    Route::post('/templates/upload/{id}','TemplateController@upload')->name('templates.upload'); // 模版文件上传
                    Route::get('/templates/download/{id}','TemplateController@download')->name('templates.download'); // 模版文件下载
                    Route::apiResources([
                        'categories'=>'CategoryController', // 模版分类
                        'templates'=>'TemplateController' // 模版管理
                    ], [
                        'parameters' => [
                            'category' => 'id',
                            'template' => 'id'
                        ]
                    ]);
                });
            });
        });
    });

    /**
     *
     * @author allen <ali@goodcatch.cn>
     * 商家后台 路由
     *
     */
    Route::prefix('Seller')->namespace('Seller')->group(function(){
        Route::group(['middleware'=>'jwt.user'],function(){

        });
    });

    /**
     *
     * @author allen <ali@goodcatch.cn>
     * PC端 路由
     *
     */
    Route::namespace('Home')->group(function(){

        Route::group(['middleware'=>'jwt.user'],function(){

        });
    });

    /**
     *
     * @author allen <ali@goodcatch.cn>
     * App端 路由
     *
     */
    Route::prefix('App')->namespace('App')->group(function(){

        Route::group(['middleware'=>'jwt.user'],function(){

        });
    });
});


