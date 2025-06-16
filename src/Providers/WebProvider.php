<?php

declare(strict_types=1);

namespace Ipc\Providers;

use Ipc\Domain\User;

final class WebProvider implements UserProvider
{
    private const string USER_URL = 'https://randomuser.me/api/?inc=gender,name,email,location,dob&results=5&seed=a9b25cd955e2037h';

    /**
     * @return list<User>
     */
    public function handle(): array
    {
        $web_provider = json_decode(file_get_contents(self::USER_URL))->results;

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