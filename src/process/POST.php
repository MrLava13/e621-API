<?php
namespace e621\process;

class POST {
    use traits;
    public static function s(string $url, array $params = []){
        return static::send($url, false, static::gen("POST",["content"=>http_build_query($params)]));
    }
}