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
 * @covers \Respect\Validation\Rules\Space
 *
 * @author Andre Ramaciotti <andre@ramaciotti.com>
 * @author Danilo Correa <danilosilva87@gmail.com>
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Nick Lombard <github@jigsoft.co.za>
 */
final class SpaceTest extends RuleTestCase
{
    /**
     * {@inheritdoc}
     */
    public function providerForValidInput(): array
    {
        $space = new Space();

        return [
            'new line' => [$space, "\n"],
            '1 space' => [$space, ' '],
            '4 spaces' => [$space, '    '],
            'tab' => [$space, "\t"],
            '2 spaces' => [$space, '  '],
            'characters "!@#$%^&*(){} "' => [new Space('!@#$%^&*(){}'), '!@#$%^&*(){} '],
            'characters "[]?+=/\\-_|\"\',<>. \t \n "' => [new Space('[]?+=/\\-_|"\',<>.'), "[]?+=/\\-_|\"',<>. \t \n "],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function providerForInvalidInput(): array
    {
        $space = new Space();

        return [
            'string empty' => [$space, ''],
            'string 16-56' => [$space, '16-50'],
            'string a' => [$space, 'a'],
            'string Foo' => [$space, 'Foo'],
            'string negative float' => [$space, '12.1'],
            'string negative number' => [$space, '-12'],
            'negative number ' => [$space, -12],
            'underline' => [$space, '_'],
        ];
    }
}
