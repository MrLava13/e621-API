<?php

namespace e621\process;

class POST extends process
{
    public static function s(string $url, array $content = [])
    {
        return self::send(
            $url,
            'POST',
            $content
        );
    }
}
