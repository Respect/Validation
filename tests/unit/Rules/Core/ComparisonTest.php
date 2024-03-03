<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules\Core;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Test\Rules\Core\ConcreteComparison;
use Respect\Validation\Test\TestCase;
use stdClass;

#[Group('core')]
#[CoversClass(Comparison::class)]
final class ComparisonTest extends TestCase
{
    #[Test]
    #[DataProvider('providerForAnyValues')]
    public function itShouldCompareAnyValue(mixed $compareTo): void
    {
        $rule = new ConcreteComparison($compareTo);

        self::assertValidInput($rule, $compareTo);
    }

    #[Test]
    #[DataProvider('providerForScalarValues')]
    public function itShouldAlwaysInvalidateScalarWithNonScalarValues(mixed $compareTo): void
    {
        $rule = new ConcreteComparison($compareTo);

        self::assertInvalidInput($rule, new stdClass());
    }
}
