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
use Respect\Validation\Test\Rules\Core\ConcreteComposite;
use Respect\Validation\Test\Rules\Stub;
use Respect\Validation\Test\TestCase;

#[Group('core')]
#[CoversClass(Composite::class)]
final class CompositeTest extends TestCase
{
    #[Test]
    public function itShouldReturnItsChildren(): void
    {
        $expected = [Stub::daze(), Stub::daze(), Stub::daze()];
        $sut = new ConcreteComposite(...$expected);
        $actual = $sut->getRules();

        self::assertCount(3, $actual);
        self::assertEquals($expected, $actual);
    }
}
