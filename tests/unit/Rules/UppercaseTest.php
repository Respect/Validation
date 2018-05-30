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
 * @group  rule
 *
 * @covers \Respect\Validation\Rules\Uppercase
 * @covers \Respect\Validation\Exceptions\UppercaseException
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Danilo Benevides <danilobenevides01@gmail.com>
 * @author Jean Pimentel <jeanfap@gmail.com>
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 */
final class UppercaseTest extends RuleTestCase
{
    /*
    * {@inheritdoc}
    */
    public function providerForValidInput(): array
    {
        return [
            [new Uppercase(), ''],
            [new Uppercase(), 'UPPERCASE'],
            [new Uppercase(), 'UPPERCASE-WITH-DASHES'],
            [new Uppercase(), 'UPPERCASE WITH SPACES'],
            [new Uppercase(), 'UPPERCASE WITH NUMBERS 123'],
            [new Uppercase(), 'UPPERCASE WITH SPECIALS CHARACTERS LIKE Ã Ç Ê'],
            [new Uppercase(), 'WITH SPECIALS CHARACTERS LIKE # $ % & * +'],
            [new Uppercase(), 'ΤΆΧΙΣΤΗ ΑΛΏΠΗΞ ΒΑΦΉΣ ΨΗΜΈΝΗ ΓΗ, ΔΡΑΣΚΕΛΊΖΕΙ ΥΠΈΡ ΝΩΘΡΟΎ ΚΥΝΌΣ'],
        ];
    }

    /*
    * {@inheritdoc}
    */
    public function providerForInvalidInput(): array
    {
        return [
            [new Uppercase(), 'lowercase'],
            [new Uppercase(), 'CamelCase'],
            [new Uppercase(), 'First Character Uppercase'],
            [new Uppercase(), 'With Numbers 1 2 3'],
        ];
    }
}
