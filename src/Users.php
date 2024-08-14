<?php

namespace e621;

use e621\Enum\Alignment;
use e621\HTTP\HTTP;
use e621\HTTP\Method;
use e621\Users\Objects\UsersReturnObject;
use e621\Users\UserSearch;

class Users
{
    private const URI = 'users.json';

    /**
     * @param UserSearch|null $params
     */

    public static function getResults(?UserSearch $params = null): UsersReturnObject
    {
        return new UsersReturnObject(HTTP::fetch(self::URI, Method::GET, $params?->getParams() ?? []));
    }

    /**
     * Fetch the page of tags
     * 
     * @param int $page The page number to get the tags from
     * @return UsersReturnObject
     */

    public static function page(int $page): UsersReturnObject
    {
        return self::getResults(UserSearch::make()->setPage($page));
    }

    /**
     * Fetch a listing of tags from a given id
     * 
     * @param int $id The id to search from
     * @param Alignment $sort The method of searching, after or before
     * @return returnObject
     */

    public static function fromID(int $id, Alignment $align = Alignment::After)
    {
        return self::getResults(UserSearch::make()->setID($id, $align));
    }
}
