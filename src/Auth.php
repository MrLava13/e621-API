<?php

namespace e621;

class Auth
{
    const
        VERSION = '0.1',
        USERAGENT = 'phpE621/' . self::VERSION . ' (by Mrlavathirteen on e621, ran by ';

    private static $user, $key;

    public static function login(?string $user = null, ?string $key = null)
    {
        if (isset($user)) static::$user = $user;
        if (isset($key)) static::$key = $key;
    }

    public static function generateUserAgent(): string
    {
        return self::USERAGENT . (self::$user ?? 'anonymous') . ')';
    }

    public static function generateHeader(): string
    {
        return (isset(self::$key) && isset(self::$user)) ? 'Authorization: Basic ' . base64_encode(self::$user . ':' . self::$key) : '';
    }
}
