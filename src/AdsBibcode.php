<?php
namespace Altmetric\Identifiers;

class AdsBibcode
{
    public static function extract($str)
    {
        preg_match_all('/\b\d{4}[a-z][0-9a-z&.]{14}\b/i', $str, $matches);

        return $matches[0];
    }
}
