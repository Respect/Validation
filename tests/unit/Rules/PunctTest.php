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
 * @covers \Respect\Validation\Rules\Punct
 *
 * @author Andre Ramaciotti <andre@ramaciotti.com>
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Nick Lombard <github@jigsoft.co.za>
 * @author Pascal Borreli <pascal@borreli.com>
 */
final class PunctTest extends RuleTestCase
{
    /**
     * {@inheritdoc}
     */
    public function providerForValidInput(): array
    {
        $punct = new Punct();

        return [
            [$punct, '.'],
            [$punct, ',;:'],
            [$punct, '-@#$*'],
            [$punct, '()[]{}'],
            [new Punct('abc123 '), '!@#$%^&*(){} abc 123'],
            [new Punct("abc123 \t\n"), "[]?+=/\\-_|\"',<>. \t \n abc 123"],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function providerForInvalidInput(): array
    {
        $punct = new Punct();

        return [
            [$punct, ''],
            [$punct, '16-50'],
            [$punct, 'a'],
            [$punct, ' '],
            [$punct, 'Foo'],
            [$punct, '12.1'],
            [$punct, '-12'],
            [$punct, -12],
            [$punct, '( )_{}'],
        ];
    }
}
