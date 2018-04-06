<?php
namespace Altmetric\Identifiers;

class Isbn
{
    const ISBN_13_REGEXP = <<<'EOT'
{
    \b
    (
        97[89]              # ISBN (GS1) Bookland prefix
        ([\p{Pd}\p{Zs}])?   # Optional hyphenation
        (?:
            \d              # Digit
            \2?             # Optional hyphenation
        ){9}
        \d                  # Check digit
    )
    \b
}xu
EOT;
    const ISBN_10_REGEXP = <<<'EOT'
{
    (?<!                # Don't match a hyphenated or spaced ISBN-13
        97[89]
        [\p{Pd}\p{Zs}]
    )
    \b
    (
        \d                  # Digit
        ([\p{Pd}\p{Zs}])?   # Optional hyphenation
        (?:
            \d              # Digit
            \2?             # Optional hyphenation
        ){8}
        [\dX]               # Check digit
    )
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
        return array_merge(self::extractIsbnAs($str), self::extractIsbn13s($str), self::extractIsbn10s($str));
    }

    private static function extractIsbnAs($str)
    {
        preg_match_all(self::ISBN_A_REGEXP, $str, $matches);

        $isbns = [];

        foreach ($matches[0] as $match) {
            $isbns[] = self::convertIsbnAToIsbn13($match);
        }

        return self::extractIsbn13s(implode(PHP_EOL, $isbns));
    }

    private static function extractIsbn13s($str)
    {
        preg_match_all(self::ISBN_13_REGEXP, $str, $matches, \PREG_SET_ORDER);

        $isbns = [];

        foreach ($matches as $match) {
            $isbn = self::stripHyphenation($match, 4);
            if (!self::isValidIsbn13($isbn)) {
                continue;
            }

            $isbns[] = $isbn;
        }

        return $isbns;
    }

    private static function extractIsbn10s($str)
    {
        preg_match_all(self::ISBN_10_REGEXP, $str, $matches, \PREG_SET_ORDER);

        $isbns = [];

        foreach ($matches as $match) {
            $isbn = self::stripHyphenation($match, 3);
            if (!self::isValidIsbn10($isbn)) {
                continue;
            }

            $isbns[] = self::convertIsbn10ToIsbn13($isbn);
        }

        return $isbns;
    }

    private static function convertIsbnAToIsbn13($str)
    {
        return str_replace(['.', '/'], '', $str);
    }

    private static function stripHyphenation($match, $limit)
    {
        $isbn = $match[1];
        $hyphen = isset($match[2]) ? $match[2] : null;

        if ($hyphen) {
            if (mb_substr_count($isbn, $hyphen, 'UTF-8') !== $limit) {
                return;
            }

            return str_replace($hyphen, '', $isbn);
        }

        return $isbn;
    }

    private static function isValidIsbn13($str)
    {
        if (strlen($str) !== 13) {
            return false;
        }

        $checkDigit = self::isbn13CheckDigit($str);

        return $checkDigit === (int) $str[12];
    }

    private static function isValidIsbn10($str)
    {
        if (strlen($str) !== 10) {
            return false;
        }

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
