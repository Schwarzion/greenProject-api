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
    //Authentification
    $router->post('login', ['as' => 'login', 'uses' => 'AuthController@login']);
    $router->post('logout', ['as' => 'logout', 'uses' => 'AuthController@logout']);
    $router->get('profile', ['as' => 'profile', 'uses' => 'AuthController@me']);
    //Tips
    $router->post('register', ['as' => 'register', 'uses' => 'UserController@create']);
    $router->get('allUser', ['as' => 'allUser', 'uses' => 'UserController@index']);
    $router->get('user/{id}', ['as' => 'user', 'uses' => 'UserController@show']);
    $router->get('deleteUser/{id}', ['as' => 'deleteUser', 'uses' => 'UserController@delete']);
    $router->put('editUser/{id}', ['as' => 'editUser', 'uses' => 'UserController@update']);
    //Tips
    $router->get('allTips', ['as' => 'allTips', 'uses' => 'TipController@index']);
    $router->get('tip/{id}', ['as' => 'tip', 'uses' => 'TipController@show']);
    $router->post('addTip', ['as' => 'alltips', 'uses' => 'TipController@create']);
    $router->get('deleteTip/{id}', ['as' => 'deleteTip', 'uses' => 'TipController@delete']);
    $router->put('editTip/{id}', ['as' => 'editTip', 'uses' => 'TipController@update']);
});
