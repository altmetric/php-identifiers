<?php
namespace Altmetric\Identifiers;

class Doi
{
    const REGEXP = <<<'EOT'
{
    10 # Directory indicator (always 10)
    \.
    (?:
        # ISBN-A
        97[89]\. # ISBN (GS1) Bookland prefix
        \d{2,8}  # ISBN registration group element and publisher prefix
        /        # Prefix/suffix divider
        \d{1,7}  # ISBN title enumerator and check digit
        |
        # DOI
        \d{4,9} # Registrant code
        /       # Prefix/suffix divider
        \S+     # DOI suffix
    )
}xu
EOT;
    const VALID_ENDING = <<<'EOT'
/
    (?:
        \p{^P}  # Non-punctuation character
        |
        \(.+\)  # Balanced parentheses
        |
        2-\#    # Early Wiley DOI suffix
    )
    $
/xu
EOT;

    public static function extract($str)
    {
        preg_match_all(self::REGEXP, mb_strtolower($str, 'UTF-8'), $matches);

        return array_filter(array_map([__CLASS__, 'extractOne'], $matches[0]));
    }

    public static function extractOne($str)
    {
        while (preg_match(self::REGEXP, mb_strtolower($str, 'UTF-8'), $matches)) {
            if (preg_match(self::VALID_ENDING, $matches[0])) {
                return $matches[0];
            }

            $str = preg_replace('/\p{P}$/u', '', $matches[0]);
        }
    }
}
