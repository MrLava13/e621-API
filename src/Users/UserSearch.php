<?php

namespace e621\Users;

use e621\BaseObjects\BasicSearchObject;

class UserSearch extends BasicSearchObject
{
    protected ?string $name_matches;
    protected ?string $about;
    protected ?int $avatar_id;
    protected $level;
    protected $min_level;
    protected $max_level;
    protected ?bool $can_approve_posts;
    protected ?bool $can_upload_free;
    protected $order;
};