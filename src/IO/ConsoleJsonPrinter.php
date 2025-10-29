<?php

declare(strict_types=1);

namespace Ipc\IO;

use Ipc\Domain\User;

final class ConsoleJsonPrinter implements Printer
{
    /**
     * @param list<User> $users
     */
    public function printUsers(array $users): void
    {
        $filtered = array_map(
            static fn(User $user): array => [
                'id' => $user->id,
                'country' => $user->country,
                'name' => $user->name,
                'email' => $user->email,
                'age' => $user->age,
            ],
            $users
        );

        echo json_encode($filtered, JSON_PRETTY_PRINT);
    }
}
