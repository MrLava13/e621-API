<?php

namespace e621\HTTP\APIs;

use e621\Auth;
use e621\HTTP\Method;
use e621\HTTPException;

use function e621\HTTP\methodToString;

class CURL implements API
{
    private static $curl;

    public function call(string $url, Method $method, $content = [])
    {
        if (!isset(self::$curl)) self::$curl = curl_init();
        $m = methodToString($method);
        curl_setopt_array(self::$curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_CUSTOMREQUEST => $m,
            CURLOPT_POST => $m === 'POST',
            CURLOPT_PUT => $m === 'PUT',
            CURLOPT_POSTFIELDS => (is_array($content) || !empty($content) ? $content : ''),
            CURLOPT_USERAGENT => Auth::generateUserAgent(),
            CURLOPT_HTTPHEADER => [Auth::generateHeader()]
        ]);
        $out = curl_exec(self::$curl);
        switch ($code = curl_getinfo(self::$curl, CURLINFO_HTTP_CODE)) {
            case 200: // All good
            case 204: // For PATCH
                return $out;
            default:
                throw new HTTPException($code);
        }
    }
}
