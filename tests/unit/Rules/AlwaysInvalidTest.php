<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Test\TestCase;

#[Group('rule')]
#[CoversClass(AlwaysInvalid::class)]
final class AlwaysInvalidTest extends TestCase
{
    #[Test]
    #[DataProvider('providerForInvalidInput')]
    public function itShouldAlwaysBeInvalid(mixed $input): void
    {
        $rule = new AlwaysInvalid();

        self::assertFalse($rule->validate($input));
    }

    /**
     * @return mixed[][]
     */
    public static function providerForInvalidInput(): array
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
