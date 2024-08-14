<?php

namespace E621api\HTTP\APIs;

use E621api\HTTP\Method;

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
