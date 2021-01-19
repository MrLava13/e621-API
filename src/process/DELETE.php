<?php
namespace e621\process;

/**
 * ONLY works with notes
 */

class DELETE {
    use traits;
    public static function s(string $url){
        return static::send($url, false, static::gen("DELETE"));
    }
}