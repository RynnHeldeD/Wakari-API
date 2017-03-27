<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Http\Helpers\JsonHelper;
use App\Http\Helpers\AuthHelper;
use App\Theme as Theme;
use App\Word as Word;



class SearchController extends BaseController
{
    /**
    * Method : POST
    * Retuns everything matching specified pattern
    **/
    public function getResultsFromPattern(Request $request) {
        $requestData = $request->all();
        $data = json_decode($requestData['data'], true);
        if (!empty($data)) {
            $romaji = Word::where('romaji', 'like', $data . '%')->get();
            $meanings = Word::where('meaning', 'like', '%'. $data . '%')->get();
            $themes = Theme::where('name', 'like', $data . '%')->get();
            
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
    * Method : POST
    * Retuns everything matching specified pattern for autocompletion
    **/
    public function getAutocompletionResults(Request $request) {
        $requestData = $request->all();
        $data = json_decode($requestData['data'], true);
        if (!empty($data)) {
            $romaji = Word::where('romaji', 'like', $data . '%')->get();
            $meanings = Word::where('meaning', 'like', '%'. $data . '%')->get();
            $themes = Theme::where('name', 'like', $data . '%')->get();
            
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

            usort($response, function($a, $b)
            {
                return strcmp($a->name, $b->name);
            });
        } else {
            $response = '{"Error":"No pattern given."}';
        }

        return response()->json($response);
    }
}
