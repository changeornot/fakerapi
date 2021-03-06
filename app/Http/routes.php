<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/
$api = app('api.router');
$api->version('v1', ['namespace' => 'App\Http\Controllers\V1'], function ($api) {
    $api->post('auth/login', 'Auth\AuthController@postLogin');
    $api->post('auth/register', 'Auth\AuthController@postRegister');

    $api->get('feeds', 'FeedsController@getList');
    $api->get('feedsWithPage', 'FeedsController@getListWithPage');

    $api->group(['middleware' => 'api.auth'], function ($api) {
        // 班主任所带班级
        $api->get('user/profile', 'Auth\AuthController@getProfile');
    });
});
