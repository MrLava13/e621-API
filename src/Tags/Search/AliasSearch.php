<?php

namespace E621api\Tags\Search;

use E621api\BaseObjects\BasicSearchObject;
use E621api\Tags\Enum\TagOrder;
use E621api\Tags\Enum\TagStatus;

class AliasSearch extends BasicSearchObject
{
    protected ?string $name_matches;
    protected ?string $antecedent_name;
    protected ?string $consequent_name;
    protected ?string $antecedent_tag_category;
    protected ?string $consequent_tag_category;
    protected ?string $creator_name;
    protected ?string $approver_name;
    protected ?TagStatus $status;
    protected ?TagOrder $order;
}
