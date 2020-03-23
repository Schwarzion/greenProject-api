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

//Tests purpose
$router->get('/test', function () {
    return response()->json(['msg' => 'hello']);
});

$router->get('/', function () use ($router) {
    return $router->app->version();
});

// API route group
$router->group(['prefix' => 'api'], function () use ($router) {

    //Guest Part of API
    $router->post('register', [
        'as' => 'register', 'uses' => 'UserController@create',
    ]);
    $router->post('login', [
        'as' => 'login', 'uses' => 'AuthController@login',
    ]);

    //Authentified Part of API (check controller constructor)

    //Get authentified user
    $router->get('profile', [
        'as' => 'profile', 'uses' => 'AuthController@me',
    ]);

    //Invalidate the token
    $router->post('logout', [
        'as' => 'logout', 'uses' => 'AuthController@logout',
    ]);
    //Get all tips
    $router->get('allTips', [
        'as' => 'allTips', 'uses' => 'TipController@getAllTips',
    ]);
    //Get one tips
    $router->get('tip/{id}', [
        'as' => 'tip', 'uses' => 'TipController@getTip',
    ]);
    //Add tip
    $router->post('addTip', [
        'as' => 'alltips', 'uses' => 'TipController@addTip',
    ]);
    //Delete tip
    $router->get('deleteTip/{id}', [
        'as' => 'deleteTip', 'uses' => 'TipController@deleteTip',
    ]);
    //Edit tip
    $router->post('editTip/{id}', [
        'as' => 'editTip', 'uses' => 'TipController@updateTip',
    ]);

});
