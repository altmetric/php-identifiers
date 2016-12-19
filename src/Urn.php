<?php
namespace Altmetric\Identifiers;

class Urn
{
    public static function extract($str)
    {
        preg_match_all(
            '/\burn:(?!urn:)[a-z0-9][a-z0-9\-]{1,31}:(?:[a-z0-9()+,-.:=@;$_!*\']|' .
            '%(?:2[1-9a-f]|[3-6][0-9a-f]|7[0-9a-e]))+\b/i',
            $str,
            $matches
        );

        return array_map([__CLASS__, 'normalizeUrn'], $matches[0]);
    }

    private static function normalizeUrn($str)
    {
        list($scheme, $nid, $nss) = explode(':', $str, 3);

        $urn = 'urn:' . strtolower($nid) . ':';
        $urn .= preg_replace_callback(
            '/%[0-9a-f]{2}/i',
            function ($matches) {
                return strtolower($matches[0]);
            },
            $nss
        );

        return $urn;
    }
}
