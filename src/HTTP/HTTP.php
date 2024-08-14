<?php

namespace E621api\HTTP;

use E621api\Defaults;
use E621api\HTTP\APIs\API;
use E621api\HTTP\APIs\CURL;
use E621api\HTTP\APIs\File;
use E621api\HTTP\Method;

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

    private static ?int $lastRequest, $ratelimitRate = Defaults::DEFAULT_RATELIMIT;

    /**
     * @var int $ms Ratelimit Rate in ms (should be 1000(ms) to be complient with E621api), 0 if you want to disable
     */

    public static function setRateLimit(int $ms): void
    {
        if ($ms <= 0 && isset(self::$ratelimitRate)) {
            unset(self::$ratelimitRate);
            return;
        }
        self::$ratelimitRate = $ms;
    }

    /**
     * @param API $api 
     * @return void 
     */

    public static function useAPI(API $api): void
    {
        self::$api = $api;
    }

    public static function fetch(string $uri, Method $method, ?array $data = null): string
    {
        if (!isset(self::$api)) {
            self::$api = extension_loaded('curl') ? new CURL : new File;
        }
        if (isset(self::$ratelimitRate)) {
            if (isset(self::$lastRequest)) {
                $newTime = hrtime(true);
                if (($time = $newTime - self::$lastRequest + (self::$ratelimitRate * 1e6)) > 0) {
                    $sec = floor($time / 1e9);
                    time_nanosleep($sec, max($time - ($sec * 1e9), 0));
                }
            }
            self::$lastRequest = hrtime(true);
        }
        return self::$api->call((self::$safemode ? Defaults::SAFE_URL : Defaults::DEFAULT_URL) . $uri, $method, $data ?? []);
    }
}
