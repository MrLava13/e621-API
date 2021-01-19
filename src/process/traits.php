<?php
namespace e621\process;

use \e621\Auth;
use e621\exceptions\http\forbidden;
use e621\exceptions\http\other;
use e621\exceptions\http\serverError;
use e621\exceptions\http\throttled;

trait traits {
    private static $version = "0.1";

    private static function send(...$data){
        $out = @file_get_contents(...$data);
        if(!preg_match('/(?<= )\d{3}(?= )/', $http_response_header[0],$m))
            throw new other("The server responded without a responce code");
        switch($m[0]){
            case 200: // For everything else
            case 204: // For PATCH
                return $out; break;
            // 400 errors
            case 403: throw new forbidden("Access denied... This page might need a login..."); break;
            case 421: throw new throttled("You have throttled the connection to the API"); break;
            // 500 errors
            case 500: throw new serverError("There was an internal server error, try again later."); break;
            // Other errors
            default: throw new other("There was an error",$m[0]); break;
        }
    }



    /**
     * 
     * @param string $method The method of sending the request: `GET`, `POST`, `PATCH`, and `DELETE`
     * @return resource
     */
    private static function gen(string $method, array $other = []){
        $context = [
            "http" => [
                "method" => $method,
                "user_agent" => "phpE621/".static::$version." (by Mrlavathirteen on e621, run by an anonymous user)"
            ]
        ];
        foreach($other as $part) $context["http"] = array_merge($context["http"],$part);
        if(!empty(Auth::user()) && !empty(Auth::api())){
            $context["http"]["header"] = 
                (isset($context["http"]["header"]) ? $context["http"]["header"] ."\n": "" ). // Old headers (If they are set)
                "Authorization: Basic ". base64_encode(Auth::user().":".Auth::api());
            $context["http"]["user_agent"] = "phpE621/".static::$version." (by Mrlavathirteen on e621, run by " . Auth::user() . ")";
        }

        return stream_context_create($context);
    }
}