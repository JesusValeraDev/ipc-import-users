<?php

declare(strict_types=1);

namespace Ipc\IO;

final class ConsolePrinter
{
    public function printUsers(array $providers): string
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
