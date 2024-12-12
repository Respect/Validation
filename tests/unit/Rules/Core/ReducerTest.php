<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules\Core;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Respect\Validation\Rules\AllOf;
use Respect\Validation\Test\Rules\Stub;

#[CoversClass(Reducer::class)]
final class ReducerTest extends TestCase
{
    #[Test]
    public function shouldWrapTheSingleRule(): void
    {
        $rule = Stub::any(1);

        $reducer = new Reducer($rule);
        $result = $reducer->evaluate(null);

        self::assertSame($rule, $result->rule);
    }

    #[Test]
    public function shouldWrapWhenThereAreMultipleRules(): void
    {
        $rule1 = Stub::any(1);
        $rule2 = Stub::any(1);
        $rule3 = Stub::any(1);

        $reducer = new Reducer($rule1, $rule2, $rule3);
        $result = $reducer->evaluate(null);

        self::assertEquals(new AllOf($rule1, $rule2, $rule3), $result->rule);
    }
}
