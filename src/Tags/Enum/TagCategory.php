<?php

namespace E621api\Tags\Enum;

enum TagCategory
{
    case GENERAL;
    case ARTIST;
    case COPYRIGHT;
    case CHARACTER;
    case SPECIES;
    case INVALID;
    case META;
    case LORE;
}
