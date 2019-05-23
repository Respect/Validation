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
 * @covers \Respect\Validation\Rules\Digit
 *
 * @author Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Nick Lombard <github@jigsoft.co.za>
 * @author Pascal Borreli <pascal@borreli.com>
 */
final class DigitTest extends RuleTestCase
{
    /**
     * {@inheritDoc}
     */
    public function providerForValidInput(): array
    {
        return [
            'positive integer' => [new Digit(), 165],
            'positive string-integer' => [new Digit(), '01650'],
            'positive string-integer with one exception' => [new Digit('-'), '16-50'],
            'positive string-integer with multiple exceptions' => [new Digit('.-'), '16-5.0'],
            'only exceptions' => [new Digit('!@#$%^&*(){}'), '!@#$%^&*(){}'],
            'multiple exceptions' => [new Digit('.', '-'), '012.071.070-69'],
            'float' => [new Digit(), 1.0],
            'boolean true' => [new Digit(), true],
            'octal' => [new Digit(), 01],
            'string-octal' => [new Digit(), '01'],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function providerForInvalidInput(): array
    {
        return [
            'empty' => [new Digit(), ''],
            'with spaces' => [new Digit(), '16 50'],
            'with tabs' => [new Digit(), "1\t1"],
            'with newlines' => [new Digit(), "1\n1"],
            'null' => [new Digit(), null],
            'with non-numeric' => [new Digit(), '16-50'],
            'alphabetic' => [new Digit(), 'a'],
            'alphanumeric' => [new Digit(), 'a1'],
            'negative integer' => [new Digit(), -12],
            'negative string-integer' => [new Digit(), '-12'],
            'float-string' => [new Digit(), '1.0'],
            'negative float' => [new Digit(), -1.1],
            'negative string-float' => [new Digit(), '-1.1'],
            'boolean false' => [new Digit(), false],
        ];
    }
}
