<?php

namespace e621\HTTP\APIs;

use e621\Auth;
use e621\HTTP\Method;
use e621\HTTPException;


class File implements API
{
    public function call(string $url, Method $method, array $content = []): string
    {
        $context = http_build_query((is_array($content) || !empty($content) ? $content : []));
        if ($method == Method::GET) {
            $url .= '?' . $context;
        }
        $out = @file_get_contents($url, false, stream_context_create([
            'http' => [
                'method' => Method::methodToString($method),
                'header' => [Auth::generateHeader()],
                'user_agent' => Auth::generateUserAgent(),
                'context' => $context,
            ]
        ]));
        if ($out === false) {
            throw new HTTPException(isset($http_response_header[0]) ? explode(' ', $http_response_header[0])[1] : 0);
        }
        return $out;
    }
}
