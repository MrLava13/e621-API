<?php
namespace e621;

use Error;
use \e621\process\GET;


class Posts {
    private static $url = "https://e621.net/posts.json";
    /**
     * 
     * @param int $page The page to pull
     * @param array $params List options, array keys can include `limit` and `tags`
     * @return returnObject
     */
    public static function page(int $page, array $params = []): returnObject{
        if($page > 750) throw new Error("Page can not be larger than 750");
        return new returnObject(GET::s(static::$url,array_merge(static::parseParams($params),["page"=>$page])));
    }

    /**
     * 
     * 
     * @param int $id
     * @param string $sort Can be `a` for after, or `b` for before the specified ID
     * @param array $params List options, array keys can include `limit` and `tags`
     * @return returnObject
     */
    public static function id(int $id, string $sort = "a", array $params = []): returnObject{
        if(!in_array($sort, ["a","b"])) throw new Error("Sort can only be `a` or `b`");
        return new returnObject(GET::s(static::$url,array_merge(static::parseParams($params),["page"=>$sort.$id])));
    }

    private static function parseParams(array $params){
        $out = array_intersect_key($params,array_flip(["tags","limit"]));
        if(isset($out["tags"]))
            $out["tags"] = implode(" ",$out["tags"]);
        return $out;
    }
}