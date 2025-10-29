<?php

declare(strict_types=1);

namespace Ipc\Time;

use DateTimeImmutable;

final class Clock implements ClockInterface
{
    public function now(): DateTimeImmutable {
        return new DateTimeImmutable('now');
    }
}
