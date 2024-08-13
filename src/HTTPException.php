<?php

namespace e621;

use Exception;

class HTTPException extends Exception
{
    function __construct(int $errorCode)
    {
        match ($errorCode) {
            // 4XX
            400 => parent::__construct('Bad Request', $errorCode),
            401 => parent::__construct('Unauthorized', $errorCode),
            403 => parent::__construct('Forbidden', $errorCode),
            404 => parent::__construct('Not Found', $errorCode),
            405 => parent::__construct('Method Not Allowed', $errorCode),
            406 => parent::__construct('Not Acceptable', $errorCode),
            410 => parent::__construct('Gone', $errorCode),
            412 => parent::__construct('Precondition failed', $errorCode),
            422 => parent::__construct('Unprocessable Content', $errorCode),
            429 => parent::__construct('Ratelimited', $errorCode),

            // 5XX
            500 => parent::__construct('Internal Server Error', $errorCode),
            502 => parent::__construct('Bad Gateway', $errorCode),
            503 => parent::__construct('Service Unavailable', $errorCode),
            520 => parent::__construct('Unknown Error', $errorCode),
            522 => parent::__construct('Origin Connection Time-out', $errorCode),
            524 => parent::__construct('Origin Connection Time-out', $errorCode),
            525 => parent::__construct('SSL Handshake Failed', $errorCode),

            default => parent::__construct('Unknown Error', $errorCode)
        };
    }
}
