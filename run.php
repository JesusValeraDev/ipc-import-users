<?php

declare(strict_types=1);

use Ipc\IO\ConsolePrinter;
use Ipc\Providers\CsvProvider;
use Ipc\Providers\WebProvider;

require __DIR__ . '/vendor/autoload.php';

$importer = new \Ipc\UserImporter(
    providers: [
        new CsvProvider(),
        new WebProvider(),
    ],
    printer: new ConsolePrinter()
);

echo $importer->run();
