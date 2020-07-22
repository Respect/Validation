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

use Respect\Validation\Test\TestCase;

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\AlwaysInvalid
 *
 * @author Andreas Wolf <dev@a-w.io>
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author William Espindola <oi@williamespindola.com.br>
 */
final class AlwaysInvalidTest extends TestCase
{
    /**
     * @return mixed[][]
     */
    public function providerForInvalidInput(): array
    {
        return [
            [0],
            [1],
            ['string'],
            [true],
            [false],
            [null],
            [''],
            [[]],
            [['array_full']],
        ];
    }

    /**
     * @test
     *
     * @dataProvider providerForInvalidInput
     *
     * @param mixed $input
     */
    public function itShouldAlwaysBeInvalid($input): void
    {
        $rule = new AlwaysInvalid();

        self::assertFalse($rule->validate($input));
    }
}
