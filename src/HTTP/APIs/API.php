<?php

namespace e621\HTTP\APIs;

use e621\HTTP\Method;

interface API
{
    /**
     * @param Method $method
     * @param string|array $content
     * @return string|false 
     */

    public function call(string $url, Method $method, $content = []);
}
