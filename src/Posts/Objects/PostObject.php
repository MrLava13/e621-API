<?php

namespace e621\Posts\Objects;

use e621\BaseObjects\BasicArrayObject;
use Exception;

class PostObject extends BasicArrayObject
{
    public function __construct($input)
    {
        if (is_string($input)) {
            $array = json_decode($input, true);
            if (!isset($array['post'])) {
                throw new Exception('Was expecting a "post" in given json but was missing');
            }
            parent::__construct($array['post']);
            return;
        }
        parent::__construct($input);
    }

    /**
     * @return array<int,string>
     */
    public function fetchTags(): array
    {
        if (!isset($this->data['tags'])) {
            throw new Exception('Tried to get tags when there are no tags set');
        }
        foreach ($this->data['tags'] as $tags) {
            $out = array_merge($tags, isset($out) ? $out : []);
        }
        return $out;
    }
};
