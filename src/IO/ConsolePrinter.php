<?php

declare(strict_types=1);

namespace Ipc\IO;

use Ipc\Domain\User;

final class ConsolePrinter
{
    public function printUsers(array $providers): string
    {
        $return = str_repeat('*', 89) . PHP_EOL;
        $return .= "* ID\t\t* COUNTRY\t* NAME\t\t* EMAIL\t\t\t\t* AGE\t*" . PHP_EOL;
        $return .= str_repeat('*', 89) . PHP_EOL;
        foreach ($providers as $item) {
            if ($item instanceof User) {
                $return .= sprintf(
                        "* %s\t* %s\t* %s\t* %s\t* %s\t*",
                        $item->id,
                        $item->country,
                        $item->name,
                        $item->email,
                        $item->age
                    ) . PHP_EOL;
            } else {
                $return .= sprintf(
                        "* %s\t* %s\t* %s\t* %s\t* %s\t*",
                        $item[0],
                        $item[3],
                        $item[2],
                        $item[5],
                        $item[6]
                    ) . PHP_EOL;
            }
        }
        $return .= str_repeat('*', 89) . PHP_EOL;
        $return .= count($providers) . ' users in total!' . PHP_EOL;

        return $return;
    }
}
