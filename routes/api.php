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

   // $api->group( ['middleware' => 'api.throttle'],  function ($api) {
        $api->post('login', 'App\Http\Controllers\API\AuthController@authenticate');
    //});

    // All routes in here are protected and thus need a valid token
    $api->group( ['middleware' => ['jwt.auth']], function ($api) {

        $api->get('user', 'App\Http\Controllers\AuthController@getAuthenticatedUser');

    });

});