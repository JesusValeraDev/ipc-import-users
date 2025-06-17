<?php

declare(strict_types=1);

namespace Ipc\Providers;

use Ipc\Domain\User;

final readonly class WebProvider implements UserProvider
{
    public function __construct(
        private string $userUrl,
    ) {
    }

    /**
     * @return list<User>
     */
    public function handle(): array
    {
        $content = file_get_contents($this->userUrl);
        $web_provider = json_decode($content)->results;

        /** @var list<User> $users */
        $users = [];

        foreach ($web_provider as $index => $item) {
            $id = 100000000000;
            $users[] = new User(
                $id + $index,
                $item->gender,
                $item->name->first . ' ' . $item->name->last,
                $item->location->country,
                (string) $item->location->postcode,
                $item->email,
                $item->dob->age
            );
        }

        return $users;
    }
}
