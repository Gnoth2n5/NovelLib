<?php
namespace App\Enums;

enum NovelStatus: string
{
    case COMPLETED = 'completed';
    case ONGOING = 'ongoing';
    case HIATUS = 'hiatus';
    case DROPPED = 'dropped';
    case ABANDONED = 'banned';
    case CANCELLED = 'cancelled';
    case PENDING = 'pending'; // Chờ phát hành

    public static function getValues(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function getLabels(): array
    {
        return array_column(self::cases(), 'name');
    }

    public static function getSpecificValues(array $statuses): array
    {
        return array_values(
            array_intersect_key(
                array_column(self::cases(), 'value', 'name'), // ['COMPLETED' => 'completed', ...]
                array_flip($statuses) // Chuyển danh sách cần lấy thành key
            )
        );
    }
}
