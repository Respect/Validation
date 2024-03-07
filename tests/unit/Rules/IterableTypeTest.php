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
#[CoversClass(IterableType::class)]
final class IterableTypeTest extends TestCase
{
    /** @param iterable<mixed> $input */
    #[Test]
    #[DataProvider('providerForIterableTypes')]
    public function itShouldValidateIterableTypes(iterable $input): void
    {
        $rule = new IterableType();

        self::assertValidInput($rule, $input);
    }

    #[Test]
    #[DataProvider('providerForNonIterableTypes')]
    public function itShouldInvalidateNonIterableTypes(mixed $input): void
    {
        $rule = new IterableType();

        self::assertInvalidInput($rule, $input);
    }
}
