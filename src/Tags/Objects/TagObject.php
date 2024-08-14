<?php

namespace E621api\Tags\Objects;

use E621api\BaseObjects\BasicArrayObject;

class TagObject extends BasicArrayObject
{
    function __construct($input)
    {
        parent::__construct(is_string($input) ? json_decode($input, true) : $input);
        // TODO: Add validation
    }
};
