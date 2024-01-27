<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
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
    public static function providerForValidInput(): array
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
    public static function providerForInvalidInput(): array
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
