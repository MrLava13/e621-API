<?php

namespace e621\Users;

use e621\Alignment;
use e621\HTTP\HTTP;
use e621\HTTP\Method;
use e621\Users\Objects\UserObject;
use e621\Users\Objects\UsersReturnObject;
use Exception;

class Users
{
    private const URI = 'users.json';

    /**
     * Fetch the page of tags
     * 
     * @param int $page The page number to get the tags from
     * @param array $options The options to search for
     * @return UsersReturnObject
     */

    public static function page(int $page, array $options = []): UsersReturnObject
    {
        return new UsersReturnObject(HTTP::fetch(self::URI, Method::GET, array_merge($options, ['page' => $page])));
    }

    /**
     * Fetch a listing of tags from a given id
     * 
     * @param int $id The id to search from
     * @param Alignment $sort The method of searching, after or before
     * @param array $options The options to search for
     * @return returnObject
     */

    public static function fromID(int $id, Alignment $sort = Alignment::After, array $options = [])
    {
        return new UsersReturnObject(HTTP::fetch(self::URI, Method::GET, array_merge($options, ['page' => ($sort === Alignment::After ? 'a' : 'b') . $id])));
    }
}
