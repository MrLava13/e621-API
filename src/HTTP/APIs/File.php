<?php

namespace e621\HTTP\APIs;

use e621\Auth;

class File implements API
{

    private $headers, $params, $method;

    public function setHeaders(array $headers)
    {
        $this->headers = $headers;
    }

    public function setMethod(string $method)
    {
        $this->method = strtoupper($method);
    }

    public function setParams(array $params)
    {
        $this->params = $params;
    }


    public function get(string $url)
    {
        $out = file_get_contents($url, false, stream_context_create([
            'http' => [
                'method' => $this->method,
                'header' => $this->headers ?? [],
                'user_agent' => Auth::getUserAgent(),
                'context' => http_build_query($this->params ?? []),
            ]
        ]));
        return $out;
    }
}
