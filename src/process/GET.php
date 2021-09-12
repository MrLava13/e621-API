<?php

namespace e621\process;

class GET extends process
{
    public static function s(string $url, array $content = [])
    {
        return self::send(
            $url . (count($content) > 0 ? '?' . http_build_query($content) : ''),
            'GET',
            $content
        );
    }
}
