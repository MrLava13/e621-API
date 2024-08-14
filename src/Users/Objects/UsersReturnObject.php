<?php

namespace E621api\Users\Objects;

use E621api\BaseObjects\IterativeObject;

class UsersReturnObject extends IterativeObject
{
    public function __construct(string $json)
    {
        $temp = json_decode($json, true);
        $array = [];
        foreach ($temp as $post) {
            $array[] = new UserObject($post);
        }
        parent::__construct($array);
    }
}
