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
 * @covers \Respect\Validation\Rules\Alnum
 *
 * @author Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Islam Elshobokshy <islam20088@hotmail.com>
 * @author Nick Lombard <github@jigsoft.co.za>
 * @author Pascal Borreli <pascal@borreli.com>
 */
final class AlnumTest extends RuleTestCase
{
    /**
     * @dataProvider providerForInvalidParams
     * @expectedException \Respect\Validation\Exceptions\ComponentException
     *
     * @test
     */
    public function invalidConstructorParamsShouldThrowComponentExceptionUponInstantiation($additional): void
    {
        new Alnum($additional);
    }

    public function providerForInvalidParams()
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
            [new Alnum(), 'alganet'],
            [new Alnum('- ! :'), 'foo :- 123 !'],
            [new Alnum('0-9'), '0alg-anet0'],
            [new Alnum(), '1'],
            [new Alnum(), 'a'],
            [new Alnum(), 'foobar'],
            [new Alnum('_'), 'rubinho_'],
            [new Alnum('.'), 'google.com'],
            [new Alnum(' '), 'alganet alganet'],
            [new Alnum(), 0],
            [new Alnum('!@#$%^&*(){}'), '!@#$%^&*(){}abc123'],
            [new Alnum('[]?+=/\\-_|"\',<>.'), '[]?+=/\\-_|"\',<>.abc123'],
            [new Alnum("[]?+=/\\-_|\"',<>. \t\n"), "abc[]?+=/\\-_|\"',<>. \t\n123"],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function providerForInvalidInput(): array
    {
        return [
            [new Alnum(), ''],
            [new Alnum(), 'number 100%'],
            [new Alnum('%'), 'number 100%'],
            [new Alnum(), '@#$'],
            [new Alnum(), '_'],
            [new Alnum(), 'dgç'],
            [new Alnum(), 1e21],
            [new Alnum(), null],
            [new Alnum(), new stdClass()],
            [new Alnum(), []],
            [new Alnum('%'), 'number 100%'],
            [new Alnum(), "\t"],
            [new Alnum(), "\n"],
            [new Alnum(), "\nabc"],
            [new Alnum(), "\tdef"],
            [new Alnum(), "\nabc \t"],
            [new Alnum(), 'alganet alganet'],
        ];
    }
}
