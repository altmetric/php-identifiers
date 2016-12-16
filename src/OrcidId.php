<?php

namespace Altmetric\Identifiers;

class OrcidId
{
    public static function extract($str)
    {
        preg_match_all('/\d{4}-\d{4}-\d{4}-\d{3}[\dX]/', $str, $matches);

        return array_filter($matches[0], [__CLASS__, 'isValid']);
    }

    private static function isValid($str)
    {
        $digits = str_replace('-', '', $str);
        $baseDigits = substr($digits, 0, 15);
        $checkDigit = $digits[15];

        for ($i = 0, $total = 0; $i < 15; $i += 1) {
            $total = ($total + $digits[$i]) * 2;
        }

        $remainder = $total % 11;
        $result = (12 - $remainder) % 11;
        $expectedCheckDigit = $result === 10 ? 'X' : (string) $result;

        return $checkDigit === $expectedCheckDigit;
    }
}
