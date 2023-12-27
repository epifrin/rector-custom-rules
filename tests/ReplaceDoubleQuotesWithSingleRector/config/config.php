<?php

declare(strict_types=1);

use Epifrin\RectorCustomRules\RectorRules\ReplaceDoubleQuotesWithSingleRector;
use Rector\Config\RectorConfig;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rule(ReplaceDoubleQuotesWithSingleRector::class);
};