<?php

declare(strict_types=1);

namespace Ipc;

use Ipc\IO\Printer;
use Ipc\Providers\UserProvider;

final readonly class UserImporter
{
    /**
     * @param list<UserProvider> $providers
     */
    public function __construct(
        private array $providers,
        private Printer $printer,
    ) {
    }

    public function run(): void
    {
        $users = [];
        foreach ($this->providers as $provider) {
            $users[] = $provider->handle();
        }

        $users = array_merge(...$users);

        $this->printer->printUsers($users);
    }
}
