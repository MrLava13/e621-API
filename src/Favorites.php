<?php

namespace E621api\Users;

use E621api\HTTP\HTTP;
use E621api\HTTP\Method;
use E621api\Users\Objects\FavoritesReturnObject;

class Favorites
{
    private const URI = 'favorites.json';

    public static function fromID(?int $id = null): FavoritesReturnObject
    {
        return new FavoritesReturnObject(HTTP::fetch(self::URI, Method::GET, isset($id) ? ['user_id' => $id] : []));
    }
}
