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
 * @covers \Respect\Validation\Rules\Xdigit
 *
 * @author Andre Ramaciotti <andre@ramaciotti.com>
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Nick Lombard <github@jigsoft.co.za>
 * @author Pascal Borreli <pascal@borreli.com>
 */
final class XdigitTest extends RuleTestCase
{
    /**
     * {@inheritDoc}
     */
    public function providerForValidInput(): array
    {
        return [
            [new Xdigit(), 'FFF'],
            [new Xdigit(), '15'],
            [new Xdigit(), 'DE12FA'],
            [new Xdigit(), '1234567890abcdef'],
            [new Xdigit(), 443],
            [new Xdigit(), 0x123],
            [new Xdigit('!@#$%^&*(){} '), '!@#$%^&*(){} abc 123'],
            [new Xdigit("[]?+=/\\-_|\"',<>. \t\n"), "[]?+=/\\-_|\"',<>. \t \n abc 123"],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function providerForInvalidInput(): array
    {
        return [
            [new Xdigit(), ''],
            [new Xdigit(), null],
            [new Xdigit(), 'j'],
            [new Xdigit(), ' '],
            [new Xdigit(), 'Foo'],
            [new Xdigit(), '1.5'],
        ];
    }
}
