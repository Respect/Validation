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
use Respect\Validation\Rule;
use Respect\Validation\Test\Rules\Core\ConcreteSimple;
use Respect\Validation\Test\TestCase;

#[Group('core')]
#[CoversClass(Simple::class)]
final class SimpleTest extends TestCase
{
    #[Test]
    public function itShouldEvaluateUsingTheValidateMethod(): void
    {
        $rule = new ConcreteSimple();

        self::assertTrue($rule->evaluate('any')->hasPassed);
    }

    #[Test]
    public function itShouldEvaluateReturningTheCurrentRule(): void
    {
        $rule = new ConcreteSimple();

        self::assertSame($rule, $rule->evaluate('any')->rule);
    }

    #[Test]
    public function itShouldEvaluateReturningTheStandardTemplate(): void
    {
        $rule = new ConcreteSimple();

        self::assertSame(Rule::TEMPLATE_STANDARD, $rule->evaluate('any')->template);
    }
}
