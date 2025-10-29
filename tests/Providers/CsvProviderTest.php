<?php

declare(strict_types=1);

namespace Test\Ipc\Providers;

use Ipc\Domain\User;
use Ipc\Providers\CsvProvider;
use Ipc\Time\Clock;
use PHPUnit\Framework\TestCase;

final class CsvProviderTest extends TestCase
{
    public function test_parse_csv(): void
    {
        $csvProvider = new CsvProvider(__DIR__ . '/fixtures/demo.csv', new StubClock());
        $expected = $csvProvider->handle();

        $this->assertEquals(
            [
                new User(123, 'male', 'Lukas Schmidt', 'Germany', '10780', 'lukas.shmidt@example.com', 29),
                new User(456, 'female', 'Maria Fischer', 'Germany', '15010', 'maria.fischer@example.com', 14),
            ],
            $expected
        );
    }
}
