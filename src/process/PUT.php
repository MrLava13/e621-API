<?php
namespace e621\process;

class PUT {
    use traits;
    public static function s(string $url, $content = []){
        return static::send(
            $url,
            "PUT",
            $content
        );
    }
}