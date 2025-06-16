<?php

declare(strict_types=1);

namespace Ipc\Providers;

final class WebProvider
{
    private const string USER_URL = 'https://randomuser.me/api/?inc=gender,name,email,location,dob&results=5&seed=a9b25cd955e2037h';

    public function webProvider(): array
    {
        // Parse URL content
        $url = self::USER_URL;
        $web_provider = json_decode(file_get_contents($url))->results;
        $pr = [];
        array_walk($pr, function (&$a) use ($web_provider) {
            $a = array_combine($web_provider[0], $a);
        });

        $b = [];
        foreach ($web_provider as $index => $item) {
            $id = 100000000000;
            $b[] = [
                $id + $index,
                $item->gender,
                $item->name->first . ' ' . $item->name->last,
                $item->location->country,
                $item->location->postcode,
                $item->email,
                $item->dob->age
            ];
        }

        return $b;
    }
}