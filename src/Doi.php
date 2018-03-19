<?php
namespace Altmetric\Identifiers;

class Doi
{
    const REGEXP = <<<'EOT'
{
    10                      # Directory indicator (always 10)
    \.
    (?:
        # ISBN-A
        97[89]\.            # ISBN (GS1) Bookland prefix
        \d{2,8}             # ISBN registration group element and publisher prefix
        /                   # Prefix/suffix divider
        \d{1,7}             # ISBN title enumerator and check digit
        |
        # DOI
        \d{4,9}             # Registrant code
        /                   # Prefix/suffix divider
        (?:
            # DOI suffix
            \S+2-\#         # Early Wiley suffix
            |
            \S+\(\S+\)      # Suffix ending in balanced parentheses
            |
            \S+(?!\s)\p{^P} # Suffix ending in non-punctuation
        )
    )
}xu
EOT;

    public static function extract($str)
    {
        preg_match_all(self::REGEXP, mb_strtolower($str, 'UTF-8'), $matches);

        return $matches[0];
    }
}
