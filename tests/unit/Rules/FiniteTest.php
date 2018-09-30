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
use function acos;

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
        $sut = new Finite();

        return [
            'integer-string' => [$sut, '123456'],
            'float-string' => [$sut, '123.456'],
            'zero' => [$sut, 0],
            'negative integer' => [$sut, PHP_INT_MAX * -1],
            'positive integer' => [$sut, PHP_INT_MAX],
            'positive float' => [$sut, 1.3e100],
            'negative float' => [$sut, 1.3e100 * -1],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function providerForInvalidInput(): array
    {
        $sut = new Finite();

        return [
            'empty' => [$sut, ''],
            'not a number' => [$sut, acos(1.01)],
            'infinite' => [$sut, INF],
            'negative infinite' => [$sut, INF * -1],
            'array' => [$sut, []],
            'object' => [$sut, new stdClass()],
            'null' => [$sut, null],
            'boolean false' => [$sut, false],
            'boolean true' => [$sut, true],
        ];
    }
}
