<?php

declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

$printer = new \Ipc\IO\ConsoleTablePrinter();
//$printer = new \Ipc\IO\ConsoleJsonPrinter();

$importer = new \Ipc\UserImporter(
    providers: [
        new Ipc\Providers\CsvProvider(__DIR__ . '/users.csv', new \Ipc\Time\Clock()),
        new Ipc\Providers\WebProvider('https://randomuser.me/api/?inc=gender,name,email,location,dob&results=5&seed=a9b25cd955e2037h'),
    ],
    printer: $printer,
);

$importer->run();
