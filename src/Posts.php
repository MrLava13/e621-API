<?php

namespace e621;

use e621\Enum\Alignment;
use e621\HTTP\HTTP;
use e621\HTTP\Method;
use e621\Posts\Objects\PostsReturnObject;
use e621\Posts\PostSearch;

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
