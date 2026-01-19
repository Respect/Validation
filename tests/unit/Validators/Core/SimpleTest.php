<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Fabio Ribeiro <faabiosr@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators\Core;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Test\TestCase;
use Respect\Validation\Test\Validators\Core\ConcreteSimple;
use Respect\Validation\Validator;

#[Group('core')]
#[CoversClass(Simple::class)]
final class SimpleTest extends TestCase
{
    #[Test]
    public function itShouldEvaluateUsingTheValidateMethod(): void
    {
        $validator = new ConcreteSimple();

        self::assertTrue($validator->evaluate('any')->hasPassed);
    }

    #[Test]
    public function itShouldEvaluateReturningTheCurrentRule(): void
    {
        $validator = new ConcreteSimple();

        self::assertSame($validator, $validator->evaluate('any')->validator);
    }

    #[Test]
    public function itShouldEvaluateReturningTheStandardTemplate(): void
    {
        $validator = new ConcreteSimple();

        self::assertSame(Validator::TEMPLATE_STANDARD, $validator->evaluate('any')->template);
    }
}
