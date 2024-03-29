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
    * GENERATION
    **/
    /*
    $api->get('words/generation/kana/{forceAll?}', [
        'as'    => 'api.kana.generation',
        'uses'  =>  'App\Http\Controllers\WordController@generateKana'
    ]);
    */
    
    $api->get('words/generation/romaji/{forceAll?}', [
        'as'    => 'api.romaji.generation',
        'uses'  =>  'App\Http\Controllers\WordController@generateRomaji'
    ]);

    /**
    * WORDS
    **/
    $api->put('word', [
        'as'    => 'api.words.create',
        'uses'  => 'App\Http\Controllers\WordController@addWord'   
    ]);

    $api->post('word', [
        'as'    => 'api.words.update',
        'uses'  => 'App\Http\Controllers\WordController@updateWord'   
    ]);

    $api->get('word/{id?}', [
        'as'    => 'api.words.get',
        'uses'  => 'App\Http\Controllers\WordController@getWordById'   
    ]);

    $api->delete('word/{id}', [
        'as'    => 'api.words.delete',
        'uses'  => 'App\Http\Controllers\WordController@deleteWord'   
    ]);

    $api->get('word/exists/{romaji}', [
        'as'    => 'api.words.exists',
        'uses'  => 'App\Http\Controllers\WordController@doesWordExists'   
    ]);

    $api->post('word/convert/romaji', [
        'as'    => 'api.word.convert.romaji',
        'uses'  => 'App\Http\Controllers\WordController@convertToRomaji'
    ]);

    $api->post('word/convert/katakana', [
        'as'    => 'api.word.convert.katakana',
        'uses'  => 'App\Http\Controllers\WordController@convertToKatakana'
    ]);

    $api->post('word/convert/hiragana', [
        'as'    => 'api.word.convert.hiragana',
        'uses'  => 'App\Http\Controllers\WordController@convertToHiragana'
    ]);

    $api->get('words/like/{pattern}/{method?}/{type?}', [
        'as'    => 'api.word.findPattern',
        'uses'  => 'App\Http\Controllers\WordController@getWordsFromPattern'
    ]);


    /**
    * THEMES
    **/
    $api->put('theme', [
        'as'    => 'api.theme.create',
        'uses'  => 'App\Http\Controllers\ThemeController@addTheme'   
    ]);

    $api->post('theme', [
        'as'    => 'api.theme.update',
        'uses'  => 'App\Http\Controllers\ThemeController@updateTheme'   
    ]);

    $api->get('theme/{id?}', [
        'as'    => 'api.theme.get',
        'uses'  => 'App\Http\Controllers\ThemeController@getThemeById'   
    ]);

    $api->delete('theme/{id}', [
        'as'    => 'api.theme.delete',
        'uses'  => 'App\Http\Controllers\ThemeController@deleteTheme'
    ]);

    $api->get('theme/{id}/words', [
        'as'    => 'api.theme.findWords',
        'uses'  => 'App\Http\Controllers\ThemeController@getWordsFromTheme'
    ]);

    $api->get('themes/like/{pattern}/{method?}', [
        'as'    => 'api.theme.findPattern',
        'uses'  => 'App\Http\Controllers\ThemeController@getThemesFromPattern'
    ]);


    /**
    * SEARCH
    */
    $api->post('search', [
        'as'    => 'api.search.findPattern',
        'uses'  => 'App\Http\Controllers\SearchController@getResultsFromPattern'
    ]);

    $api->post('search/autocomplete', [
        'as'    => 'api.search.findPattern',
        'uses'  => 'App\Http\Controllers\SearchController@getAutocompletionResults'
    ]);


    /**
    * PAGES
    */
    $api->put('page', [
        'as'    => 'api.pages.create',
        'uses'  => 'App\Http\Controllers\PageController@addPage'   
    ]);

    $api->post('page', [
        'as'    => 'api.pages.update',
        'uses'  => 'App\Http\Controllers\PageController@updatePage'   
    ]);

    $api->get('page/{id?}', [
        'as'    => 'api.pages.get',
        'uses'  => 'App\Http\Controllers\PageController@getPageById'   
    ]);

    $api->delete('page/{id}', [
        'as'    => 'api.pages.delete',
        'uses'  => 'App\Http\Controllers\PageController@deletePage'   
    ]);

    $api->get('pages/like/{pattern}/{method?}', [
        'as'    => 'api.page.findPattern',
        'uses'  => 'App\Http\Controllers\PageController@getPagesFromPattern'
    ]);

});
