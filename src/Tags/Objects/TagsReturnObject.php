<?php

namespace e621\Tags\Objects;

use e621\BaseObjects\IterativeObject;

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
