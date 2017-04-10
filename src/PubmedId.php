<?php
namespace Altmetric\Identifiers;

class PubmedId
{
    public static function extract($str)
    {
        preg_match_all('/(?<=^|\s)0*(?!0)(\d+)(?=$|\s)/u', $str, $matches);

        return $matches[1];
    }
}
