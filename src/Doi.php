<?php
namespace Altmetric\Identifiers;

class Doi
{
    const PATTERN = <<<'EOT'
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
}x
EOT;
    const VALID_TRAILING_PUNCTUATION = <<<'EOT'
/
    (?:
        \(.+\) # Balanced parentheses
        |
        2-\#   # Early Wiley DOI suffix
    )
    $
/x
EOT;

    public static function extract($str)
    {
        preg_match_all(self::PATTERN, strtolower($str), $matches);

        return array_map([__CLASS__, 'stripTrailingPunctuation'], $matches[0]);
    }

    private static function stripTrailingPunctuation($doi)
    {
        if (!preg_match('/[[:punct:]]$/', $doi) || preg_match(self::VALID_TRAILING_PUNCTUATION, $doi)) {
            return $doi;
        }

        return preg_replace('/[[:punct:]]+$/', '', $doi);
    }
}
