<?php

namespace e621\Posts\Objects;

use e621\BaseObjects\IterativeObject;
use Exception;

class PostsReturnObject extends IterativeObject
{
    public function __construct(string $json)
    {
        $temp = json_decode($json, true);
        if (!isset($temp['posts'])) {
            throw new Exception('Was expecting a "posts" in given json but was missing');
        }
        $array = [];
        foreach ($temp['posts'] as $post) {
            $array[] = new PostObject($post);
        }
        parent::__construct($array);
    }
}
