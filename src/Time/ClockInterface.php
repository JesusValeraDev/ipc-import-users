<?php

declare(strict_types=1);

namespace Ipc\Time;

use DateTimeImmutable;

/**
 * PSR-20: https://www.php-fig.org/psr/psr-20/
 */
interface ClockInterface
{
    public function now(): DateTimeImmutable;
}
