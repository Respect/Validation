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
use Respect\Validation\Test\Rules\Core\ConcreteStandard;
use Respect\Validation\Test\TestCase;

#[Group('core')]
#[CoversClass(Standard::class)]
final class StandardTest extends TestCase
{
    #[Test]
    public function itShouldNotHaveAnyNameByDefault(): void
    {
        $rule = new ConcreteStandard();

        self::assertNull($rule->getName());
    }

    #[Test]
    public function itShouldBeAbleToSetName(): void
    {
        $rule = new ConcreteStandard();
        $rule->setName('foo');

        self::assertEquals('foo', $rule->getName());
    }
}
