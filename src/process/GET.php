<?php
namespace e621\process;

class GET {
    use traits;
    public static function s(string $url, $content = []){
        return static::send(
            $url.(count($content) > 0 ? "?".http_build_query($content) : ""),
            "GET",
            $content
        );
    }
}