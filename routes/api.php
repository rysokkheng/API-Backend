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

Route::post('login', 'api\LoginController@login');

Route::group(['middleware' => ['auth:api']], function(){
    //Route::resource('user', Api\UserController::class);

    Route::GET('user',              ['as'=>'user.index', 'uses'=> '\App\Http\Controllers\Api\UserController@index',     /*'middleware' => ['permission:user-list']*/]);
    //Route::GET('user/create',       ['as'=>'user.create', 'uses'=> '\App\Http\Controllers\Api\UserController@create', /*'middleware' => ['permission:user-create']*/]);
    Route::GET('user/{user}',       ['as'=>'user.show', 'uses'=> '\App\Http\Controllers\Api\UserController@show',       /*'middleware' => ['permission:user-show']*/]);
    Route::GET('user/{user}/edit',  ['as'=>'user.edit', 'uses'=> '\App\Http\Controllers\Api\UserController@edit',       /*'middleware' => ['permission:user-edit']*/]);
    Route::POST('user',             ['as'=>'user.store', 'uses'=> '\App\Http\Controllers\Api\UserController@store',     /*'middleware' => ['permission:user-store']*/]);
    Route::PUT('user/{user}',       ['as'=>'user.update', 'uses'=> '\App\Http\Controllers\Api\UserController@update',   /*'middleware' => ['permission:user-update']*/]);
    Route::DELETE('user/{user}',           ['as'=>'user.destroy', 'uses'=> '\App\Http\Controllers\Api\UserController@destroy', /*'middleware' => ['permission:user-delete']*/]);

    // Role
    Route::GET('role',              ['as'=>'role.index', 'uses'=> '\App\Http\Controllers\Api\RoleController@index',     /*'middleware' => ['permission:user-list']*/]);
    Route::GET('role/{role}',       ['as'=>'role.show', 'uses'=> '\App\Http\Controllers\Api\RoleController@show',       /*'middleware' => ['permission:role-show']*/]);
    Route::GET('role/{role}/edit',  ['as'=>'role.edit', 'uses'=> '\App\Http\Controllers\Api\RoleController@edit',       /*'middleware' => ['permission:role-edit']*/]);
    Route::POST('role',             ['as'=>'role.store', 'uses'=> '\App\Http\Controllers\Api\RoleController@store',     /*'middleware' => ['permission:role-store']*/]);
    Route::PUT('role/{role}',       ['as'=>'role.update', 'uses'=> '\App\Http\Controllers\Api\RoleController@update',   /*'middleware' => ['permission:role-update']*/]);
    Route::DELETE('role',           ['as'=>'role.destroy', 'uses'=> '\App\Http\Controllers\Api\RoleController@destroy', /*'middleware' => ['permission:role-delete']*/]);

    // Permission
    Route::GET('permission',              ['as'=>'permission.index', 'uses'=> '\App\Http\Controllers\Api\PermissionController@index',     /*'middleware' => ['permission:permission-list']*/]);
    Route::GET('permission/{permission}',       ['as'=>'permission.show', 'uses'=> '\App\Http\Controllers\Api\PermissionController@show',       /*'middleware' => ['permission:permission-show']*/]);
    Route::GET('permission/{permission}/edit',  ['as'=>'permission.edit', 'uses'=> '\App\Http\Controllers\Api\PermissionController@edit',       /*'middleware' => ['permission:permission-edit']*/]);
    Route::POST('permission',             ['as'=>'permission.store', 'uses'=> '\App\Http\Controllers\Api\PermissionController@store',     /*'middleware' => ['permission:permission-store']*/]);
    Route::PUT('permission/{permission}',              ['as'=>'permission.update', 'uses'=> '\App\Http\Controllers\Api\PermissionController@update',   /*'middleware' => ['permission:permission-update']*/]);
    Route::DELETE('permission',           ['as'=>'permission.destroy', 'uses'=> '\App\Http\Controllers\Api\PermissionController@destroy', /*'middleware' => ['permission:permission-delete']*/]);
});

