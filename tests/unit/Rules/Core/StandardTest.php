<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules\Core;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Test\Rules\Stub;
use Respect\Validation\Test\TestCase;

#[Group('core')]
#[CoversClass(Standard::class)]
final class StandardTest extends TestCase
{
    #[Test]
    public function itShouldAllowUsingTheValidateMethod(): void
    {
        $rule = Stub::pass(1);

        // @phpstan-ignore-next-line
        self::assertTrue($rule->validate('any'));
    }

    #[Test]
    public function itShouldAllowUsingTheAssertMethod(): void
    {
        $rule = Stub::fail(1);

        self::expectException(ValidationException::class);

        // @phpstan-ignore-next-line
        $rule->assert('any');
    }

    #[Test]
    public function itShouldAllowUsingTheCheckMethod(): void
    {
        $rule = Stub::fail(1);

        self::expectException(ValidationException::class);

        // @phpstan-ignore-next-line
        $rule->check('any');
    }
}
