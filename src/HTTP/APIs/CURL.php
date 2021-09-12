<?php

namespace e621\HTTP\APIs;

use e621\Auth;

class CURL implements API
{
    private $curl;
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
        curl_setopt_array($this->curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_CUSTOMREQUEST => $this->method,
            CURLOPT_POST => $this->method === 'POST',
            CURLOPT_PUT => $this->method === 'PUT',
            CURLOPT_POSTFIELDS => $this->params ?? '',
            CURLOPT_USERAGENT => Auth::getUserAgent(),
            CURLOPT_HTTPHEADER => $this->headers ?? []
        ]);
        if (($out = curl_exec($this->curl)) !== false) return $out;
        return false;
    }
}
