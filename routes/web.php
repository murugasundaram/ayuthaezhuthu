<?php

use App\Http\Middleware\CheckIsSuperAdmin;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

// TODO allow super admin users alone
Route::group(['middleware' => ['auth', CheckIsSuperAdmin::class], 'prefix' => 'nirvakam/kattupattuarai'], function () {
    Route::get('/tenants', 'TenantController@index');
    Route::get('/tenants/create', 'TenantController@create');
    Route::post('/tenants/store', 'TenantController@store');
    Route::get('/tenants/{id}', 'TenantController@show');
    Route::get('/tenants/{id}/edit', 'TenantController@edit');
    Route::put('/tenants/{id}', 'TenantController@update');
    Route::get('/tenants/destroy/{id}', 'TenantController@destroy');
    Route::get('/tenants/status/html', 'TenantController@generateHTMLForStatusChange');
    Route::post('/tenants/status', 'TenantController@changeStatus');
    Route::post('/tenants/add_user', 'TenantController@addUser');
});

