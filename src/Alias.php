<?php

namespace e621;

use e621\Enum\Alignment;
use e621\HTTP\HTTP;
use e621\HTTP\Method;
use e621\Tags\Objects\AliasesReturnObject;
use e621\Tags\Search\AliasSearch;

class Alias
{
    private const URI = 'tag_aliases.json';


    public static function getResults(?AliasSearch $params = null): AliasesReturnObject
    {
        return new AliasesReturnObject(HTTP::fetch(self::URI, Method::GET, $params?->getParams() ?? []));
    }

    /**
     * Fetch the page of tags
     * 
     * @param int $page The page number to get the tags from
     * @return AliasesReturnObject
     */

    public static function page(int $page): AliasesReturnObject
    {
        return self::getResults(AliasSearch::make()->setPage($page));
    }

    /**
     * Fetch a listing of tags from a given id
     * 
     * @param int $id The id to search from
     * @param Alignment $sort The method of searching, `a` for after, or `b` for before
     * @param array $options The options to search for
     * @return AliasesReturnObject
     */

    public static function id(int $id, Alignment $align = Alignment::After): AliasesReturnObject
    {
        return self::getResults(AliasSearch::make()->setID($id, $align));
    }
}
