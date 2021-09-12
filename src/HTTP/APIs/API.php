<?php

namespace e621\HTTP\APIs;

interface API
{

    public function setMethod(string $method);

    /**
     * 
     * @param string[] $headers 
     * @return mixed 
     */

    public function setHeaders(array $headers);

    /**
     * @param array<string,mixed> $params 
     * @return mixed 
     */

    public function setParams(array $params);

    /**
     * 
     * @return string|false 
     */

    public function get(string $url);
}
