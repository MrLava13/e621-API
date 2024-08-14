<?php

namespace E621api\Tags\Search;

use E621api\BaseObjects\BasicSearchObject;
use E621api\Tags\Enum\TagOrder;

class TagSearch extends BasicSearchObject
{
    protected ?string $name_matches = null;
    protected ?string $catagory = null;
    protected ?TagOrder $order = null;
    protected ?bool $hide_empty = null;
    protected ?bool $has_wiki = null;
    protected ?bool $has_artist = null;
}
