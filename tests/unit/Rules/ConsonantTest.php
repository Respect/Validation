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
 * @covers \Respect\Validation\Rules\Consonant
 *
 * @author Danilo Correa <danilosilva87@gmail.com>
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Kleber Hamada Sato <kleberhs007@yahoo.com>
 * @author Nick Lombard <github@jigsoft.co.za>
 */
final class ConsonantTest extends RuleTestCase
{
    /**
     * {@inheritDoc}
     */
    public function providerForValidInput(): array
    {
        $consonant = new Consonant();

        return [
            'Letter "b"' => [$consonant, 'b'],
            'Letter "c"' => [$consonant, 'c'],
            'Letter "d"' => [$consonant, 'd'],
            'Letter "w"' => [$consonant, 'w'],
            'Letter "y"' => [$consonant, 'y'],
            'String "bcdfghklmnp"' => [$consonant, 'bcdfghklmnp'],
            'String with space in the middle "bcdfghklm np"' => [$consonant, 'bcdfghklm np'],
            'String "qrst"' => [$consonant, 'qrst'],
            'String with cntrl "\nz\t"' => [$consonant, "\nz\t"],
            'String "zbcxwyrspq"' => [$consonant, 'zbcxwyrspq'],
            'Ignoring characters "!@#$%^&*(){}"' => [new Consonant('!@#$%^&*(){}'), '!@#$%^&*(){} bc dfg'],
            'Ignoring characters "[]?+=/\\-_|"\',<>."' => [
                new Consonant('[]?+=/\\-_|"\',<>.'), "[]?+=/\\-_|\"',<>. \t \n bc dfg",
            ],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function providerForInvalidInput(): array
    {
        $consonant = new Consonant();

        return [
            'Parameter empty' => [$consonant, ''],
            'Letter "a"' => [$consonant, 'a'],
            'Parameter "null"' => [$consonant, null],
            'Number "16"' => [$consonant, '16'],
            'Alphabet "aeiou"' => [$consonant, 'aeiou'],
            'String "Foo"' => [$consonant, 'Foo'],
            'Negative integer "-50"' => [$consonant, -50],
            'String "basic"' => [$consonant, 'basic'],
            'Array empty' => [$consonant, []],
            'Integer' => [$consonant, 10],
            'Instance stdClass' => [$consonant, new stdClass()],
        ];
    }
}
