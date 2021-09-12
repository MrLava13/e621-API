<?php

namespace e621\HTTP;

use e621\HTTP\APIs\API;

interface HTTP
{
    public static function useAPI(API $api);
    public static function fetch(string $url, array $data);
}
