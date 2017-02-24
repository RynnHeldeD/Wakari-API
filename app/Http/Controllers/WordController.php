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
            $json = JsonHelper::collectionToArray($words);
        } else {
            $word = \App\Word::find($id);
            if (!is_null($word)) {
                $json = JsonHelper::objectToArray($word);
            } else {
                $json = '{"Error":"No word with id found."}';
            }
        }

        return response()->json($json);
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

            $json = JsonHelper::objectToArray($word);
            $response = response()->json($json);
        } else {
            $response = response()->json('{"Error":"No data provided."}');
        }

        return $response;
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
                $json = JsonHelper::objectToArray($word);
                $response = response()->json($json);
            } else {
                $response = response()->json('{"Error":"No word with id found."}');
            }
        } else {
            $response = response()->json('{"Error":"No data provided."}');
        }

        return $response;
    }

    
    /**
    * Method : DELETE
    * Delete word with specified id 
    **/
    public function deleteWord(Request $request) {
        $requestData = $request->all();
        $data = json_decode($requestData['data'], true);

        if (!empty($data)) {
            $result = \App\Word::destroy($data['id']);
            $response = response()->json($result);
        } else {
            $response = response()->json('{"Error":"No id provided."}');
        } 

        return $response;
    }
}
