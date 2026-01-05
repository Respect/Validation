<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\Validation\Test\RuleTestCase;

#[Group('validator')]
#[CoversClass(Url::class)]
final class UrlTest extends RuleTestCase
{
    /** @return iterable<array{Url, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $validator = new Url();

        return [
            [$validator, 'ftp://ftp.is.co.za.example.org/rfc/rfc1808.txt'],
            [$validator, 'gopher://spinaltap.micro.umn.example.edu/00/Weather/California/Los%20Angeles'],
            [$validator, 'http://www.ietf.org/rfc/rfc2396.txt'],
            [$validator, 'http://www.math.uio.no.example.net/faq/compression-faq/part1.html'],
            [$validator, 'https://www.youtube.com/watch?v=6FOUqQt3Kg0'],
            [$validator, 'ldap://[2001:db8::7]/c=GB?objectClass?one'],
            [$validator, 'mailto:John.Doe@example.com'],
            [$validator, 'mailto:mduerst@ifi.unizh.example.gov'],
            [$validator, 'news:comp.infosystems.www.servers.unix'],
            [$validator, 'news:comp.infosystems.www.servers.unix'],
            [$validator, 'telnet://192.0.2.16:80/'],
            [$validator, 'telnet://melvyl.ucop.example.edu/'],
        ];
    }

    /** @return iterable<array{Url, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $validator = new Url();

        return [
            [$validator, 'example.com'],
            [$validator, 'http:/example.com/'],
            [$validator, 'tel:+1-816-555-1212'],
            [$validator, 'urn:oasis:names:specification:docbook:dtd:xml:4.1.2'],
        ];
    }
}
