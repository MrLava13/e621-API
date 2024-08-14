<?php

namespace E621api;

use E621api\Enum\Alignment;
use E621api\HTTP\HTTP;
use E621api\HTTP\Method;
use E621api\Tags\Objects\TagsReturnObject;
use E621api\Tags\Search\TagSearch;

class Tags
{
    private const URI = 'tags.json';

    public static function getResults(?TagSearch $params = null) : TagsReturnObject
    {
        return new TagsReturnObject(HTTP::fetch(self::URI, Method::GET, $params?->getParams() ?? []));
    }

    /**
     * Fetch the page of tags
     * 
     * @param int $page The page number to get the tags from
     * @return TagsReturnObject
     */

    public static function page(int $page): TagsReturnObject
    {
        return self::getResults(TagSearch::make()->setPage($page));
    }

    /**
     * Fetch a listing of tags from a given id
     * 
     * @param int $id The id to search from
     * @param Alignment $sort The method of searching, `a` for after, or `b` for before
     * @return TagsReturnObject
     */

    public static function fromID(int $id, Alignment $align = Alignment::After): TagsReturnObject
    {
        return self::getResults(TagSearch::make()->setID($id, $align));
    }
}
