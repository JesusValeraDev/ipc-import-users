<?php

declare(strict_types=1);

namespace Ipc;

use Ipc\IO\ConsolePrinter;
use Ipc\Providers\UserProvider;

final readonly class UserImporter
{
    /**
     * @param list<UserProvider> $providers
     */
    public function __construct(
        private array $providers,
        private ConsolePrinter $printer = new ConsolePrinter(),
    ) {
    }

    public function run(): string
    {
        $users = [];
        foreach ($this->providers as $provider) {
            $users[] = $provider->handle();
        }

        $users = array_merge(...$users);

        return $this->printer->printUsers($users);
    }
}
