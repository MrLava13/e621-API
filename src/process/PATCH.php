<?php
namespace e621\process;

class PATCH {
    use traits;
    public static function s(string $url, $content = []){
        return static::send(
            $url,
            "PATCH",
            $content
        );
    }
}