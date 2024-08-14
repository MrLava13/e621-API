<?php

namespace e621\Tags\Objects;

use e621\BaseObjects\IterativeObject;

class AliasesReturnObject extends IterativeObject
{
    public function __construct(string $json)
    {
        $temp = json_decode($json, true);
        $array = [];
        foreach ($temp as $post) {
            $array[] = new AliasObject($post);
        }
        parent::__construct($array);
    }
}
