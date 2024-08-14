<?php

namespace e621;

class Auth
{
    private static $user, $key;

    public static function login(?string $user = null, ?string $key = null): void
    {
        if (isset($user)) static::$user = $user;
        if (isset($key)) static::$key = $key;
    }

    public static function generateUserAgent(): string
    {
        return Defaults::PROGRAM_NAME . '/' . Defaults::VERSION . ' (by ' . (self::$user ?? 'anonymous') . ')';
    }

    public static function generateHeader(): string
    {
        return (isset(self::$key) && isset(self::$user)) ? 'Authorization: Basic ' . base64_encode(self::$user . ':' . self::$key) : '';
    }
}
