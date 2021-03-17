<?php
namespace e621;
use \e621\process\GET;
use Error;
class Tags {
    private static $url = 'https://e621.net/tags.json';

    /**
     * Fetch the page of tags
     * 
     * @param int $page The page number to get the tags from
     * @param array $options The options to search for
     * @return returnObject
     */

    public static function page(int $page, array $options = []){
        return new returnObject(GET::s(static::$url, array_merge($options, ['page'=>$page])));
    }

    /**
     * Fetch a listing of tags from a given id
     * 
     * @param int $id The id to search from
     * @param string $sort The method of searching, `a` for after, or `b` for before
     * @param array $options The options to search for
     * @return returnObject
     */

    public static function id(int $id, string $sort = 'a', array $options = []){
        if(!in_array($sort, ['a','b'])) throw new Error('Sort can only be `a` or `b`');
        return new returnObject(GET::s(static::$url,array_merge($options,['page'=>$sort.$id])));
    }
}