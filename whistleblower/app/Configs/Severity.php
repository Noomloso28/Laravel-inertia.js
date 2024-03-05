<?php

namespace App\Configs;

class Severity
{
    public const SEVERITY_VERY_LOW = 'Very Low';
    public const SEVERITY_LOW = 'Low';
    public const SEVERITY_MEDIUM = 'Medium';
    public const SEVERITY_HIGH = 'High';
    public const SEVERITY_VERY_HIGH = 'Very High';

    public static function getSeverity(): array
    {
        return [
            1 => self::SEVERITY_VERY_LOW,
            2 => self::SEVERITY_LOW,
            3 => self::SEVERITY_MEDIUM,
            4 => self::SEVERITY_HIGH,
            5 => self::SEVERITY_VERY_HIGH
        ];
    }
}
