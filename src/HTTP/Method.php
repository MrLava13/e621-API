<?php

namespace E621api\HTTP;

enum Method
{
    case DELETE;
    case GET;
    case PATCH;
    case POST;
    case PUT;

    public static function methodToString(Method $method): string
    {
        return match ($method) {
            Method::DELETE => 'DELETE',
            Method::GET => 'GET',
            Method::PATCH => 'PATCH',
            Method::POST => 'POST',
            Method::PUT => 'PUT',
            default => 'GET'
        };
    }
}
