<?php

namespace e621;

class returnObject {
    private $array, $index = 0;

    public function __construct(string $json) {
        $array = json_decode($json, true);
        if (isset($array['posts']))
            $this->array = $array['posts'];
        elseif (isset($array['post']))
            $this->array = [$array['post']];
        else
            $this->array = $array;
    }


    public function __toString(): string {
        return json_encode($this->array);
    }

    /**
     * Returns an array if another post/listing exists, false if one does not
     * 
     * @return array|false
     */

    public function fetchArray() {
        if (!isset($this->array[$this->index]))
            return false;
        $this->index++;
        return $this->array[$this->index - 1];
    }

    /**
     * Resets the fetchArray
     */

    public function reset() {
        $this->index = 0;
        return true;
    }

    /**
     * Gets the amount of posts/items that are in the output
     * 
     * @return int
     */

    public function getCount() {
        return count($this->array);
    }


    // Posts and tags

    /**
     * Returns the smallest ID
     * 
     * @return int|false
     */

    public function getSID() {
        if (!isset($this->array[0]['id']))
            return false;
        foreach ($this->array as $v)
            if (!isset($out) || $v['id'] < $out)
                $out = $v['id'];
        return $out;
    }

    /**
     * Returns the largest ID
     * 
     * @return int|false
     */

    public function getLID() {
        if (!isset($this->array[0]['id']))
            return false;
        foreach ($this->array as $v)
            if (!isset($out) || $v['id'] > $out)
                $out = $v['id'];
        return $out;
    }

    /**
     * 
     * 
     * @return array|false
     */

    public function fetchTags() {
        if (!isset($this->array[$this->index], $this->array[$this->index]['tags']))
            return false;
        foreach ($this->array[$this->index]['tags'] as $tags)
            $out = array_merge($tags, isset($out) ? $out : []);
        return $out;
    }
}
