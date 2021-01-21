<?php
namespace e621\process;

class POST {
    use traits;
    public static function s(string $url, $content = []){
        return static::send(
            $url,
            "POST",
            $content
        );
    }
}