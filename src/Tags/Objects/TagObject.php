<?php

namespace e621\Tags\Objects;

use e621\BaseObjects\BasicArrayObject;

class TagObject extends BasicArrayObject
{
    function __construct($input)
    {
        parent::__construct(is_string($input) ? json_decode($input, true) : $input);
        // TODO: Add validation
    }
};
