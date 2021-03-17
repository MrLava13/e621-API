<?php
namespace e621\process;

class PATCH extends process {
    public static function s(string $url, array $content = []){
        return self::send(
            $url,
            'PATCH',
            $content
        );
    }
}