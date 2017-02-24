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

$api = $app->make(Dingo\Api\Routing\Router::class);

$params = [
    'version' => env('API_VERSION'),
];

$api->version($params, function ($api) {
    /**
    * OBJECTIVES
    **/
    $api->put('word', [
        'as'    => 'api.words.create',
        'uses'  => 'App\Http\Controllers\WordController@addWord'   
    ]);

    /*
    $api->get('/word/all/', [
        'as'    => 'api.words.all',
        'uses'  => 'App\Http\Controllers\WordController@getWords'   
    ]);
    */

    $api->get('word/{id?}', [
        'as'    => 'api.words.get',
        'uses'  => 'App\Http\Controllers\WordController@getWordById'   
    ]);

    $api->post('word', [
        'as'    => 'api.words.update',
        'uses'  => 'App\Http\Controllers\WordController@updateWord'   
    ]);

    $api->delete('word/{id}', [
        'as'    => 'api.words.delete',
        'uses'  => 'App\Http\Controllers\WordController@deleteWord'   
    ]);


    /**
    * AUTHENTICATION
    **/
    /*
    $api->post('/auth/login', [
        'as'    => 'api.auth.login',
        'uses'  => 'App\Http\Controllers\Auth\AuthController@postLogin',
    ]);

    $api->group([
        'middleware' => 'api.auth',
    ], function ($api) {
        $api->get('/', [
            'uses'  => 'App\Http\Controllers\APIController@getIndex',
            'as'    => 'api.index'
        ]);
        $api->get('/auth/user', [
            'uses'  => 'App\Http\Controllers\Auth\AuthController@getUser',
            'as'    => 'api.auth.user'
        ]);
        $api->patch('/auth/refresh', [
            'uses'  => 'App\Http\Controllers\Auth\AuthController@patchRefresh',
            'as'    => 'api.auth.refresh'
        ]);
        $api->delete('/auth/invalidate', [
            'uses'  => 'App\Http\Controllers\Auth\AuthController@deleteInvalidate',
            'as'    => 'api.auth.invalidate'
        ]);
    });
    */
});
