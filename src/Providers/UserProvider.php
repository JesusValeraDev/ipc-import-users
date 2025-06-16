<?php

declare(strict_types=1);

namespace Ipc\Providers;

use Ipc\Domain\User;

interface UserProvider
{
    /**
     * @return list<User>
     */
    public function handle(): array;
}