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
use stdClass;
use const INF;
use const PHP_INT_MAX;

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\Finite
 *
 * @author Danilo Correa <danilosilva87@gmail.com>
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class FiniteTest extends RuleTestCase
{
    /**
     * {@inheritdoc}
     */
    public function providerForValidInput(): array
    {
        $rule = new Finite();

        return [
            '123456' => [$rule, '123456'],
            '-9' => [$rule, -9],
            '0' => [$rule, 0],
            '16' => [$rule, 16],
            '2' => [$rule, 2],
            'PHP_INT_MAX' => [$rule, PHP_INT_MAX],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function providerForInvalidInput(): array
    {
        $rule = new Finite();

        return [
            ' ' => [$rule, ' '],
            'INF' => [$rule, INF],
            '[]' => [$rule, []],
            'stdClass' => [$rule, new stdClass()],
            'null' => [$rule, null],
        ];
    }
}
