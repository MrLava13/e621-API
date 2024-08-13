<?php

namespace e621\Posts;

use e621\Alignment;
use e621\HTTP\HTTP;
use e621\HTTP\Method;
use e621\Posts\Objects\PostsReturnObject;
use Exception;

class Posts
{
    private const URL = 'https://e621.net/posts.json';

    /**
     * Get a page of posts
     * 
     * @param int $page The page to pull
     * @param array $options List options, array keys can include `limit` and `tags`
     * @return PostsReturnObject
     */

    public static function page(int $page, array $options = []): PostsReturnObject
    {
        if ($page > 750) throw new Exception('Page can not be larger than 750');
        return new PostsReturnObject(HTTP::fetch(self::URL, Method::GET, array_merge(static::parseParams($options), ['page' => $page])));
    }

    /**
     * Get a list of posts based off of a given ID
     * 
     * @param int $id
     * @param Alignment $sort Can be after or before the specified ID
     * @param array $options List options, array keys can include `limit` and `tags`
     * @return PostsReturnObject
     */
    public static function fromID(int $id, Alignment $sort = Alignment::After, array $options = []): PostsReturnObject
    {
        return new PostsReturnObject(HTTP::fetch(self::URL, Method::GET, array_merge(static::parseParams($options), ['page' => ($sort === Alignment::After ? 'a' : 'b' ). $id])));
    }

    private static function parseParams(array $options)
    {
        $out = array_intersect_key($options, ['tags' => null, 'limit' => null]);
        if (isset($out['tags'])) $out['tags'] = implode(' ', $out['tags']);
        return $out;
    }
}
