<?php
namespace e621\process;

class GET {
    use traits;
    public static function s(string $url, array $params = []){
        return static::send($url.http_build_query($params), false, static::gen("GET"));
    }
}