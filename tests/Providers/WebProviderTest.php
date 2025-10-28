<?php

declare(strict_types=1);

namespace Test\Ipc\Providers;

use Ipc\Domain\User;
use Ipc\Providers\WebProvider;
use PHPUnit\Framework\TestCase;

final class WebProviderTest extends TestCase
{
    public function test_parse_url(): void
    {
        $url = 'https://randomuser.me/api/?inc=gender,name,email,location,dob&results=2&seed=a1b25cd956e2038h';
        $webProvider = new WebProvider($url);
        $expected = $webProvider->handle();

        $this->assertEquals(
            [
                new User(100000000000, 'male', 'Benedikt Brun', 'Switzerland', '1798', 'benedikt.brun@example.com', 56),
                new User(100000000001, 'male', 'Kurt Price', 'Ireland', '29007', 'kurt.price@example.com', 58),
            ],
            $expected
        );
    }
}
