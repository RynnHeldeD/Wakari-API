<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Http\Helpers\JsonHelper;
use App\Http\Helpers\AuthHelper;

class SearchController extends BaseController
{
    /**
    * Method : GET
    * Retuns everything matching specified pattern
    **/
    public function getResultsFromPattern($pattern) {
        if (!empty($pattern)) {
            $romaji = \App\Word::where('romaji', 'like', $pattern . '%')->get();
            $meanings = \App\Word::where('meaning', 'like', '%'. $pattern . '%')->get();
            $themes = \App\Theme::where('name', 'like', $pattern . '%')->get();
            
            $response =  [];
            if (!$romaji->isEmpty()) {
                $response['romaji'] = JsonHelper::collectionToArray($romaji);
            }
            if (!$meanings->isEmpty()) {
                $response['meanings'] = JsonHelper::collectionToArray($meanings);
            }
            if (!$themes->isEmpty()) {
                $response['themes'] = JsonHelper::collectionToArray($themes);
            }
        } else {
            $response = '{"Error":"No pattern given."}';
        }

        return response()->json($response);
    }

    /**
    * Method : GET
    * Retuns everything matching specified pattern for autocompletion
    **/
    public function getAutocompletionResults($pattern) {
        if (!empty($pattern)) {
            $romaji = \App\Word::where('romaji', 'like', $pattern . '%')->get();
            $meanings = \App\Word::where('meaning', 'like', '%'. $pattern . '%')->get();
            $themes = \App\Theme::where('name', 'like', $pattern . '%')->get();
            
            $response = [];
            if (!$romaji->isEmpty()) {
                foreach ($romaji as $word) {
                    $response[] = (Object) [
                        'id' => $word->id,
                        'name' => $word->romaji,
                        'type' => 'word'
                    ];
                }
            }

            if (!$meanings->isEmpty()) {
                foreach ($meanings as $word) {
                    $response[] = (Object) [
                        'id' => $word->id,
                        'name' => $word->meaning,
                        'type' => 'word'
                    ];
                }
            }

            if (!$themes->isEmpty()) {
                foreach ($themes as $theme) {
                    $response[] = (Object) [
                        'id' => $theme->id,
                        'name' => $theme->name,
                        'type' => 'theme'
                    ];
                }
            }
        } else {
            $response = '{"Error":"No pattern given."}';
        }

        return response()->json($response);
    }
}
