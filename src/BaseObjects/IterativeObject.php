<?php

namespace E621api\BaseObjects;

use ArrayAccess;
use Exception;
use Iterator;

class IterativeObject implements Iterator, ArrayAccess
{
    protected int $index = 0;

    /**
     * @param array<int,BasicArrayObject> $array
     */

    public function __construct(protected array $array) {}


    public function __toString(): string
    {
        return json_encode($this->array);
    }

    /**
     * Gets the amount of posts/items that are in the output
     * 
     * @return int
     */

    public function count()
    {
        return count($this->array);
    }


    // Posts and tags

    /**
     * Returns the smallest ID
     * 
     * @return int|false
     */

    public function getSID()
    {
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

    public function getLID()
    {
        if (!isset($this->array[0]['id']))
            return false;
        foreach ($this->array as $v)
            if (!isset($out) || $v['id'] > $out)
                $out = $v['id'];
        return $out;
    }


    // Iteration stuff

    public function rewind(): void
    {
        $this->index = 0;
    }
    public function current(): mixed
    {
        return $this->array[$this->index];
    }
    public function key(): mixed
    {
        return $this->index;
    }
    public function next(): void
    {
        ++$this->index;
    }
    public function valid(): bool
    {
        return isset($this->array[$this->index]);
    }

    // Array stuff
    public function offsetExists(mixed $offset): bool
    {
        return isset($this->array[$offset]);
    }
    public function offsetSet(mixed $offset, mixed $value): void
    {
        $this->array[$offset] = $value;
    }
    public function offsetGet(mixed $offset): mixed
    {
        if (!isset($this->array[$offset])) {
            throw new Exception('Attempted to access: "' . $offset . '" in a user and the given key was not found in the array.');
        }
        return $this->array[$offset];
    }
    public function offsetUnset(mixed $offset): void
    {
        unset($this->array[$offset]);
    }
}
