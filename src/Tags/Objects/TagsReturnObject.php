<?php

namespace E621api\Tags\Objects;

use E621api\BaseObjects\IterativeObject;

class TagsReturnObject extends IterativeObject
{
    public function __construct(string $json)
    {
        $temp = json_decode($json, true);
        $array = [];
        foreach ($temp as $post) {
            $array[] = new TagObject($post);
        }
        parent::__construct($array);
    }
}
