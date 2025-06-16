<?php

declare(strict_types=1);

namespace Ipc\Providers;

final class CsvProvider
{
    public function csvProvider(): array
    {
        // Parse CSV file
        $currentDirectory = dirname(__DIR__);
        $fileLocation = file($currentDirectory . '/../users.csv');

        // Fields: id, gender, name, country, postcode, email, birthdate
        $csv_provider = array_map('str_getcsv', $fileLocation);

        array_shift($csv_provider); // Remove header column

        array_walk($csv_provider, function (&$a) {
            $now = new \DateTime();
            $itemDate = new \DateTime($a[6]);
            $a[6] = $itemDate->diff($now)->y;
        });

        return $csv_provider;
    }
}