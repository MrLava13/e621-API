<?php

namespace e621\HTTP\APIs;

use e621\HTTP\Method;

interface API
{
    /**
     * @param string $url
     * @param Method $method
     * @param array $content
     * @return string 
     */

    public function call(string $url, Method $method, array $content = []) : string;
}
