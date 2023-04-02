<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Test\TestCase;

/**
 * @group  rule
 *
 * @covers \Respect\Validation\Rules\AlwaysValid
 *
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Paulo Eduardo <pauloelr@gmail.com>
 * @author William Espindola <oi@williamespindola.com.br>
 */
final class AlwaysValidTest extends TestCase
{
    /**
     * @test
     *
     * @dataProvider providerForValidInput
     *
     * @param mixed $input
     */
    public function itAlwaysBeValid($input): void
    {
        $rule = new AlwaysValid();

        self::assertTrue($rule->validate($input));
    }

    /**
     * @return mixed[][]
     */
    public static function providerForValidInput(): array
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
}
