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
 * @covers \Respect\Validation\Rules\AlwaysValid
 */
final class AlwaysValidTest extends TestCase
{
    /**
     * @test
     * @dataProvider providerForValidInput
     */
    public function itAlwaysBeValid(mixed $input): void
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
