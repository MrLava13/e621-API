<?php

namespace E621api\Posts;

use E621api\BaseObjects\BasicSearchObject;
use E621api\Posts\Enum\PostOrder;
use ValueError;

class PostSearch extends BasicSearchObject
{
    protected ?array $tags = null;

    public function setTags(?array $tags = null): static
    {
        $this->tags = $tags;
        return $this;
    }

    protected ?PostOrder $order = null;
    protected bool $order_asc = false;

    public function setOrder(?PostOrder $order = null, bool $asc = false): static
    {
        if ($this->order_asc = $asc && isset($order)) {
            match ($order) {
                PostOrder::ID,
                PostOrder::RANDOM,
                PostOrder::LANDSCAPE,
                PostOrder::PORTRAIT => throw new ValueError(
                    'Invalid ASC on given order'
                )
            };
        }
        $this->order = $order;

        return $this;
    }

    public function getParams(): array
    {
        $output = parent::getParams();

        $tempTags = $this->tags ?? [];
        if (isset($this->order)) {
            $tempTags[] =
                'order:'
                . PostOrder::convertToID($this->order)
                . ($this->order_asc && PostOrder::hasASC($this->order) ? '_asc' : '');
        }
        if (count($tempTags)) {
            $output['tags'] = implode(' ', $tempTags);
        }


        return $output;
    }
}
