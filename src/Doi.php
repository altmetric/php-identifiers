<?php
namespace Altmetric\Identifiers;

class Doi
{
    public static function extract($str)
    {
        preg_match_all('/\b10\.\d{4,9}\/\S+\b/', $str, $matches);

        return array_map('strtolower', $matches[0]);
    }
}
