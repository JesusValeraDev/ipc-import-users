<?php

declare(strict_types=1);

use Ipc\IO\ConsolePrinter;
use Ipc\Providers\CsvProvider;
use Ipc\Providers\WebProvider;

require __DIR__ . '/vendor/autoload.php';

$importer = new \Ipc\UserImporter(
    providers: [
        new CsvProvider(__DIR__ . '/users.csv'),
        new WebProvider(),
    ],
    printer: new ConsolePrinter()
);

echo $importer->run();
