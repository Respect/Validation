<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Test\RuleTestCase;
use stdClass;

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\AbstractFilterRule
 * @covers \Respect\Validation\Rules\Control
 *
 * @author Andre Ramaciotti <andre@ramaciotti.com>
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Nick Lombard <github@jigsoft.co.za>
 * @author Pascal Borreli <pascal@borreli.com>
 */
final class ControlTest extends RuleTestCase
{
    /**
     * {@inheritDoc}
     */
    public function providerForValidInput(): array
    {
        $sut = new Control();

        return [
            '\n' => [$sut, "\n"],
            '\r' => [$sut, "\r"],
            '\t' => [$sut, "\t"],
            '\n\r\t' => [$sut, "\n\r\t"],
            'Ignoring all characters' => [new Control('!@#$%^&*(){} '), '!@#$%^&*(){} '],
            'Ignoring some characters' => [new Control('[]?+=/\\-_|"\',<>. '), "[]?+=/\\-_|\"',<>. \t \n"],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function providerForInvalidInput(): array
    {
        $sut = new Control();

        return [
            'empty parameter' => [$sut, ''],
            '16-50' => [$sut, '16-50'],
            'a' => [$sut, 'a'],
            'white space' => [$sut, ' '],
            'Foo' => [$sut, 'Foo'],
            '12.1' => [$sut, '12.1'],
            '"-12"' => [$sut, '-12'],
            '-12' => [$sut, -12],
            'alganet' => [$sut, 'alganet'],
            'empty array parameter' => [$sut, []],
            'object' => [$sut, new stdClass()],
        ];
    }
}
