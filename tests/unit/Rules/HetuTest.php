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

#[Group('validator')]
#[CoversClass(Hetu::class)]
final class HetuTest extends TestCase
{
    #[Test]
    #[DataProvider('providerForNonStringTypes')]
    public function itShouldAlwaysInvalidateWhenValueIsNotString(mixed $input): void
    {
        self::assertInvalidInput(new Hetu(), $input);
    }

    #[Test]
    #[DataProvider('providerForInvalidHetu')]
    public function itShouldInvalidateInvalidHetu(string $input): void
    {
        self::assertInvalidInput(new Hetu(), $input);
    }

    #[Test]
    #[DataProvider('providerForValidHetu')]
    public function itShouldValidateValidHetu(string $input): void
    {
        self::assertValidInput(new Hetu(), $input);
    }

    /** @return array<array{string}> */
    public static function providerForValidHetu(): array
    {
        return [
            ['010106A9012'],
            ['290199-907A'],
            ['010199+9012'],
            ['280291+913L'],
            ['280291+923X'],
        ];
    }

    /** @return array<array{string}> */
    public static function providerForInvalidHetu(): array
    {
        return [
            ['010106a9012'],
            ['010106_9012'],
            ['010106G9012'],
            ['010106Z9012'],
            ['010106A901G'],
            ['010106A901I'],
            ['010106A901O'],
            ['010106A901Q'],
            ['010106A901Z'],
            ['010106!9012'],
            ['010106'],
            ['01X199+9012'],
            ['01X199Z9012'],
            ['01X199T9012'],
            ['999999A9999'],
            ['999999A999F'],
            ['300201A1236'],
            ['290201A123J'],
        ];
    }
}
