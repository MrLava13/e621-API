<?php

namespace E621api;

use E621api\HTTP\HTTP;
use E621api\HTTP\Method;
use E621api\Users\Objects\UserObject;

class User
{
    private const URI = 'users/';

    public static function fromID(int $id)
    {
        return new UserObject(HTTP::fetch(self::URI . $id . '.json', Method::GET));
    }
}
