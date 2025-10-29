<?php

declare(strict_types=1);

namespace Ipc\IO;

use Ipc\Domain\User;

interface Printer
{
    /**
     * @param list<User> $users
     */
    public function printUsers(array $users): void;
}
