<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Http\Helpers\JsonHelper;
use App\Http\Helpers\AuthHelper;
use App\Http\Helpers\TransliteratorHelper as Transliterator;
use App\Word as Word;
use App\Theme as Theme;

class WordController extends BaseController
{
    public $timestamps = true;

    /**
    * Method : GET
    * Retuns word with specified id or all
    **/
    public function getWordById(Request $request, $id = null) {
        if (is_null($id)) {
            $words = Word::all();
            $response = JsonHelper::collectionToArray($words);
        } else {
            $word = Word::find($id);
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
            $word = new Word();
            $word->kanji = $data['kanji'];
            $word->kana = $data['kana'];
            $word->romaji = $data['romaji'];
            $word->meaning = $data['meaning'];
            $word->notes = $data['notes'];
            $word->save();

            $themes = $data['themes'];
            foreach ($themes as $theme) {
                $oTheme = Theme::where('id', $theme['id'])->first();
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
            $word = Word::find($data['id']);
            
            if ($word) {
                $word->kanji = $data['kanji'];
                $word->kana = $data['kana'];
                $word->romaji = $data['romaji'];
                $word->meaning = $data['meaning'];
                $word->notes = $data['notes'];
                $word->save();

                $word->themes()->detach();
                $themes = $data['themes'];
                foreach ($themes as $theme) {
                    $oTheme = Theme::where('id', $theme['id'])->first();
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
            $response = Word::destroy($id);
        } else {
            $response = '{"Error":"No id provided."}';
        } 

        return response()->json($response);
    }

    /**
    * Method : GET
    * Retrieve all word like given pattern
    * Method can be 'begins' or 'contains'
    * Type can be 'all', 'romaji', 'meaning'
    * Default is 'begins', 'all'
    **/
    public function getWordsFromPattern($pattern, $method = 'begins', $type = 'all') {
        if (!empty($pattern)) {
            $pattern .= '%';
            if ($method == 'contains') {
                $pattern = '%' . $pattern;
            }
             
            switch ($type) {
                case 'romaji':
                    $result = Word::where('romaji', 'like', $pattern)->get();  
                    break;
                case 'meaning':
                    $result = Word::where('meaning', 'like', $pattern)->get();  
                    break;
                default:
                    $result = Word::where('romaji', 'like', $pattern)
                        ->orWhere('meaning', 'like', $pattern)->get();
                    break;
            }
            
            $response = JsonHelper::collectionToArray($result);
        } else {
            $response = '{"Error":"No pattern provided."}';
        } 

        return response()->json($response);
    }

    /**
    * Method : POST
    * Convert a kana string to Romaji
    **/
    public function convertToRomaji(Request $request) {
        $requestData = $request->all();
        $data = strtolower($requestData['data']);

        if (!empty($data)) {
            $response = JsonHelper::stringToJson('result', Transliterator::toRomaji($data));
        } else {
            $response = '{"Error":"No data provided"}';
        }

        return response()->json($response);
    }

    /**
    * Method : POST
    * Convert a romaji string to hiragana
    **/
    public function convertToHiragana(Request $request) {
        $requestData = $request->all();
        $data = strtolower($requestData['data']);

        if (!empty($data)) {
            $response = JsonHelper::stringToJson('result', Transliterator::toHiragana($data));
        } else {
            $response = '{"Error":"No data provided"}';
        }

        return response()->json($response);
    }

    /**
    * Method : POST
    * Convert a romaji string to katakana
    **/
    public function convertToKatakana(Request $request) {
        $requestData = $request->all();
        $data = strtolower($requestData['data']);

        if (!empty($data)) {
            $response = JsonHelper::stringToJson('result', Transliterator::toKatakana($data));
        } else {
            $response = '{"Error":"No data provided"}';
        }

        return response()->json($response);
    }


    /**
    * Method : GET
    * Generate kana for words
    * Update database records
    **/
    public function generateKana() {
        $words = Word::all();

        foreach ($words as $word) {
            $kana = '';
            $romaji = $word->romaji;
            var_dump($romaji);
            
            var_dump($kana);
            echo'<br/>';
            
        }
        $response = JsonHelper::collectionToArray($words);

        return response()->json($response);
    }

    /**
    * Method : GET
    * Generate romaji for words
    * Update database records
    **/
    public function generateRomaji($forceAll = false) {
        if (!$forceAll) {
            $words = Word::where('romaji', '=', '')->get();
        } else {
            $words = Word::all();
        }

        $count = 0;
        foreach ($words as $word) {
            $kana = $word->kana;
            $romaji = Transliterator::toRomaji($kana);
            $word->romaji = $romaji;
            $word->save();
            $count++;
        }

        $response = JsonHelper::stringToJson('processed', $count);
        return response()->json($response);
    }
}
