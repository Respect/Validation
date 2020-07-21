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

use const PHP_INT_MAX;

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\IntVal
 *
 * @author Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 * @author Danilo Benevides <danilobenevides01@gmail.com>
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class IntValTest extends RuleTestCase
{
    /**
     * {@inheritDoc}
     */
    public function providerForValidInput(): array
    {
        $rule = new IntVal();

        return [
            [$rule, 16],
            [$rule, '165'],
            [$rule, 123456],
            [$rule, PHP_INT_MAX],
            [$rule, '06'],
            [$rule, '09'],
            [$rule, '0'],
            [$rule, '00'],
            [$rule, 0b101010],
            [$rule, 0x2a],
            [$rule, '089'],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function providerForInvalidInput(): array
    {
        $rule = new IntVal();

        return [
            [$rule, ''],
            [$rule, new stdClass()],
            [$rule, []],
            [$rule, null],
            [$rule, 'a'],
            [$rule, '1.0'],
            [$rule, 1.0],
            [$rule, ' '],
            [$rule, true],
            [$rule, false],
            [$rule, 'Foo'],
            [$rule, '1.44'],
            [$rule, 1e-5],
            [$rule, '089ab'],
        ];
    }
}
