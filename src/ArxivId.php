<?php
namespace Altmetric\Identifiers;

class ArxivId
{
    const POST_2007_REGEXP = <<<'EOT'
{
    (?<=^|\s|/) # Look-behind for the start of the string, whitespace or a forward slash
    (?:arXiv:)? # Optional arXiv scheme
    \d{4}       # YYMM (two-digit year and two-digit month number)
    \.
    \d{4,5}     # Zero-padded sequence number of 4- or 5-digits
    (?:v\d+)?   # Literal v followed by version number of 1 or more digits
    (?=$|\s)    # Look-ahead for end of string or whitespace
}xiu
EOT;
    const PRE_2007_REGEXP = <<<'EOT'
{
    (?<=^|\s|/)       # Look-behind for the start of the string, whitespace or a forward slash
    (?:arXiv:)?       # Optional arXiv scheme
    [a-z-]+           # Archive (e.g. "math")
    (?:\.[A-Z]{2})?   # Subject class (where applicable)
    /
    \d{2}             # Year
    (?:0[1-9]|1[012]) # Month
    \d{3}             # Number
    (?:v\d+)?         # Literal v followed by version number of 1 or more digits
    (?=$|\s)          # Look-ahead for end of string or whitespace
}xiu
EOT;

    public static function extract($str)
    {
        return self::extractPre2007ArxivIds($str) + self::extractPost2007ArxivIds($str);
    }

    private static function extractPost2007ArxivIds($str)
    {
        preg_match_all(self::POST_2007_REGEXP, $str, $matches);

        return array_map([__CLASS__, 'stripArxivScheme'], $matches[0]);
    }

    private static function extractPre2007ArxivIds($str)
    {
        preg_match_all(self::PRE_2007_REGEXP, $str, $matches);

        return array_map([__CLASS__, 'stripArxivScheme'], $matches[0]);
    }

    private static function stripArxivScheme($str)
    {
        return preg_replace('/\AarXiv:/i', '', $str);
    }
}
