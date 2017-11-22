<?php
namespace Altmetric\Identifiers;

class PubmedId
{
    const ID_REGEXP = <<<'EOT'
{
        (?<=
            # Valid prefixes
            ^   # Start of the input
            |
            \s  # Whitespace
        )
        0*          # Zero padding
        (?!0)(\d+)  # Number that does not start with zero
        (?=
            # Valid suffixes
            $   # End of the input
            |
            \s  # Whitespace
        )
}xu
EOT;
    const URI_REGEXP = <<<'EOT'
{
        (?<=
            # Valid prefixes
            ncbi\.nlm\.nih\.gov/pubmed/
            |
            ncbi\.nlm\.nih\.gov/m/pubmed/
            |
            pmid:
            |
            info:pmid/
        )
        0*          # Zero padding
        (?!0)(\d+)  # Number that does not start with zero
}xu
EOT;

    public static function extract($str)
    {
        return array_merge(self::extractPubmedIds($str), self::extractPubmedUris($str));
    }

    private static function extractPubmedIds($str)
    {
        preg_match_all(self::ID_REGEXP, $str, $matches);

        return $matches[1];
    }

    private static function extractPubmedUris($str)
    {
        preg_match_all(self::URI_REGEXP, $str, $matches);

        return $matches[1];
    }
}
