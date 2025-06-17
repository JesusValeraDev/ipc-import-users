<?php

declare(strict_types=1);

use Ipc\IO\ConsolePrinter;
use Ipc\Providers\CsvProvider;
use Ipc\Providers\WebProvider;

require __DIR__ . '/vendor/autoload.php';

$importer = new \Ipc\UserImporter(
    providers: [
        new CsvProvider(__DIR__ . '/users.csv'),
        new WebProvider('https://randomuser.me/api/?inc=gender,name,email,location,dob&results=5&seed=a9b25cd955e2037h'),
    ],
    printer: new ConsolePrinter()
);

echo $importer->run();
