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
     * {@inheritDoc}
     */
    public function providerForValidInput(): array
    {
        $sut = new Vowel();

        return [
            [$sut, 'a'],
            [$sut, 'e'],
            [$sut, 'i'],
            [$sut, 'o'],
            [$sut, 'u'],
            [$sut, 'aeiou'],
            [$sut, 'uoiea'],
            [new Vowel('!@#$%^&*(){}'), '!@#$%^&*(){}aeoiu'],
            [new Vowel('[]?+=/\\-_|"\',<>.'), '[]?+=/\\-_|"\',<>.aeoiu'],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function providerForInvalidInput(): array
    {
        $sut = new Vowel();

        return [
            [$sut, ''],
            [$sut, ' '],
            [$sut, "\n"],
            [$sut, "\t"],
            [$sut, "\r"],
            [$sut, null],
            [$sut, '16'],
            [$sut, 'F'],
            [$sut, 'g'],
            [$sut, 'Foo'],
            [$sut, -50],
            [$sut, 'basic'],
        ];
    }
}
