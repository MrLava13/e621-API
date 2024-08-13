<?php

namespace e621\HTTP;

use e621\HTTP\APIs\API;
use e621\HTTP\APIs\CURL;
use e621\HTTP\APIs\File;
use e621\HTTP\Method;

class HTTP
{
    /**
     * @var bool To use e926 or not
     */

    public static bool $safemode = false;




    /**
     * @var API
     */

    private static ?API $api;

    private static $lastRequest, $ratelimitRate = 1000;

    /**
     * @var int $ms Ratelimit Rate in ms (should be 1000(ms) to be complient with e621), 0 if you want to disable
     */

    public static function setRateLimit(int $ms)
    {
        if ($ms == 0 && isset(self::$ratelimitRate)) {
            unset(self::$ratelimitRate);
            return;
        }
        self::$ratelimitRate = $ms;
    }

    /**
     * @param API $api 
     * @return void 
     */

    public static function useAPI(API $api)
    {
        self::$api = $api;
    }

    public static function fetch(string $uri, Method $method, ?array $data = null)
    {
        if (!isset(self::$api)) {
            self::$api = extension_loaded('curl') ? new CURL : new File;
        }
        if (isset(self::$ratelimitRate)) {
            if (isset(self::$lastRequest)) {
                $newTime = hrtime(true);
                if (($time = $newTime - self::$lastRequest + (self::$ratelimitRate * 1e6)) > 0) {
                    time_nanosleep(max(floor($time / 1e9), 0), max($time - (floor($time / 1e9) * 1e9), 0));
                }
            }
            self::$lastRequest = hrtime(true);
        }
        return self::$api->call((self::$safemode ? 'https://e926.net/' : 'https://e621.net/') . $uri, $method, $data ?? []);
    }
}
