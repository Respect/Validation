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

    #[Test]
    public function itShouldUpdateTheNameOfTheChildWhenUpdatingItsName(): void
    {
        $ruleName = 'something';

        $rule1 = Stub::daze();
        $rule2 = Stub::daze();

        $composite = new ConcreteComposite($rule1, $rule2);

        self::assertNull($rule1->getName());
        self::assertNull($rule2->getName());

        $composite->setName($ruleName);

        self::assertEquals($ruleName, $rule1->getName());
        self::assertEquals($ruleName, $rule2->getName());
        self::assertEquals($ruleName, $composite->getName());
    }

    #[Test]
    public function itShouldNotUpdateTheNameOfTheChildWhenUpdatingItsNameIfTheChildAlreadyHasSomeName(): void
    {
        $ruleName1 = 'something';
        $ruleName2 = 'something else';

        $rule1 = Stub::daze();
        $rule1->setName($ruleName1);

        $rule2 = Stub::daze();
        $rule2->setName($ruleName1);

        $composite = new ConcreteComposite($rule1, $rule2);
        $composite->setName($ruleName2);

        self::assertEquals($ruleName1, $rule1->getName());
        self::assertEquals($ruleName1, $rule2->getName());
        self::assertEquals($ruleName2, $composite->getName());
    }
}
