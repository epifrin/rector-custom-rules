<?php
declare(strict_types=1);

namespace Epifrin\RectorCustomRules\Helpers;

final class StringHelper
{
    public static function toCamelCase(string $string): string
    {
        $words = explode(' ', str_replace(['-', '_'], ' ', $string));

        $studlyWords = array_map(static fn($word) => ucfirst($word), $words);

        return lcfirst(implode($studlyWords));
    }
}
