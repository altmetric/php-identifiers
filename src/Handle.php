<?php
namespace Altmetric\Identifiers;

class Handle
{
    public static function extract(?string $str): array
    {
        $str = $str ?? '';
        preg_match_all('#\b[\d.]+/\S+\b#u', $str, $matches);

        return $matches[0];
    }
}
