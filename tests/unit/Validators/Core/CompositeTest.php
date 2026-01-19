<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators\Core;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Test\TestCase;
use Respect\Validation\Test\Validators\Core\ConcreteComposite;
use Respect\Validation\Test\Validators\Stub;

#[Group('core')]
#[CoversClass(Composite::class)]
final class CompositeTest extends TestCase
{
    #[Test]
    public function itShouldReturnItsChildren(): void
    {
        $expected = [Stub::daze(), Stub::daze(), Stub::daze()];
        $sut = new ConcreteComposite(...$expected);
        $actual = $sut->getValidators();

        self::assertCount(3, $actual);
        self::assertEquals($expected, $actual);
    }
}
