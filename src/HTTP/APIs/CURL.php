<?php

namespace e621\HTTP\APIs;

use e621\Auth;
use e621\HTTP\Method;
use e621\HTTPException;

class CURL implements API
{
    private $curl;

    public function __construct()
    {
        $this->curl = curl_init();
    }

    public function __destruct()
    {
        curl_close($this->curl);
    }

    public function call(string $url, Method $method, array $content = []): string
    {
        $m = Method::methodToString($method);
        curl_setopt_array($this->curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_CUSTOMREQUEST => $m,
            CURLOPT_POST => $m === 'POST',
            CURLOPT_PUT => $m === 'PUT',
            CURLOPT_POSTFIELDS => (is_array($content) || !empty($content) ? $content : ''),
            CURLOPT_USERAGENT => Auth::generateUserAgent(),
            CURLOPT_HTTPHEADER => [Auth::generateHeader()]
        ]);
        $out = curl_exec($this->curl);
        switch ($code = curl_getinfo($this->curl, CURLINFO_HTTP_CODE)) {
            case 200: // All good
            case 204: // For PATCH
                return $out;
            default:
                throw new HTTPException($code);
        }
    }
}
