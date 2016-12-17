<?php
namespace Altmetric\Identifiers;

class RepecId
{
    public static function extract($str)
    {
        preg_match_all('/\brepec:\S+\b/i', $str, $matches);

        return array_map(
            function ($repecId) {
                list($prefix, $id) = explode(':', $repecId, 2);

                return 'RePEc:' . $id;
            },
            $matches[0]
        );
    }
}
