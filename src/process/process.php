<?php

namespace e621\process;

use e621\Auth;
use e621\exceptions\http\forbidden;
use e621\exceptions\http\other;
use e621\exceptions\http\serverError;
use e621\exceptions\http\throttled;

abstract class process
{
    private static $version = '0.1', $curl;

    protected static function send(string $url, string $method, $params = '')
    {
        if (!isset(self::$curl)) self::$curl = curl_init();
        curl_setopt_array(self::$curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_POST => $method === 'POST',
            CURLOPT_PUT => $method === 'PUT',
            CURLOPT_POSTFIELDS => (is_array($params) || !empty($params) ? $params : ''),
            CURLOPT_USERAGENT => 'phpE621/' . self::$version . ' (by Mrlavathirteen on e621, ran by ' . (!empty(Auth::user()) ? Auth::user() : 'an anonymous user') . ')',
            CURLOPT_HTTPHEADER => [
                !empty(Auth::user()) ?
                    'Authorization: Basic ' . base64_encode(Auth::user() . ':' . Auth::api()) :
                    ''
            ]
        ]);
        $out = curl_exec(self::$curl);
        if ($error = curl_error(self::$curl))
            throw new other($error);
        switch ($code = curl_getinfo(self::$curl, CURLINFO_HTTP_CODE)) {
            case 200: // For everything else
            case 204: // For PATCH
                return $out;
                // 400 errors
            case 403:
                throw new forbidden('Access denied... This page might need a login...', 403);
            case 421:
                throw new throttled('You have throttled the connection to the API', 421);
                // 500 errors
            case 500:
                throw new serverError('There was an internal server error, try again later.', 500);
                // Other errors
            default:
                throw new other('There was an error', $code);
        }
    }

    abstract public static function s(string $url, array $content = []);
}
