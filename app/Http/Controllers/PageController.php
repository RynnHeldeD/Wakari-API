<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Http\Helpers\JsonHelper;
use App\Http\Helpers\AuthHelper;
use App\Page as Page;
use App\Theme as Theme;

class PageController extends BaseController
{
    public $timestamps = true;

    /**
    * Method : GET
    * Retuns page with specified id or all
    **/
    public function getPageById(Request $request, $id = null) {
        if (is_null($id)) {
            $pages = Page::all();
            $response = JsonHelper::collectionToArray($pages);
        } else {
            $page = Page::find($id);
            if (!is_null($page)) {
                $response = JsonHelper::objectToArray($page);
                $response['themes'] = JsonHelper::collectionToArray($page->themes);
                $response['pages'] = JsonHelper::collectionToArray($page->pagesLinkedFrom);
            } else {
                $response = '{"Error":"No page with id found."}';
            }
        }

        return response()->json($response);
    }


    /**
    * Method : PUT
    * Create page
    **/
    public function addPage(Request $request) {
        $requestData = $request->all();
        $data = json_decode($requestData['data'], true);

        if (!empty($data)) {
            $page = new Page();
            $page->name = $data['name'];
            $page->content = $data['content'];
            $page->save();
            
            $themes = $data['themes'];
            foreach ($themes as $theme) {
                $oTheme = Theme::where('id', $theme['id'])->first();
                if ($oTheme) {
                    $page->themes()->save($oTheme);
                }
            }

            $pages = $data['pages'];
            foreach ($pages as $linkedPage) {
                $oPage = Page::where('id', $linkedPage['id'])->first();
                if ($oPage) {
                    $page->pagesLinkedFrom()->save($oPage);
                }
            }

            $response = JsonHelper::objectToArray($page);
            $response['themes'] = JsonHelper::collectionToArray($page->themes);
            $response['pages'] = JsonHelper::collectionToArray($page->pagesLinkedFrom);
        } else {
            $response = '{"Error":"No data provided."}';
        }

        return response()->json($response);
    }


    /**
    * Method : POST
    * Update page with data
    **/
    public function updatePage(Request $request) {
        $requestData = $request->all();
        $data = json_decode($requestData['data'], true);

        if (!empty($data)) {
            $page = Page::find($data['id']);
            
            if ($page) {
                $page->name = $data['name'];
                $page->content = $data['content'];
                $page->save();

                $page->themes()->detach();
                $themes = $data['themes'];
                foreach ($themes as $theme) {
                    $oTheme = Theme::where('id', $theme['id'])->first();
                    if ($oTheme) {
                        $page->themes()->save($oTheme);
                    }
                }

                $page->pagesLinkedFrom()->detach();
                $pages = $data['pages'];
                foreach ($pages as $linkedPage) {
                    $oPage = Page::where('id', $linkedPage['id'])->first();
                    if ($oPage) {
                        $page->pagesLinkedFrom()->save($oPage);
                    }
                }

                $response = JsonHelper::objectToArray($page);
                $response['themes'] = JsonHelper::collectionToArray($page->themes);
                $response['pages'] = JsonHelper::collectionToArray($page->pagesLinkedFrom);
            } else {
                $response = '{"Error":"No page with id found."}';
            }
        } else {
            $response = '{"Error":"No data provided."}';
        }

        return response()->json($response);
    }

    
    /**
    * Method : DELETE
    * Delete page with specified id 
    **/
    public function deletePage(Request $request, $id) {
        if (!empty($id) && is_numeric($id)) {
            $response = Page::destroy($id);
        } else {
            $response = '{"Error":"No id provided."}';
        } 

        return response()->json($response);
    }

    /**
    * Method : GET
    * Retrieve all page like given pattern
    * Method can be 'begins' or 'contains'
    * Default is 'begins'
    **/
    public function getPagesFromPattern($pattern, $method = 'begins') {
        if (!empty($pattern)) {
            $pattern .= '%';
            if ($method == 'contains') {
                $pattern = '%' . $pattern;
            }

            $result = Page::where('name', 'like', $pattern)->get();
            
            $response = JsonHelper::collectionToArray($result);
        } else {
            $response = '{"Error":"No pattern provided."}';
        } 

        return response()->json($response);
    }

}
