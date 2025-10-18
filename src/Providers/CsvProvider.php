<?php

declare(strict_types=1);

namespace Ipc\Providers;

use DateMalformedStringException;
use Ipc\Domain\User;

final readonly class CsvProvider implements UserProvider
{
    public function __construct(
        private string $fileLocation,
    ) {
    }

    /**
     * @return list<User>
     * @throws DateMalformedStringException
     */
    public function handle(): array
    {
        $csvContent = array_map(fn ($s) => str_getcsv($s, ',', '"', "\\"), file($this->fileLocation));

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