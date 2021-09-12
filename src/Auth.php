<?php

namespace e621;

class Auth
{

    const VERSION = '0.1';
    const USERAGENT = 'phpE621/' . self::VERSION . ' (by Mrlavathirteen on e621, ran by ';

    private static $user, $api;

    public function __construct(?string $user, ?string $api)
    {
        if (isset($user)) static::user($user);
        if (isset($api)) static::api($api);
    }

    /**
     * Sets and/or Fetches the username
     * 
     * @param string|null The username if setting, null if fetching
     * @return string
     */

    public static function user(?string $user = null)
    {
        if (isset($user)) static::$user = $user;
        return static::$user;
    }

    /**
     * Sets and/or Fetches the api key
     * 
     * @param string|null The api key if setting, null if fetching
     * @return string
     */

    public static function api(?string $key = null)
    {
        if (isset($key)) static::$api = $key;
        return static::$api;
    }

    public static function getUserAgent(): string
    {
        return self::USERAGENT . (self::$user ?? 'an anonymous user') . ')';
    }
}
