<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Validators\Core;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Test\TestCase;
use Respect\Validation\Test\Validators\Core\ConcreteComparison;
use stdClass;

#[Group('core')]
#[CoversClass(Comparison::class)]
final class ComparisonTest extends TestCase
{
    #[Test]
    #[DataProvider('providerForAnyValues')]
    public function itShouldCompareAnyValue(mixed $compareTo): void
    {
        $validator = new ConcreteComparison($compareTo);

        self::assertValidInput($validator, $compareTo);
    }

    #[Test]
    #[DataProvider('providerForScalarValues')]
    public function itShouldAlwaysInvalidateScalarWithNonScalarValues(mixed $compareTo): void
    {
        $validator = new ConcreteComparison($compareTo);

        self::assertInvalidInput($validator, new stdClass());
    }
}
