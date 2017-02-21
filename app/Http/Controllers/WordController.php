<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Http\Helpers\JsonHelper;
use App\Http\Helpers\AuthHelper;

class WordController extends BaseController
{
    /**
    * Retuns all words
    **/
    public function getWords(Request $request) {
        $response = AuthHelper::checkAuth();
        if ($response['code'] == 200) {
            $words = \App\Word::all();
            $json = JsonHelper::collectionToArray($words);
            $response['message'] = response()->json($json, 200);
        } 

        return $response['message'];
    }

    /**
    * Retuns word with specified id
    **/
    public function getWordById(Request $request, $id) {
       $response = AuthHelper::checkAuth();
        if ($response['code'] == 200) {
            $word = \App\Word::find($id);
            $json = JsonHelper::objectToArray($word);
            $response['message'] = response()->json($json, 200);
        } 

        return $response['message'];
    }

    /**
    * Create word with POST data
    **/
    public function addWord(Request $request) {
        $response = AuthHelper::checkAuth();
        if ($response['code'] == 200) {
            $requestData = $request->all();
            if (isset($requestData['data'])) {
                $data = json_decode($requestData['data'], true);

                $word = new \App\Word();
                $word->kanji = $data['kanji'];
                $word->kana = $data['kana'];
                $word->romaji = $data['romaji'];
                $word->meaning = $data['meaning'];
                $word->note = $data['note'];
                $word->save();

                $json = JsonHelper::objectToArray($word);
                $response['message'] = response()->json([$json, 200]);
            } else {
                $response['message'] = response()->json(['No data', 200]);
            }
        } 

        return $response['message'];
    }

    /**
    * Delete word with specified id
    **/
    public function deleteWord(Request $request, $id) {
        $response = AuthHelper::checkAuth();
        if ($response['code'] == 200) {
            $result = \App\Word::destroy($id);
            
            $response['message'] = response()->json($result, 200);
        } 

        return $response['message'];
    }

    /**
    * Update word with POST data
    **/
    public function updateWord(Request $request) {
        $response = AuthHelper::checkAuth();
        if ($response['code'] == 200) {
            $requestData = $request->all();
            if (isset($requestData['data'])) {
                $data = json_decode($requestData['data'], true);

                $word = \App\Word::find($data['id']);
                $word->kanji = $data['kanji'];
                $word->kana = $data['kana'];
                $word->romaji = $data['romaji'];
                $word->meaning = $data['meaning'];
                $word->note = $data['note'];
                $word->save();

                $json = JsonHelper::objectToArray($word);
                $response['message'] = response()->json([$json, 200]);
            } else {
                $response['message'] = response()->json(['No data', 200]);
            }
        } 

        return $response['message'];
    }
}
