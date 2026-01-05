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
        $validator = Stub::any(1);

        $reducer = new Reducer($validator);
        $result = $reducer->evaluate(null);

        self::assertSame($validator, $result->validator);
    }

    #[Test]
    public function shouldWrapWhenThereAreMultipleRules(): void
    {
        $validator1 = Stub::any(1);
        $validator2 = Stub::any(1);
        $validator3 = Stub::any(1);

        $reducer = new Reducer($validator1, $validator2, $validator3);
        $result = $reducer->evaluate(null);

        self::assertEquals(new AllOf($validator1, $validator2, $validator3), $result->validator);
    }
}
