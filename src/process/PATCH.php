<?php
namespace e621\process;

class PATCH {
    use traits;
    public static function s(string $url, string $data){
        return static::send($url, false, static::gen("PATCH",["content"=>$data]));
    }
}