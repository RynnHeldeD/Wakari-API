<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Http\Helpers\JsonHelper;
use App\Http\Helpers\AuthHelper;

class WordController extends BaseController
{
    public $timestamps = true;

    /**
    * Method : GET
    * Retuns word with specified id or all
    **/
    public function getWordById(Request $request, $id = null) {
        if (is_null($id)) {
            $words = \App\Word::all();
            $response = JsonHelper::collectionToArray($words);
        } else {
            $word = \App\Word::find($id);
            if (!is_null($word)) {
                $response = JsonHelper::objectToArray($word);
                $response['themes'] = JsonHelper::collectionToArray($word->themes);
            } else {
                $response = '{"Error":"No word with id found."}';
            }
        }

        return response()->json($response);
    }


    /**
    * Method : PUT
    * Create word
    **/
    public function addWord(Request $request) {
        $requestData = $request->all();
        $data = json_decode($requestData['data'], true);

        if (!empty($data)) {
            $word = new \App\Word();
            $word->kanji = $data['kanji'];
            $word->kana = $data['kana'];
            $word->romaji = $data['romaji'];
            $word->meaning = $data['meaning'];
            $word->notes = $data['notes'];
            $word->save();

            $themes = $data['themes'];
            foreach ($themes as $themeName) {
                $oTheme = \App\Theme::where('name', $themeName)->first();
                if ($oTheme) {
                    $word->themes()->save($oTheme);
                }
            }

            $response = JsonHelper::objectToArray($word);
            $response['themes'] = JsonHelper::collectionToArray($word->themes);
        } else {
            $response = '{"Error":"No data provided."}';
        }

        return response()->json($response);
    }


    /**
    * Method : POST
    * Update word with data
    **/
    public function updateWord(Request $request) {
        $requestData = $request->all();
        $data = json_decode($requestData['data'], true);

        if (!empty($data)) {
            $word = \App\Word::find($data['id']);
            
            if ($word) {
                $word->kanji = $data['kanji'];
                $word->kana = $data['kana'];
                $word->romaji = $data['romaji'];
                $word->meaning = $data['meaning'];
                $word->notes = $data['notes'];
                $word->save();

                $word->themes()->detach();
                $themes = $data['themes'];
                foreach ($themes as $themeName) {
                    $oTheme = \App\Theme::where('name', $themeName)->first();
                    if ($oTheme) {
                        $word->themes()->save($oTheme);
                    }
                }

                $response = JsonHelper::objectToArray($word);
                $response['themes'] = JsonHelper::collectionToArray($word->themes);
            } else {
                $response = '{"Error":"No word with id found."}';
            }
        } else {
            $response = '{"Error":"No data provided."}';
        }

        return response()->json($response);
    }

    
    /**
    * Method : DELETE
    * Delete word with specified id 
    **/
    public function deleteWord(Request $request, $id) {
        if (!empty($id) && is_numeric($id)) {
            $result = \App\Word::destroy($id);
            $response = response()->json($result);
        } else {
            $response = response()->json('{"Error":"No id provided."}');
        } 

        return $response;
    }
}
