<?php

namespace e621\Users\Objects;

use e621\BaseObjects\BasicArrayObject;

class UserObject extends BasicArrayObject
{
    function __construct($input)
    {
        parent::__construct(is_string($input) ? json_decode($input, true) : $input);
        // TODO: Add validation
    }
};
