<?php

namespace e621\Tags\Enum;

enum TagStatus
{
    case APPROVED;
    case ACTIVE;
    case PENDING;
    case DELETED;
    case RETIRED;
    case PROCESSING;
    case QUEUED;

    public static function statusToString(TagStatus $tag): string
    {
        return match ($tag) {
            TagStatus::APPROVED => 'approved',
            TagStatus::ACTIVE => 'active',
            TagStatus::PENDING => 'pending',
            TagStatus::DELETED => 'deleted',
            TagStatus::RETIRED => 'retired',
            TagStatus::PROCESSING => 'processing',
            TagStatus::QUEUED => 'queued'
        };
    }
};
