<?php
namespace Altmetric\Identifiers;

class NationalClinicalTrialId
{
    public static function extract(?string $str): array
    {
        $str = $str ?? '';
        preg_match_all('/\bNCT\d+\b/ui', $str, $matches);

        return array_map('strtoupper', $matches[0]);
    }
}
