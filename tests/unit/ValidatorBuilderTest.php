<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 */

declare(strict_types=1);

namespace Respect\Validation;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Test\TestCase;
use Respect\Validation\Test\Validators\Stub;
use Respect\Validation\Validators\AllOf;

#[Group('validator')]
#[CoversClass(ValidatorBuilder::class)]
final class ValidatorBuilderTest extends TestCase
{
    #[Test]
    public function shouldDelegateToIsValidWhenSingleValidatorInBuilder(): void
    {
        $builder = ValidatorBuilder::init(new AllOf(Stub::pass(1), Stub::pass(1)));

        self::assertTrue($builder->isValid([]));
    }

    #[Test]
    public function shouldCallIsValidOnCombinedIsValidWhenMultipleValidatorsExist(): void
    {
        $builder = ValidatorBuilder::init(
            Stub::pass(1),
            Stub::pass(1),
            Stub::pass(1),
            Stub::fail(1),
        );

        self::assertFalse($builder->isValid([]));
    }

    #[Test]
    public function shouldThrowComponentExceptionWhenNoValidatorsExist(): void
    {
        $this->expectException(ComponentException::class);

        ValidatorBuilder::init()->isValid([]);
    }
}
