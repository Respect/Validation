<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: Jens Segers <segers.jens@gmail.com>
 * SPDX-FileContributor: William Espindola <oi@williamespindola.com.br>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\Validation\Test\RuleTestCase;

use function implode;

#[Group('validator')]
#[CoversClass(Base64::class)]
final class Base64Test extends RuleTestCase
{
    /** @return iterable<array{Base64, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $validator = new Base64();

        $lines = [
            'TWFuIGlzIGRpc3Rpbmd1aXNoZWQsIG5vdCBvbmx5IGJ5IGhpcyByZWFzb24sIGJ1dCBieSB0aGlz',
            'IHNpbmd1bGFyIHBhc3Npb24gZnJvbSBvdGhlciBhbmltYWxzLCB3aGljaCBpcyBhIGx1c3Qgb2Yg',
            'dGhlIG1pbmQsIHRoYXQgYnkgYSBwZXJzZXZlcmFuY2Ugb2YgZGVsaWdodCBpbiB0aGUgY29udGlu',
            'dWVkIGFuZCBpbmRlZmF0aWdhYmxlIGdlbmVyYXRpb24gb2Yga25vd2xlZGdlLCBleGNlZWRzIHRo',
            'ZSBzaG9ydCB2ZWhlbWVuY2Ugb2YgYW55IGNhcm5hbCBwbGVhc3VyZS4=',
        ];

        return [
            [$validator, 'YW55IGNhcm5hbCBwbGVhc3VyZS4='],
            [$validator, 'YW55IGNhcm5hbCBwbGVhc3VyZQ=='],
            [$validator, 'YW55IGNhcm5hbCBwbGVhc3Vy'],
            [$validator, 'YW55IGNhcm5hbCBwbGVhc3U='],
            [$validator, 'YW55IGNhcm5hbCBwbGVhcw=='],
            [$validator, 'cGxlYXN1cmUu'],
            [$validator, 'bGVhc3VyZS4='],
            [$validator, 'ZWFzdXJlLg=='],
            [$validator, 'YXN1cmUu'],
            [$validator, 'c3VyZS4='],
            [$validator, 'WeJcFMQ/8+8QJ/w0hHh+0g=='],
            [$validator, implode("\n", $lines)],
            [$validator, implode("\r\n", $lines)],
        ];
    }

    /** @return iterable<array{Base64, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $validator = new Base64();

        return [
            [$validator, []],
            [$validator, 1.2],
            [$validator, false],
            [$validator, 123],
            [$validator, null],
            [$validator, ''],
            [$validator, 'hello!'],
            [$validator, '=c3VyZS4'],
            [$validator, 'YW55IGNhcm5hbCBwbGVhc3VyZ==='],
        ];
    }
}
