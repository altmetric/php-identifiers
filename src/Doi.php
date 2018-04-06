<?php
namespace Altmetric\Identifiers;

class Doi
{
    const REGEXP = <<<'EOT'
{
    \b
    10                       # Directory indicator (always 10)
    \.
    (?:
        # ISBN-A
        97[89]\.             # ISBN (GS1) Bookland prefix
        \d{2,8}              # ISBN registration group element and publisher prefix
        /                    # Prefix/suffix divider
        \d{1,7}              # ISBN title enumerator and check digit
        |
        # DOI
        \d{4,9}              # Registrant code
        /                    # Prefix/suffix divider
        (?:
            # DOI suffix
            \S+;2-[\#0-9a-z] # Early Wiley suffix
            |
            \S+              # Suffix...
            \([^\s)]+\)      # Ending in balanced parentheses...
            (?![^\s\p{P}])   # Not followed by more suffix
            |
            \S+(?!\s)\p{^P}  # Suffix ending in non-punctuation
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
