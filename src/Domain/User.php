<?php

declare(strict_types=1);

namespace Ipc\Domain;

final readonly class User
{
    public function __construct(
        public int $id,
        public string $gender,
        public string $name,
        public string $country,
        public string $postal_code,
        public string $email,
        public int $age,
    ) {
    }
}
