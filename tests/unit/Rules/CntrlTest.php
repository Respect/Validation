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
 * @covers \Respect\Validation\Rules\AbstractFilterRule
 * @covers \Respect\Validation\Rules\Cntrl
 *
 * @author Andre Ramaciotti <andre@ramaciotti.com>
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Nick Lombard <github@jigsoft.co.za>
 * @author Pascal Borreli <pascal@borreli.com>
 */
final class CntrlTest extends RuleTestCase
{
    /**
     * {@inheritDoc}
     */
    public function providerForValidInput(): array
    {
        $cntrl = new Cntrl();

        return [
            '\n' => [$cntrl, "\n"],
            '\r' => [$cntrl, "\r"],
            '\t' => [$cntrl, "\t"],
            '\n\r\t' => [$cntrl, "\n\r\t"],
            'Ignoring all characters' => [new Cntrl('!@#$%^&*(){} '), '!@#$%^&*(){} '],
            'Ignoring some characters' => [new Cntrl('[]?+=/\\-_|"\',<>. '), "[]?+=/\\-_|\"',<>. \t \n"],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function providerForInvalidInput(): array
    {
        $cntrl = new Cntrl();

        return [
            'empty parameter' => [$cntrl, ''],
            '16-50' => [$cntrl, '16-50'],
            'a' => [$cntrl, 'a'],
            'white space' => [$cntrl, ' '],
            'Foo' => [$cntrl, 'Foo'],
            '12.1' => [$cntrl, '12.1'],
            '"-12"' => [$cntrl, '-12'],
            '-12' => [$cntrl, -12],
            'alganet' => [$cntrl, 'alganet'],
            'empty array parameter' => [$cntrl, []],
            'object' => [$cntrl, new stdClass()],
        ];
    }
}
