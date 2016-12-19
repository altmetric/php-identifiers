<?php
namespace Altmetric\Identifiers;

class ArxivId
{
    public static function extract($str)
    {
        return self::extractPre2007ArxivIds($str) + self::extractPost2007ArxivIds($str);
    }

    private static function extractPost2007ArxivIds($str)
    {
        preg_match_all('#(?<=^|\s|/)(?:arXiv:)?\d{4}\.\d{4,5}(?:v\d+)?(?=$|\s)#i', $str, $matches);

        return array_map([__CLASS__, 'stripArxivScheme'], $matches[0]);
    }

    private static function extractPre2007ArxivIds($str)
    {
        preg_match_all('#(?<=^|\s|/)(?:arXiv:)?[a-z-]+(?:\.[A-Z]{2})?/\d{2}(?:0[1-9]|1[012])\d{3}(?:v\d+)?(?=$|\s)#i', $str, $matches);

        return array_map([__CLASS__, 'stripArxivScheme'], $matches[0]);
    }

    private static function stripArxivScheme($str)
    {
        return preg_replace('/\AarXiv:/i', '', $str);
    }
}
