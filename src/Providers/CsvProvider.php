<?php

declare(strict_types=1);

namespace Ipc\Providers;

use DateMalformedStringException;
use DateTimeImmutable;
use Ipc\Domain\User;
use Ipc\Time\ClockInterface;

final readonly class CsvProvider implements UserProvider
{
    public function __construct(
        private string $fileLocation,
        private ClockInterface $clock,
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
         * The array_walk() transforms the numeric keys into "0 > id", "1 > gender", "2 > name", ...
         * @var list<array{id: string, gender: string, name: string, country: string, postcode: string, email: string, birthdate: string}> $csvContent
         */
        array_walk(
            $csvContent,
            static function (&$row) use ($csvContent) {
                $row = array_combine($csvContent[0], $row);
            },
        );

        array_shift($csvContent); // Remove header column

        /** @var list<User> $users */
        $users = [];
        foreach ($csvContent as $row) {
            $itemDate = $this->clock->now()
                ->diff(new DateTimeImmutable($row['birthdate']))
                ->y;

            $users[] = new User(
                (int) $row['id'],
                $row['gender'],
                $row['name'],
                $row['country'],
                $row['postcode'],
                $row['email'],
                $itemDate,
            );
        }

        return $users;
    }
}
