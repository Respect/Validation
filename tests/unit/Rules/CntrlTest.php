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
     * {@inheritdoc}
     */
    public function providerForValidInput(): array
    {
        $cntrl = new Cntrl();

        return [
            'Cntrl \n' => [$cntrl, "\n"],
            'Cntrl \r' => [$cntrl, "\r"],
            'Cntrl \t' => [$cntrl, "\t"],
            'Cntrl \n\r\t' => [$cntrl, "\n\r\t"],
            'Cntrl ignoring all characters' => [new Cntrl('!@#$%^&*(){} '), '!@#$%^&*(){} '],
            'Cntrl ignoring some characters' => [new Cntrl('[]?+=/\\-_|"\',<>. '), "[]?+=/\\-_|\"',<>. \t \n"],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function providerForInvalidInput(): array
    {
        $cntrl = new Cntrl();

        return [
            'Cntrl with empty parameter' => [$cntrl, ''],
            'Cntrl with 16-50' => [$cntrl, '16-50'],
            'Cntrl with a' => [$cntrl, 'a'],
            'Cntrl with white space' => [$cntrl, ' '],
            'Cntrl with Foo' => [$cntrl, 'Foo'],
            'Cntrl with 12.1' => [$cntrl, '12.1'],
            'Cntrl with "-12"' => [$cntrl, '-12'],
            'Cntrl with -12' => [$cntrl, -12],
            'Cntrl with alganet' => [$cntrl, 'alganet'],
            'Cntrl with empty array parameter' => [$cntrl, []],
            'Cntrl with instance stdClass' => [$cntrl, new stdClass()],
        ];
    }
}
