<?php

declare(strict_types=1);

namespace Jantinnerezo\LivewireAlert;

class Dismissal
{
    public static function make(string $method, mixed $params = null): array|string
    {
        if (is_null($params)) {
            return $method;
        }

        return [
            'method' => $method,
            'params' => $params,
        ];
    }
}