<?php

namespace Core;

class Validator
{
    public static function string($value, $min = 1, $max = INF): bool
    {
        $len = strlen(trim($value));

        return $len >= $min && $len <= $max;
    }

    public static function email($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
}
