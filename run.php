<?php

declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

$importer = new \Ipc\UserImporter();

echo $importer->run();
