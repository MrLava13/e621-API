<?php

namespace e621\Posts\Enum;

enum PostOrder
{
    case ID;
    case RANDOM;

    case LANDSCAPE;
    case PORTRAIT;

        // ASC-able
    case SCORE;
    case FAVORITE_COUNT;
    case TAG_COUNT;
    case COMMENT_COUNT;
    case COMMENT_BUMPED;
    case IMAGE_RESOLUTION;
    case FILE_SIZE;
    case CHANGE;
    case DURATION;

    public static function hasASC(PostOrder $order): bool
    {
        return match ($order) {
            PostOrder::ID, PostOrder::RANDOM, PostOrder::LANDSCAPE, PostOrder::PORTRAIT => false,
            default => true
        };
    }

    public static function convertToID(PostOrder $order): string
    {
        return match ($order) {
            PostOrder::ID => 'id',
            PostOrder::RANDOM => 'random',
            PostOrder::LANDSCAPE => 'landscape',
            PostOrder::PORTRAIT => 'portrait',
            PostOrder::SCORE => 'score',
            PostOrder::FAVORITE_COUNT => 'favcount',
            PostOrder::TAG_COUNT => 'tagcount',
            PostOrder::COMMENT_COUNT => 'comment_count',
            PostOrder::COMMENT_BUMPED => 'comment_bumped',
            PostOrder::IMAGE_RESOLUTION => 'mpixels',
            PostOrder::FILE_SIZE => 'filesize',
            PostOrder::CHANGE => 'change',
            PostOrder::DURATION => 'duration'
        };
    }
};
