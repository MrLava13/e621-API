<?php

namespace e621\BaseObjects;

use ArrayAccess;
use Exception;

class BasicArrayObject implements ArrayAccess
{
    /**
     * @param array<string,mixed> $data
     */
    function __construct(protected array $data) {}

    public function print()
    {
        print_r($this->data);
    }
    public function getArray(): array
    {
        return $this->data;
    }

    public function offsetExists(mixed $offset): bool
    {
        return isset($this->data[$offset]);
    }
    public function offsetSet(mixed $offset, mixed $value): void
    {
        $this->data[$offset] = $value;
    }
    public function offsetGet(mixed $offset): mixed
    {
        if (!isset($this->data[$offset])) {
            throw new Exception('Attempted to access: "' . $offset . '" in a user and the given key was not found in the array.');
        }
        return $this->data[$offset];
    }
    public function offsetUnset(mixed $offset): void
    {
        unset($this->data[$offset]);
    }
};
