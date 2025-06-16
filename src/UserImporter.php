<?php

declare(strict_types=1);

namespace Ipc;

use Ipc\IO\ConsolePrinter;
use Ipc\Providers\CsvProvider;
use Ipc\Providers\WebProvider;

final class UserImporter
{
    private CsvProvider $csvProvider;
    private WebProvider $webProvider;
    private ConsolePrinter $consolePrinter;

    public function __construct()
    {
        $this->csvProvider = new CsvProvider();
        $this->webProvider = new WebProvider();
        $this->consolePrinter = new ConsolePrinter();
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

        return $this->consolePrinter->printUsers($providers);
    }
}
