<?php

namespace e621\Users;

use e621\HTTP\HTTP;
use e621\HTTP\Method;
use e621\Users\Objects\UserObject;

class User
{
    private const URI = 'users/';
    public static function fromID(int $id)
    {
        return new UserObject(HTTP::fetch(self::URI . $id . '.json', Method::GET));
    }
};
