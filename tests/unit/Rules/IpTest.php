<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Exceptions\InvalidRuleConstructorException;
use Respect\Validation\Test\RuleTestCase;

use function extension_loaded;

use const FILTER_FLAG_IPV6;
use const FILTER_FLAG_NO_PRIV_RANGE;

#[Group('rule')]
#[CoversClass(Ip::class)]
final class IpTest extends RuleTestCase
{
    #[Test]
    #[DataProvider('providerForInvalidRanges')]
    public function invalidRangeShouldRaiseException(string $range): void
    {
        $this->expectException(InvalidRuleConstructorException::class);

        new Ip($range);
    }

    /**
     * @return string[][]
     */
    public static function providerForInvalidRanges(): array
    {
        return [
            ['192.168'],
            ['asd'],
            ['192.168.0.0-192.168.0.256'],
            ['192.168.0.0-192.168.0.1/4'],
            ['192.168.0/1'],
            ['192.168.2.0/256.256.256.256'],
            ['192.168.2.0/8.256.256.256'],
        ];
    }

    /** @return iterable<array{Ip, mixed}> */
    public static function providerForValidInput(): iterable
    {
        return [
            [new Ip('127.*'), '127.0.0.1'],
            [new Ip('127.0.*'), '127.0.0.1'],
            [new Ip('127.0.0.*'), '127.0.0.1'],
            [new Ip('192.168.*.6'), '192.168.2.6'],
            [new Ip('192.*.2.6'), '192.168.2.6'],
            [new Ip('*.168.2.6'), '10.168.2.6'],
            [new Ip('192.168.*.*'), '192.168.2.6'],
            [new Ip('192.*.*.*'), '192.168.2.6'],
            [new Ip('*'), '192.168.255.156'],
            [new Ip('*.*.*.*'), '192.168.255.156'],
            [new Ip('127.0.0.0-127.0.0.255'), '127.0.0.1'],
            [new Ip('192.168.0.0-192.168.255.255'), '192.168.2.6'],
            [new Ip('192.0.0.0-192.255.255.255'), '192.168.2.6'],
            [new Ip('0.0.0.0-255.255.255.255'), '192.168.2.6'],
            [new Ip('220.78.168/21'), '220.78.173.2'],
            [new Ip('220.78.168.0/21'), '220.78.173.2'],
            [new Ip('220.78.168.0/255.255.248.0'), '220.78.173.2'],
            [new Ip('127.0.0.1-127.0.0.5'), '127.0.0.2'],
            [new Ip('*', FILTER_FLAG_IPV6), '2001:0db8:85a3:08d3:1319:8a2e:0370:7334'],
        ];
    }

    /** @return iterable<array{Ip, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        return [
            [new Ip('127.*'), '192.0.1.0'],
            [new Ip(), ''],
            [new Ip(), null],
            [new Ip(), 'j'],
            [new Ip(), ' '],
            [new Ip(), 'Foo'],
            [new Ip('*', FILTER_FLAG_NO_PRIV_RANGE), '192.168.0.1'],
            [new Ip('127.0.1.*'), '127.0.0.1'],
            [new Ip('192.163.*.*'), '192.168.2.6'],
            [new Ip('193.*.*.*'), '192.10.2.6'],
            [new Ip('127.0.1.0-127.0.1.255'), '127.0.0.1'],
            [new Ip('192.163.0.0-192.163.255.255'), '192.168.2.6'],
            [new Ip('193.168.0.0-193.255.255.255'), '192.10.2.6'],
            [new Ip('220.78.168/21'), '220.78.176.1'],
            [new Ip('220.78.168.0/21'), '220.78.176.2'],
            [new Ip('127.0.0.1-127.0.0.5'), '127.0.0.10'],
            [new Ip('220.78.168.0/255.255.248.0'), '220.78.176.3'],
        ];
    }

    protected function setUp(): void
    {
        if (extension_loaded('bcmath')) {
            return;
        }

        $this->markTestSkipped('You need bcmath to execute this test');
    }
}
