<?php

namespace E621api;

use E621api\Enum\Alignment;
use E621api\HTTP\HTTP;
use E621api\HTTP\Method;
use E621api\Posts\Objects\PostsReturnObject;
use E621api\Posts\PostSearch;

class Posts
{
    private const URI = 'posts.json';

    public static function getResults(?PostSearch $params = null): PostsReturnObject
    {
        return new PostsReturnObject(HTTP::fetch(self::URI, Method::GET, $params?->getParams() ?? []));
    }

    public static function page(int $page): PostsReturnObject
    {
        return self::getResults(PostSearch::make()->setPage($page));
    }
    
    public static function fromID(int $id, Alignment $align = Alignment::After): PostsReturnObject
    {
        return self::getResults(PostSearch::make()->setID($id, $align));
    }
}
