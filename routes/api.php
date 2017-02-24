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
    * WORDS
    **/
    $api->put('word', [
        'as'    => 'api.words.create',
        'uses'  => 'App\Http\Controllers\WordController@addWord'   
    ]);

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
    * THEMES
    **/
    $api->put('theme', [
        'as'    => 'api.theme.create',
        'uses'  => 'App\Http\Controllers\ThemeController@addTheme'   
    ]);

    $api->get('theme/{id?}', [
        'as'    => 'api.theme.get',
        'uses'  => 'App\Http\Controllers\ThemeController@getThemeById'   
    ]);

    $api->post('theme', [
        'as'    => 'api.theme.update',
        'uses'  => 'App\Http\Controllers\ThemeController@updateTheme'   
    ]);

    $api->delete('theme/{id}', [
        'as'    => 'api.theme.delete',
        'uses'  => 'App\Http\Controllers\ThemeController@deleteTheme'
    ]);
});
