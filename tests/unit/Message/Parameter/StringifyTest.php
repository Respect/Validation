<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Message\Parameter;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Test\TestCase;

use function Respect\Stringifier\stringify;

#[CoversClass(Stringify::class)]
final class StringifyTest extends TestCase
{
    public const DEFAULT_NAME = 'not_name';

    #[Test]
    #[DataProvider('providerForStringValues')]
    public function itShouldNotStringifyValueWhenNameIsNameAndValueIsString(string $value): void
    {
        $stringify = new Stringify();

        self::assertEquals($value, $stringify->process('name', $value));
    }

    #[Test]
    #[DataProvider('providerForAnyValues')]
    public function itShouldReturnStringifiedValue(mixed $value): void
    {
        $stringify = new Stringify();

        self::assertEquals(stringify($value), $stringify->process(self::DEFAULT_NAME, $value, 'trans'));
    }
}
