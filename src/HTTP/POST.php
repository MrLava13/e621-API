<?php

namespace e621\HTTP;

use e621\HTTP\APIs\API;

class POST implements HTTP
{

    /**
     * @var API
     */

    private static $api;

    /**
     * @param API $api 
     * @return void 
     */

    public static function useAPI(API $api)
    {
        self::$api = $api;
    }

    public static function fetch(string $url, ?array $data)
    {
        self::$api->setMethod('POST');
        self::$api->setParams($data ?? []);
        return self::$api->get($url);
    }
}
