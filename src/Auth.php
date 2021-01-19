<?php
namespace e621;

class Auth {
    private static $user = "", $api = "";

    public function __construct(string $user = null, string $api = null){
        if(!is_null($user)) static::user($user);
        if(!is_null($api)) static::api($api);
    }

    /**
     * Sets and/or Fetches the username
     * 
     * @param string|null The username if setting, null if fetching
     * @return string
     */

    public static function user(string $user = null){
        if(!is_null($user))
            static::$user = $user;
        return static::$user;
    }

    /**
     * Sets and/or Fetches the api key
     * 
     * @param string|null The api key if setting, null if fetching
     * @return string
     */

    public static function api(string $key = null){
        if(is_null($key)) return static::$api;
        static::$api = $key;
    }

}