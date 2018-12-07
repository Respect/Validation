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

use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Test\RuleTestCase;

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\Ip
 *
 * @author Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 * @author Danilo Benevides <danilobenevides01@gmail.com>
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Luís Otávio Cobucci Oblonczyk <lcobucci@gmail.com>
 */
final class IpTest extends RuleTestCase
{
    /**
     * @throws ComponentException
     *
     * {@inheritdoc}
     */
    public function providerForValidInput(): array
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
        ];
    }

    /**
     * @throws ComponentException
     *
     * {@inheritdoc}
     */
    public function providerForInvalidInput(): array
    {
        return [
           [new Ip('127.*'), '192.0.1.0'],
           [new Ip(), ''],
           [new Ip(), null],
           [new Ip(), 'j'],
           [new Ip(), ' '],
           [new Ip(), 'Foo'],
           [new Ip(FILTER_FLAG_NO_PRIV_RANGE), '192.168.0.1'],
           [new Ip('127.0.1.*'), '127.0.0.1'],
           [new Ip('192.163.*.*'), '192.168.2.6'],
           [new Ip('193.*.*.*'), '192.10.2.6'],
           [new Ip('127.0.1.0-127.0.1.255'), '127.0.0.1'],
           [new Ip('192.163.0.0-192.163.255.255'), '192.168.2.6'],
           [new Ip('193.168.0.0-193.255.255.255'), '192.10.2.6'],
           [new Ip('220.78.168/21'), '220.78.176.1'],
           [new Ip('220.78.168.0/21'), '220.78.176.2'],
           [new Ip('220.78.168.0/255.255.248.0'), '220.78.176.3'],
       ];
    }

    public function providerForInvalidRanges(): array
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

    /**
     * @test
     *
     * @dataProvider providerForInvalidRanges
     *
     * @param string $range
     *
     * @throws ComponentException
     */
    public function invalidRangeShouldRaiseException(string $range): void
    {
        $this->expectException(ComponentException::class);

        new Ip($range);
    }
}
