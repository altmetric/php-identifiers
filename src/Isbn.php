<?php
namespace Altmetric\Identifiers;

class Isbn
{
    const ISBN_13_REGEXP = <<<'EOT'
{
    \b
    97[89]              # ISBN (GS1) Bookland prefix
    [\p{Pd}\p{Zs}]?     # Optional hyphenation
    (?:
        \d              # Digit
        [\p{Pd}\p{Zs}]? # Optional hyphenation
    ){9}
    \d                  # Check digit
    \b
}xu
EOT;
    const ISBN_10_REGEXP = <<<'EOT'
{
    \b
    (?:
        \d              # Digit
        [\p{Pd}\p{Zs}]? # Optional hyphenation
    ){9}
    [\dX]               # Check digit
    \b
}xu
EOT;
    const ISBN_A_REGEXP = <<<'EOT'
{
    (?<=10\.)   # Directory indicator (always 10)
    97[89]\.    # ISBN (GS1) Bookland prefix
    \d{2,8}     # ISBN registration group element and publisher prefix
    /           # Prefix/suffix divider
    \d{1,7}     # ISBN title enumerator and check digit
    \b
}xu
EOT;

    public static function extract($str)
    {
        return self::extractIsbnAs($str) + self::extractIsbn13s($str) + self::extractIsbn10s($str);
    }

    private static function extractIsbnAs($str)
    {
        preg_match_all(self::ISBN_A_REGEXP, $str, $matches);

        return self::extractIsbn13s(
            implode(
                PHP_EOL,
                array_map([__CLASS__, 'convertIsbnAToIsbn13'], $matches[0])
            )
        );
    }

    private static function extractIsbn13s($str)
    {
        preg_match_all(self::ISBN_13_REGEXP, $str, $matches);

        return array_filter(
            array_map([__CLASS__, 'stripHyphenation'], $matches[0]),
            [__CLASS__, 'isValidIsbn13']
        );
    }

    private static function extractIsbn10s($str)
    {
        preg_match_all(self::ISBN_10_REGEXP, $str, $matches);

        return array_map(
            [__CLASS__, 'convertIsbn10ToIsbn13'],
            array_filter(
                array_map([__CLASS__, 'stripHyphenation'], $matches[0]),
                [__CLASS__, 'isValidIsbn10']
            )
        );
    }

    private static function convertIsbnAToIsbn13($str)
    {
        return str_replace(['.', '/'], '', $str);
    }

    private static function stripHyphenation($str)
    {
        return preg_replace('/[\p{Pd}\p{Zs}]/u', '', $str);
    }

    private static function isValidIsbn13($str)
    {
        $checkDigit = self::isbn13CheckDigit($str);

        return $checkDigit === (int) $str[12];
    }

    private static function isValidIsbn10($str)
    {
        $sum = $str[0];
        $sum += $str[1] * 2;
        $sum += $str[2] * 3;
        $sum += $str[3] * 4;
        $sum += $str[4] * 5;
        $sum += $str[5] * 6;
        $sum += $str[6] * 7;
        $sum += $str[7] * 8;
        $sum += $str[8] * 9;
        $sum += (strtoupper($str[9]) === 'X' ? 10 : $str[9]) * 10;

        return ($sum % 11) === 0;
    }

    private static function convertIsbn10ToIsbn13($str)
    {
        $isbn13 = '978';
        $isbn13 .= substr($str, 0, 9);
        $isbn13 .= self::isbn13CheckDigit($isbn13);

        return $isbn13;
    }

    private static function isbn13CheckDigit($str)
    {
        $sum = 0;
        $sum += $str[0];
        $sum += $str[1] * 3;
        $sum += $str[2];
        $sum += $str[3] * 3;
        $sum += $str[4];
        $sum += $str[5] * 3;
        $sum += $str[6];
        $sum += $str[7] * 3;
        $sum += $str[8];
        $sum += $str[9] * 3;
        $sum += $str[10];
        $sum += $str[11] * 3;
        $checkDigit = 10 - ($sum % 10);

        return $checkDigit === 10 ? 0 : $checkDigit;
    }
}
