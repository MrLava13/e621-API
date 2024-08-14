<?php

namespace E621api\Tags\Enum;

enum TagOrder
{
    case DATE;
    case COUNT;
    case NAME;

    public static function orderToString(TagOrder $tag): string
    {
        return match ($tag) {
            TagOrder::DATE => 'date',
            TagOrder::COUNT => 'count',
            TagOrder::NAME => 'name'
        };
    }
};
