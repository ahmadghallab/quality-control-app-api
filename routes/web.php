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
    // Users routes
    $router->post('user', [
        'uses' => 'AuthController@store'
    ]);
    $router->post('user/signin', [
        'uses' => 'AuthController@signin'
    ]);
    
    // Health office routes
    $router->get('healthoffice', [
        'uses' => 'HealthOfficeController@index'
    ]);
    $router->post('healthoffice', [
        'uses' => 'HealthOfficeController@store'
    ]);
    $router->get('healthoffice/{id}', [
        'uses' => 'HealthOfficeController@show'
    ]);
    $router->patch('healthoffice/{id}', [
        'uses' => 'HealthOfficeController@update'
    ]);
    $router->delete('healthoffice/{id}', [
        'uses' => 'HealthOfficeController@destroy'
    ]);

    // Section routes
    $router->get('section', [
        'uses' => 'SectionController@index'
    ]);
    $router->post('section', [
        'uses' => 'SectionController@store'
    ]);
    $router->get('section/{id}', [
        'uses' => 'SectionController@show'
    ]);
    $router->patch('section/{id}', [
        'uses' => 'SectionController@update'
    ]);
    $router->delete('section/{id}', [
        'uses' => 'SectionController@destroy'
    ]);

    // Criteria routes
    $router->get('criteria', [
        'uses' => 'CriteriaController@index'
    ]);
    $router->post('criteria', [
        'uses' => 'CriteriaController@store'
    ]);
    $router->get('criteria/{id}', [
        'uses' => 'CriteriaController@show'
    ]);
    $router->patch('criteria/{id}', [
        'uses' => 'CriteriaController@update'
    ]);
    $router->delete('criteria/{id}', [
        'uses' => 'CriteriaController@destroy'
    ]);

    // Ecaluation routes
    $router->post('evaluation', [
        'uses' => 'EvaluationController@store'
    ]);
    $router->get('evaluation/{id}', [
        'uses' => 'EvaluationController@show'
    ]);
    $router->patch('evaluation/{id}', [
        'uses' => 'EvaluationController@update'
    ]);
    $router->delete('evaluation/{id}', [
        'uses' => 'EvaluationController@destroy'
    ]);
});
