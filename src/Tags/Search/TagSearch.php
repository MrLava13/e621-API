<?php

namespace e621\Tags\Search;

use e621\BaseObjects\BasicSearchObject;
use e621\Tags\Enum\TagOrder;

class TagSearch extends BasicSearchObject
{
    protected ?string $name_matches = null;
    protected ?string $catagory = null;
    protected ?TagOrder $order = null;
    protected ?bool $hide_empty = null;
    protected ?bool $has_wiki = null;
    protected ?bool $has_artist = null;
};
