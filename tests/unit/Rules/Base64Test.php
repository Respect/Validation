<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Test\RuleTestCase;

/**
 * @group  rule
 * @covers \Respect\Validation\Rules\Base64
 */
class Base64Test extends RuleTestCase
{
    public function providerForValidInput(): array
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

    public function providerForInvalidInput(): array
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
