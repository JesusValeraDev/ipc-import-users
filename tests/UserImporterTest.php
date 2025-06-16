<?php

declare(strict_types=1);

namespace Test\Ipc;

use PHPUnit\Framework\TestCase;

final class UserImporterTest extends TestCase
{
    public function test_users_are_imported_correctly(): void
    {
        ob_start();
        require_once dirname(__DIR__) . '/run.php';
        $response = ob_get_clean();

        self::assertSame($this->expectedOutput(), $response);
    }

    private function expectedOutput(): string
    {
        return <<<TXT
*****************************************************************************************
* ID		* COUNTRY	* NAME		* EMAIL				* AGE	*
*****************************************************************************************
* 200189617246	* Germany	* Lukas Schmidt	* lukas.shmidt@example.com	* 28	*
* 200189016257	* Germany	* Maria Fischer	* maria.fischer@example.com	* 34	*
* 230573109005	* Spain 	* Luis Sanchez	* luis.sanchez@example.com	* 24	*
* 230854119034	* Italy 	* Elio Pausini	* elio.pausini@example.com	* 49	*
* 270054311737	* India 	* Mitesh Kumari	* mitesh.kumari@example.com	* 28	*
* 202160712259	* Germany	* Elena Mueller	* elena.muller@example.com	* 33	*
* 270554319031	* India 	* Natasha Shah	* natasha.shah@example.com	* 36	*
* 100000000000	* Australia	* Nevaeh Dunn	* nevaeh.dunn@example.com	* 54	*
* 100000000001	* Norway	* Sara Abdallah	* sara.abdallah@example.com	* 80	*
* 100000000002	* France	* Melvin Perrin	* melvin.perrin@example.com	* 61	*
* 100000000003	* Australia	* Dawn Snyder	* dawn.snyder@example.com	* 73	*
* 100000000004	* Netherlands	* Irina Kaptein	* irina.kaptein@example.com	* 40	*
*****************************************************************************************
12 users in total!

TXT;
    }
}
