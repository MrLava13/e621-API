<?php

namespace e621\BaseObjects;

use Exception;

class ResponceObject extends BasicArrayObject
{
    function __construct($data)
    {
        parent::__construct(json_decode($data, true));
    }

    function isSuccess(): bool
    {
        if (!isset($this->data['success'])) throw new Exception('No success in response');
        return $this->data['success'];
    }
};
