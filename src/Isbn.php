<?php
namespace Altmetric\Identifiers;

class Isbn
{
    public static function extract($str)
    {
        preg_match_all('/\b97[89]\d{10}\b/', str_replace('-', '', $str), $matches);

        return array_filter($matches[0], [__CLASS__, 'isValidIsbn13']);
    }

    private static function isValidIsbn13($str)
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
        $sum += $str[12];

        return ($sum % 10) === 0;
    }
}
