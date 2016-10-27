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

$api = app('Dingo\Api\Routing\Router');

$api->version('v1',  ['prefix' => 'api'], function ($api) {

    $api->group( ['middleware' => 'api.throttle'],  function ($api) {
        $api->post('login', 'App\Http\Controllers\API\AuthController@authenticate');
    });

    // All routes in here are protected and thus need a valid token
    $api->group( ['middleware' => ['jwt.auth']], function ($api) {

        $api->get('user', 'App\Http\Controllers\API\AuthController@getAuthenticatedUser');

        $api->get('admins', 'App\Http\Controllers\API\AdminController@index');
        $api->post('admins', 'App\Http\Controllers\API\AdminController@store');
        $api->get('admins/{id}', 'App\Http\Controllers\API\AdminController@show');
        $api->put('admins/{id}', 'App\Http\Controllers\API\AdminController@update');
        $api->delete('admins/{id}', 'App\Http\Controllers\API\AdminController@destroy');
        
        $api->get('clients', 'App\Http\Controllers\API\ClientsController@index');
        $api->post('clients', 'App\Http\Controllers\API\ClientsController@store');
        $api->get('clients/{id}', 'App\Http\Controllers\API\ClientsController@show');
        $api->put('clients/{id}', 'App\Http\Controllers\API\ClientsController@update');
        $api->delete('clients/{id}', 'App\Http\Controllers\API\ClientsController@destroy');
        
    });

});