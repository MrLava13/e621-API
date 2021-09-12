<?php

namespace e621\process;

class PUT extends process {
    public static function s(string $url, array $content = []) {
        return self::send(
            $url,
            'PUT',
            $content
        );
    }
}
