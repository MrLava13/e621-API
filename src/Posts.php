<?php
namespace e621;

use Error;
use \e621\process\GET;


class Posts {
    private static $url = 'https://e621.net/posts.json';
    /**
     * Get a page of posts
     * 
     * @param int $page The page to pull
     * @param array $options List options, array keys can include `limit` and `tags`
     * @return returnObject
     */
    public static function page(int $page, array $options = []): returnObject{
        if($page > 750) throw new Error('Page can not be larger than 750');
        return new returnObject(GET::s(static::$url,array_merge(static::parseParams($options),['page'=>$page])));
    }

    /**
     * Get a list of posts based off of a given ID
     * 
     * @param int $id
     * @param string $sort Can be `a` for after, or `b` for before the specified ID
     * @param array $options List options, array keys can include `limit` and `tags`
     * @return returnObject
     */
    public static function id(int $id, string $sort = 'a', array $options = []): returnObject{
        if(!in_array($sort, ['a','b'])) throw new Error('Sort can only be `a` or `b`');
        return new returnObject(GET::s(static::$url,array_merge(static::parseParams($options),['page'=>$sort.$id])));
    }

    private static function parseParams(array $options){
        $out = array_intersect_key($options,array_flip(['tags','limit']));
        if(isset($out['tags']))
            $out['tags'] = implode(' ',$out['tags']);
        return $out;
    }
}