<?php

namespace e621\BaseObjects;

use e621\Enum\Alignment;
use Exception;

class BasicSearchObject
{

    //
    //
    //
    protected bool $isPage = false;
    protected Alignment $IDAlignment = Alignment::After;
    protected ?int $page = null;

    public function setPage(?int $page = null): static
    {
        $this->isPage = true;
        $this->page = $page;
        return $this;
    }
    public function setID(?int $id = null, ?Alignment $align = null): static
    {
        $this->isPage = false;
        $this->page = $id;
        if (isset($align)) {
            $this->IDAlignment = $align;
        }
        return $this;
    }



    protected ?int $limit = null;

    public function setLimit(?int $limit = null): static
    {
        if (isset($limit) && $limit > 320) {
            throw new Exception("Cannot set limit above 320");
        }
        $this->limit = $limit;
        return $this;
    }




    public function getParams(): array
    {
        $output = [];
        if (isset($this->page)) {
            if ($this->isPage) {
                if ($this->page > 750) {
                    throw new Exception('Cannot set page above 750');
                }
                $output['page'] = $this->page;
            } else {
                $output['page'] = ($this->IDAlignment === Alignment::After ? 'a' : 'b') . $this->page;
            }
        }

        if (isset($this->limit)) {
            $output['limit'] = $this->limit;
        }
        return $output;
    }


    public static function make(): static
    {
        return new static;
    }
};
