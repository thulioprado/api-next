<?php

declare(strict_types=1);

require_once __DIR__.'/../vendor/autoload.php';

$macros = glob(__DIR__.'/helpers/Macros/*');
if ($macros === false) {
    return;
}

foreach ($macros as $macro) {
    /** @noinspection PhpIncludeInspection */
    require_once $macro;
}
