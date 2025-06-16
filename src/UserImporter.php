<?php

declare(strict_types=1);

namespace Ipc;

use Ipc\Providers\CsvProvider;
use Ipc\Providers\WebProvider;

final class UserImporter
{
    private CsvProvider $csvProvider;
    private WebProvider $webProvider;

    public function __construct()
    {
        $this->csvProvider = new CsvProvider();
        $this->webProvider = new WebProvider();
    }

    public function run(): string
    {
        $csv_provider = $this->csvProvider->csvProvider();
        $web_provider = $this->webProvider->webProvider();

        /**
         *  0: string|int (id)
         *  1: string     (gender)
         *  2: string     (name)
         *  3: string     (country)
         *  4: string     (postal_code)
         *  5: string     (email)
         *  6: int        (age)
         */
        $providers = array_merge($csv_provider, $web_provider); // merge arrays

        return $this->printUsers($providers);
    }

    private function printUsers(array $providers): string
    {
        // Print users
        $return = str_repeat('*', 89) . PHP_EOL;
        $return .= "* ID\t\t* COUNTRY\t* NAME\t\t* EMAIL\t\t\t\t* AGE\t*" . PHP_EOL;
        $return .= str_repeat('*', 89) . PHP_EOL;
        foreach ($providers as $item) {
            $return .= sprintf(
                    "* %s\t* %s\t* %s\t* %s\t* %s\t*",
                    $item[0],
                    $item[3],
                    $item[2],
                    $item[5],
                    $item[6]
                ) . PHP_EOL;
        }
        $return .= str_repeat('*', 89) . PHP_EOL;
        $return .= count($providers) . ' users in total!' . PHP_EOL;

        return $return;
    }
}
