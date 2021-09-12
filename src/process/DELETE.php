<?php

namespace e621\process;

/**
 * ONLY works with notes
 */

class DELETE extends process
{
    public static function s(string $url, array $content = [])
    {
        return static::send(
            $url,
            'DELETE'
        );
    }
}
