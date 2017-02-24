<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Http\Helpers\JsonHelper;
use App\Http\Helpers\AuthHelper;

class ThemeController extends BaseController
{
    public $timestamps = true;

    /**
    * Method : GET
    * Retuns theme with specified id or all
    **/
    public function getThemeById(Request $request, $id = null) {
        if (is_null($id)) {
            $themes = \App\Theme::all();
            $json = JsonHelper::collectionToArray($themes);
        } else {
            $theme = \App\Theme::find($id);
            if (!is_null($theme)) {
                $json = JsonHelper::objectToArray($theme);
            } else {
                $json = '{"Error":"No theme with id found."}';
            }
        }

        return response()->json($json);
    }


    /**
    * Method : PUT
    * Create theme
    **/
    public function addTheme(Request $request) {
        $requestData = $request->all();
        $data = json_decode($requestData['data'], true);

        if (!empty($data)) {
            $theme = new \App\Theme();
            $theme->kanji = $data['kanji'];
            $theme->kana = $data['kana'];
            $theme->romaji = $data['romaji'];
            $theme->meaning = $data['meaning'];
            $theme->notes = $data['notes'];
            $theme->save();

            $json = JsonHelper::objectToArray($theme);
            $response = response()->json($json);
        } else {
            $response = response()->json('{"Error":"No data provided."}');
        }

        return $response;
    }


    /**
    * Method : POST
    * Update theme with data
    **/
    public function updateTheme(Request $request) {
        $requestData = $request->all();
        $data = json_decode($requestData['data'], true);

        if (!empty($data)) {
            $theme = \App\Theme::find($data['id']);
            
            if ($theme) {
                $theme->kanji = $data['kanji'];
                $theme->kana = $data['kana'];
                $theme->romaji = $data['romaji'];
                $theme->meaning = $data['meaning'];
                $theme->notes = $data['notes'];
                $theme->save();
                $json = JsonHelper::objectToArray($theme);
                $response = response()->json($json);
            } else {
                $response = response()->json('{"Error":"No theme with id found."}');
            }
        } else {
            $response = response()->json('{"Error":"No data provided."}');
        }

        return $response;
    }

    
    /**
    * Method : DELETE
    * Delete theme with specified id 
    **/
    public function deleteTheme(Request $request, $id) {
        if (!empty($id) && is_numeric($id)) {
            $result = \App\Theme::destroy($id);
            $response = response()->json($result);
        } else {
            $response = response()->json('{"Error":"No id provided."}');
        } 

        return $response;
    }

    /**
    * Method : GET
    * Return all words which are linked to provided theme id
    **/
    public function getWordsFromTheme(Request $request, $key) {
        if (!empty($key)) {
            if ( is_numeric($key) ) {
                $theme = \App\Theme::find($key);
            } else {
                $theme = \App\Theme::where('name', $key)->first();
            }

            $result = [];
            if (!empty($theme)) {
                $result = JsonHelper::collectionToArray($theme->words);
            }
        } else {
            $result = '{"Error":"No id provided."}';
        } 

        return response()->json($result);
    }
}
