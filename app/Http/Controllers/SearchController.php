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
            
            if (!empty($romaji)) {
                $response['romaji'] = JsonHelper::collectionToArray($romaji);
            }
            if (!empty($meanings)) {
                $response['meanings'] = JsonHelper::collectionToArray($meanings);
            }
            if (!empty($themes)) {
                $response['themes'] = JsonHelper::collectionToArray($themes);
            }
        } else {
            $response = '{"Error":"No pattern given."}';
        }

        return response()->json($response);
    }
}
