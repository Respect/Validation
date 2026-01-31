<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Respect\Validation\Test\Validators\Stub;

#[CoversClass(Composite::class)]
final class CompositeTest extends TestCase
{
    #[Test]
    public function shouldWrapAlwaysValidWhenNoValidatorsAreProvided(): void
    {
        $composite = new Composite();
        $result = $composite->evaluate(null);

        self::assertEquals(new AlwaysValid(), $result->validator);
    }

    #[Test]
    public function shouldWrapTheSingleValidator(): void
    {
        $validator = Stub::any(1);

        $composite = new Composite($validator);
        $result = $composite->evaluate(null);

        self::assertSame($validator, $result->validator);
    }

    #[Test]
    public function shouldWrapWhenThereAreMultipleValidators(): void
    {
        $validator1 = Stub::any(1);
        $validator2 = Stub::any(1);
        $validator3 = Stub::any(1);

        $composite = new Composite($validator1, $validator2, $validator3);
        $result = $composite->evaluate(null);

        self::assertEquals(new AllOf($validator1, $validator2, $validator3), $result->validator);
    }
}
