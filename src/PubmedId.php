<?php
namespace Altmetric\Identifiers;

class PubmedId
{
    const REGEXP = <<<'EOT'
{
    (?<=
        # Valid prefixes
        ^                               # Start of the input
        |
        \s                              # Whitespace
        |
        ncbi\.nlm\.nih\.gov/pubmed/     # PubMed record page
        |
        ncbi\.nlm\.nih\.gov/m/pubmed/   # Mobile PubMed record page
    )
    0*          # Zero padding
    (?!0)(\d+)  # Number (not starting with zero)
    (?=
        # Valid suffixes
        $   # End of string
        |
        \s  # Whitespace
        |
        /   # Trailing slash
        |
        \?  # Query string
        |
        \#  # Fragment
    )
}xu
EOT;

    public static function extract($str)
    {
        preg_match_all(self::REGEXP, $str, $matches);

        return $matches[1];
    }
}
