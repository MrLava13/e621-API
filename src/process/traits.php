<?php
namespace e621\process;

use \e621\Auth;
use e621\exceptions\http\forbidden;
use e621\exceptions\http\other;
use e621\exceptions\http\serverError;
use e621\exceptions\http\throttled;

trait traits {
    private static $version = "0.1", $curl;

    private static function send(string $url, string $method, $params = ""){
        if(!isset(static::$curl)) static::$curl = curl_init();
        curl_setopt_array(static::$curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_POST => $method === "POST" ? true : false,
            CURLOPT_PUT => $method === "PUT" ? true : false,
            CURLOPT_POSTFIELDS => (is_array($params) || !empty($params) ? $params : ""),
            CURLOPT_USERAGENT => "phpE621/".static::$version." (by Mrlavathirteen on e621, run by ".(!empty(Auth::user()) ? Auth::user() : "an anonymous user").")",
            CURLOPT_HTTPHEADER => [
                !empty(Auth::user()) ? "Authorization: Basic ". base64_encode(Auth::user().":".Auth::api()) : ""
            ]
        ]);
        $out = curl_exec(static::$curl);
        if($error = curl_error(static::$curl))
            throw new other($error);
        switch($code = curl_getinfo(static::$curl,CURLINFO_HTTP_CODE)){
            case 200: // For everything else
            case 204: // For PATCH
                return $out; 
            break;
            // 400 errors
            case 403: throw new forbidden("Access denied... This page might need a login...",403); break;
            case 421: throw new throttled("You have throttled the connection to the API",421); break;
            // 500 errors
            case 500: throw new serverError("There was an internal server error, try again later.",500); break;
            // Other errors
            default: throw new other("There was an error",$code); break;
        }
    }
}