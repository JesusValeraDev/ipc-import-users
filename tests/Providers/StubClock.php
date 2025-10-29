<?php

declare(strict_types=1);

namespace Test\Ipc\Providers;

use DateTimeImmutable;
use Ipc\Time\ClockInterface;

final class StubClock implements ClockInterface
{
    public function now(): DateTimeImmutable
    {
        return new DateTimeImmutable('2020-01-01 00:00:00');
    }
}
