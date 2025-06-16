<?php

declare(strict_types=1);

namespace Ipc\Providers;

use DateMalformedStringException;
use Ipc\Domain\User;

final class CsvProvider implements UserProvider
{
    /**
     * @return list<User>
     * @throws DateMalformedStringException
     */
    public function handle(): array
    {
        $currentDirectory = dirname(__DIR__);
        $fileLocation = file($currentDirectory . '/../users.csv');

        $csvContent = array_map('str_getcsv', $fileLocation);

        /**
         * @var list<array{id: string, gender: string, name: string, country: string, postcode: string, email: string, birthdate: string}> $csvContent
         */
        array_walk($csvContent, static function(&$a) use ($csvContent) {
            $a = array_combine($csvContent[0], $a);
        });

        array_shift($csvContent); // Remove header column

        /** @var list<User> $users */
        $users = [];
        foreach ($csvContent as $row) {
            $now = new \DateTime();
            $itemDate = new \DateTime($row['birthdate']);

            $users[] = new User(
                (int) $row['id'],
                $row['gender'],
                $row['name'],
                $row['country'],
                $row['postcode'],
                $row['email'],
                $itemDate->diff($now)->y,
            );
        }

        return $users;
    }
}