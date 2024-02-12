<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\Validation\Test\RuleTestCase;

#[Group('rule')]
#[CoversClass(Url::class)]
final class UrlTest extends RuleTestCase
{
    /** @return iterable<array{Url, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $rule = new Url();

        return [
            [$rule, 'ftp://ftp.is.co.za.example.org/rfc/rfc1808.txt'],
            [$rule, 'gopher://spinaltap.micro.umn.example.edu/00/Weather/California/Los%20Angeles'],
            [$rule, 'http://www.ietf.org/rfc/rfc2396.txt'],
            [$rule, 'http://www.math.uio.no.example.net/faq/compression-faq/part1.html'],
            [$rule, 'https://www.youtube.com/watch?v=6FOUqQt3Kg0'],
            [$rule, 'ldap://[2001:db8::7]/c=GB?objectClass?one'],
            [$rule, 'mailto:John.Doe@example.com'],
            [$rule, 'mailto:mduerst@ifi.unizh.example.gov'],
            [$rule, 'news:comp.infosystems.www.servers.unix'],
            [$rule, 'news:comp.infosystems.www.servers.unix'],
            [$rule, 'telnet://192.0.2.16:80/'],
            [$rule, 'telnet://melvyl.ucop.example.edu/'],
        ];
    }

    /** @return iterable<array{Url, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $rule = new Url();

        return [
            [$rule, 'example.com'],
            [$rule, 'http:/example.com/'],
            [$rule, 'tel:+1-816-555-1212'],
            [$rule, 'urn:oasis:names:specification:docbook:dtd:xml:4.1.2'],
        ];
    }
}
