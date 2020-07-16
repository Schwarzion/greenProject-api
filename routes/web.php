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
    //Users
    $router->post('register', ['as' => 'register', 'uses' => 'UserController@create']);
    $router->get('allUser', ['as' => 'allUser', 'uses' => 'UserController@index']);
    $router->get('user/{id}', ['as' => 'user', 'uses' => 'UserController@show']);
    $router->get('deleteUser/{id}', ['as' => 'deleteUser', 'uses' => 'UserController@delete']);
    $router->post('editUser/{id}', ['as' => 'editUser', 'uses' => 'UserController@update']);
    //Tips
    $router->get('allTips', ['as' => 'allTips', 'uses' => 'TipController@index']);
    $router->get('tip/{id}', ['as' => 'tip', 'uses' => 'TipController@show']);
    $router->post('addTip', ['as' => 'addTip', 'uses' => 'TipController@create']);
    $router->get('deleteTip/{id}', ['as' => 'deleteTip', 'uses' => 'TipController@delete']);
    $router->post('editTip/{id}', ['as' => 'editTip', 'uses' => 'TipController@update']);
    //Quests
    $router->get('allQuests', ['as' => 'allQuests', 'uses' => 'QuestController@index']);
    $router->get('quest/{id}', ['as' => 'quest', 'uses' => 'QuestController@show']);
    $router->post('addQuest', ['as' => 'addQuest', 'uses' => 'QuestController@create']);
    $router->get('deleteQuest/{id}', ['as' => 'deleteQuest', 'uses' => 'QuestController@delete']);
    $router->post('editQuest/{id}', ['as' => 'editQuest', 'uses' => 'QuestController@update']);
});
