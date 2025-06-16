<?php

declare(strict_types=1);

namespace Ipc;

final class UserImporter
{
    private const string USER_URL = 'https://randomuser.me/api/?inc=gender,name,email,location,dob&results=5&seed=a9b25cd955e2037h';

    public function run(): string
    {
        // Parse CSV file
        $currentDirectory = dirname(__DIR__);
        $fileLocation = file($currentDirectory . '/users.csv');
        // Fields: id, gender, name, country, postcode, email, birthdate
        $csv_provider = array_map(fn ($s) => str_getcsv($s, ',', '"', "\\"), $fileLocation);
        array_shift($csv_provider); // Remove header column
        array_walk($csv_provider, function (&$a) {
            $now = new \DateTime();
            $itemDate = new \DateTime($a[6]);
            $a[6] = $itemDate->diff($now)->y;
        });

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

        /**
         *  0: string|int (id)
         *  1: string     (gender)
         *  2: string     (name)
         *  3: string     (country)
         *  4: string     (postal_code)
         *  5: string     (email)
         *  6: int        (age)
         */
        $providers = array_merge($csv_provider, $b); // merge arrays


        // Print users
        $return = str_repeat('*', 89) . PHP_EOL;
        $return .= "* ID\t\t* COUNTRY\t* NAME\t\t* EMAIL\t\t\t\t* AGE\t*" . PHP_EOL;
        $return .= str_repeat('*', 89) . PHP_EOL;
        foreach ($providers as $item) {
            $return .= sprintf(
                    "* %s\t* %s\t* %s\t* %s\t* %s\t*",
                    $item[0],
                    $item[3],
                    $item[2],
                    $item[5],
                    $item[6]
                ) . PHP_EOL;
        }
        $return .= str_repeat('*', 89) . PHP_EOL;
        $return .= count($providers) . ' users in total!' . PHP_EOL;

        return $return;
    }
}
