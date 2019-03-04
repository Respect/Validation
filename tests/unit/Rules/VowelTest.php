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
 * @group rule
 *
 * @covers \Respect\Validation\Rules\AbstractFilterRule
 * @covers \Respect\Validation\Rules\Vowel
 *
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Kleber Hamada Sato <kleberhs007@yahoo.com>
 * @author Nick Lombard <github@jigsoft.co.za>
 * @author Pascal Borreli <pascal@borreli.com>
 */
final class VowelTest extends RuleTestCase
{
    /**
     * {@inheritdoc}
     */
    public function providerForValidInput(): array
    {
        $vowel = new Vowel();

        return [
            [$vowel, 'a'],
            [$vowel, 'e'],
            [$vowel, 'i'],
            [$vowel, 'o'],
            [$vowel, 'u'],
            [$vowel, 'aeiou'],
            [$vowel, 'aei ou'],
            [$vowel, "\na\t"],
            [$vowel, 'uoiea'],
            [new Vowel('!@#$%^&*(){}'), '!@#$%^&*(){} aeo iu'],
            [new Vowel('[]?+=/\\-_|"\',<>.'), "[]?+=/\\-_|\"',<>. \t \n aeo iu"],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function providerForInvalidInput(): array
    {
        $vowel = new Vowel();

        return [
            [$vowel, ''],
            [$vowel, null],
            [$vowel, '16'],
            [$vowel, 'F'],
            [$vowel, 'g'],
            [$vowel, 'Foo'],
            [$vowel, -50],
            [$vowel, 'basic'],
        ];
    }
}
