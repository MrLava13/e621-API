<?php
namespace e621;

class returnObject {
    private $array;


    public function __toString(): string{
        return json_encode($this->array);
    }


    public function __construct(string $json){
        $this->array = json_decode($json,true);
    }
}