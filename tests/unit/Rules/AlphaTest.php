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
use stdClass;

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\Alpha
 *
 * @author Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Nick Lombard <github@jigsoft.co.za>
 * @author Pascal Borreli <pascal@borreli.com>
 */
final class AlphaTest extends RuleTestCase
{
    /**
     * @dataProvider providerForInvalidParams
     * @expectedException \Respect\Validation\Exceptions\ComponentException
     *
     * @test
     */
    public function invalidConstructorParamsShouldThrowComponentException($additional): void
    {
        new Alpha($additional);
    }

    public function providerForInvalidParams(): array
    {
        return [
            [new stdClass()],
            [[]],
            [0x2],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function providerForValidInput(): array
    {
        return [
            [new Alpha(), 'alganet'],
            [new Alpha('alganet'), 'alganet'],
            [new Alpha('0-9'), '0alg-anet0'],
            [new Alpha(), 'a'],
            [new Alpha("\t"), "\t"],
            [new Alpha("\n"), "\n"],
            [new Alpha(), 'foobar'],
            [new Alpha('_'), 'rubinho_'],
            [new Alpha('.'), 'google.com'],
            [new Alpha(' '), 'alganet alganet'],
            [new Alpha("\n"), "\nabc"],
            [new Alpha("\t"), "\tdef"],
            [new Alpha("\n\t "), "\nabc \t"],
            [new Alpha('!@#$%^&*(){} abc'), '!@#$%^&*(){}'],
            [new Alpha("[]?+=/\\-_|\"',<>. \t \n abc"), '[]?+=/\\-_|"\',<>.'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function providerForInvalidInput(): array
    {
        return [
            [new Alpha(), ''],
            [new Alpha(), '@#$'],
            [new Alpha(), '_'],
            [new Alpha(), 'dgç'],
            [new Alpha(), '122al'],
            [new Alpha(), '122'],
            [new Alpha(), 11123],
            [new Alpha(), 1e21],
            [new Alpha(), 0],
            [new Alpha(), null],
            [new Alpha(), new stdClass()],
            [new Alpha(), []],
            [new Alpha(), "\nabc"],
            [new Alpha(), "\tdef"],
            [new Alpha(), "\nabc \t"],
            [new Alpha(), "\t"],
            [new Alpha(), "\n"],
            [new Alpha(), 'alganet alganet'],
        ];
    }
}
