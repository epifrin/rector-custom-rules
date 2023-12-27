<?php

declare(strict_types=1);

use Epifrin\RectorCustomRules\RectorRules\ConvertPrivateMethodsNameToCamelCaseRector;
use Rector\Config\RectorConfig;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rule(ConvertPrivateMethodsNameToCamelCaseRector::class);
};