<?php
namespace Altmetric\Identifiers;

class Doi
{
    public static function extract($str)
    {
        preg_match_all('#\b10\.(?:97[89]\.\d{2,8}/\d{1,7}|\d{4,9}/\S+)\b#', $str, $matches);

        return array_map('strtolower', $matches[0]);
    }
}
