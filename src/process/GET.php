<?php
namespace e621\process;

class GET {
    use traits;
    public static function s(string $url, array $params = []){
        return static::send($url.(count($params) > 0 ? "?". http_build_query($params): ""), false, static::gen("GET"));
    }
}