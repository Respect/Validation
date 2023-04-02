<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Test\RuleTestCase;

use function implode;

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\Base64
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Jens Segers <segers.jens@gmail.com>
 * @author William Espindola <oi@williamespindola.com.br>
 */
final class Base64Test extends RuleTestCase
{
    /**
     * {@inheritDoc}
     */
    public static function providerForValidInput(): array
    {
        $rule = new Base64();

        $lines = [
            'TWFuIGlzIGRpc3Rpbmd1aXNoZWQsIG5vdCBvbmx5IGJ5IGhpcyByZWFzb24sIGJ1dCBieSB0aGlz',
            'IHNpbmd1bGFyIHBhc3Npb24gZnJvbSBvdGhlciBhbmltYWxzLCB3aGljaCBpcyBhIGx1c3Qgb2Yg',
            'dGhlIG1pbmQsIHRoYXQgYnkgYSBwZXJzZXZlcmFuY2Ugb2YgZGVsaWdodCBpbiB0aGUgY29udGlu',
            'dWVkIGFuZCBpbmRlZmF0aWdhYmxlIGdlbmVyYXRpb24gb2Yga25vd2xlZGdlLCBleGNlZWRzIHRo',
            'ZSBzaG9ydCB2ZWhlbWVuY2Ugb2YgYW55IGNhcm5hbCBwbGVhc3VyZS4=',
        ];

        return [
            [$rule, 'YW55IGNhcm5hbCBwbGVhc3VyZS4='],
            [$rule, 'YW55IGNhcm5hbCBwbGVhc3VyZQ=='],
            [$rule, 'YW55IGNhcm5hbCBwbGVhc3Vy'],
            [$rule, 'YW55IGNhcm5hbCBwbGVhc3U='],
            [$rule, 'YW55IGNhcm5hbCBwbGVhcw=='],
            [$rule, 'cGxlYXN1cmUu'],
            [$rule, 'bGVhc3VyZS4='],
            [$rule, 'ZWFzdXJlLg=='],
            [$rule, 'YXN1cmUu'],
            [$rule, 'c3VyZS4='],
            [$rule, 'WeJcFMQ/8+8QJ/w0hHh+0g=='],
            [$rule, implode("\n", $lines)],
            [$rule, implode("\r\n", $lines)],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public static function providerForInvalidInput(): array
    {
        $rule = new Base64();

        return [
            [$rule, ''],
            [$rule, 'hello!'],
            [$rule, '=c3VyZS4'],
            [$rule, 'YW55IGNhcm5hbCBwbGVhc3VyZ==='],
        ];
    }
}
