<?php

declare(strict_types=1);

namespace Ipc\IO;

use Ipc\Domain\User;

final class ConsoleTablePrinter implements Printer
{
    /**
     * @param list<User> $users
     */
    public function printUsers(array $users): void
    {
        $return = $this->printBlock();

        $return .= $this->header();

        $return .= $this->printBlock();

        $return .= $this->printUserColumns($users);

        $return .= $this->printBlock();

        $return .= $this->printTotalUsers($users);

        echo $return;
    }

    private function printBlock(): string
    {
        return str_repeat('*', 89) . PHP_EOL;
    }

    private function header(): string
    {
        return "* ID\t\t* COUNTRY\t* NAME\t\t* EMAIL\t\t\t\t* AGE\t*" . PHP_EOL;
    }

    private function printTotalUsers(array $providers): string
    {
        return count($providers) . ' users in total!' . PHP_EOL;
    }

    /**
     * @param list<User> $providers
     */
    private function printUserColumns(array $providers): string
    {
        $column = '';
        foreach ($providers as $item) {
            $column .= sprintf(
                    "* %s\t* %s\t* %s\t* %s\t* %s\t*",
                    $item->id,
                    $item->country,
                    $item->name,
                    $item->email,
                    $item->age
                ) . PHP_EOL;
        }
        return $column;
    }
}
