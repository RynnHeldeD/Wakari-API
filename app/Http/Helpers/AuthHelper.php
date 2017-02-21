<?php

namespace App\Http\Helpers;

use JWTAuth;

class AuthHelper
{
    public static function checkAuth() {
        $response = array(
            "code" => 200,
            "message" => ""
        );

        try{
            if (! $user = JWTAuth::parseToken()->authenticate()) {
                $response['code'] = 404;
                $response['message'] = response()->json(['user_not_found'], 404);
            }
        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            $response['code'] = $e->getStatusCode();
            $response['message'] = response()->json(['token_expired'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            $response['code'] = $e->getStatusCode();
            $response['message'] = response()->json(['token_invalid'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
            $response['code'] = $e->getStatusCode();
            $response['message'] = response()->json(['token_absent'], $e->getStatusCode());
        }

        return $response;
    }
}
