<?php

namespace e621\Users;

use e621\HTTP\HTTP;
use e621\HTTP\Method;
use e621\Users\Objects\FavoritesReturnObject;

class Favorites
{
    private const URI = 'favorites.json';

    public static function fromID(?int $id = null): FavoritesReturnObject
    {
        return new FavoritesReturnObject(HTTP::fetch(self::URI, Method::GET, isset($id) ? ['user_id' => $id] : []));
    }
};
