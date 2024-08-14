<?php

namespace E621api\Users\Objects;

use E621api\BaseObjects\BasicArrayObject;

class UserObject extends BasicArrayObject
{
    function __construct($input)
    {
        parent::__construct(is_string($input) ? json_decode($input, true) : $input);
        // TODO: Add validation
    }
};
