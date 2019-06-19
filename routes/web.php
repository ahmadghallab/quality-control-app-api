<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/
$router->group(['prefix' => 'api/v1'], function () use ($router) {
    $router->get('healthoffice', [
        'uses' => 'HealthOfficeController@index'
    ]);
    $router->post('healthoffice', [
        'uses' => 'HealthOfficeController@store'
    ]);
    $router->post('user', [
        'uses' => 'AuthController@store'
    ]);
    $router->post('user/signin', [
        'uses' => 'AuthController@signin'
    ]);
});
