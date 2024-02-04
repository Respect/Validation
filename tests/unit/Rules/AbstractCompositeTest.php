<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Test\Exceptions\CompositeStubException;
use Respect\Validation\Test\Rules\Stub;
use Respect\Validation\Test\Stubs\CompositeSub;
use Respect\Validation\Test\TestCase;

use function current;

#[Group('rule')]
#[CoversClass(AbstractComposite::class)]
final class AbstractCompositeTest extends TestCase
{
    #[Test]
    public function itShouldUpdateTheNameOfTheChildWhenUpdatingItsName(): void
    {
        $ruleName = 'something';

        $child = Stub::pass(1);

        $parent = new CompositeSub($child);

        self::assertNull($child->getName());

        $parent->setName($ruleName);

        self::assertSame($ruleName, $child->getName());
    }

    #[Test]
    public function itShouldUpdateTheNameOfTheChildWhenAddingIt(): void
    {
        $ruleName = 'something';

        $rule = Stub::pass(1);

        $sut = new CompositeSub();
        $sut->setName($ruleName);

        self::assertNull($rule->getName());

        $sut->addRule($rule);

        self::assertSame($ruleName, $rule->getName());
    }

    #[Test]
    public function itShouldNotUpdateTheNameOfTheChildWhenUpdatingItsNameIfTheChildAlreadyHasSomeName(): void
    {
        $ruleName1 = 'something';
        $ruleName2 = 'something else';

        $rule = Stub::pass(1);
        $rule->setName($ruleName1);

        $sut = new CompositeSub($rule);
        $sut->setName($ruleName2);

        self::assertSame($ruleName1, $rule->getName());
    }

    #[Test]
    public function itNotShouldUpdateTheNameOfTheChildWhenAddingItIfTheChildAlreadyHasSomeName(): void
    {
        $ruleName1 = 'something';
        $ruleName2 = 'something else';

        $rule = Stub::pass(1);
        $rule->setName($ruleName1);

        $sut = new CompositeSub();
        $sut->setName($ruleName2);
        $sut->addRule($rule);

        self::assertSame($ruleName1, $rule->getName());
    }

    #[Test]
    public function itShouldReturnItsChildren(): void
    {
        $child1 = Stub::pass(1);
        $child2 = Stub::pass(1);
        $child3 = Stub::pass(1);

        $sut = new CompositeSub($child1, $child2, $child3);
        $children = $sut->getRules();

        self::assertCount(3, $children);
        self::assertSame($child1, $children[0]);
        self::assertSame($child2, $children[1]);
        self::assertSame($child3, $children[2]);
    }

    #[Test]
    public function itShouldAssertWithAllChildrenAndNotThrowAnExceptionWhenThereAreNoIssues(): void
    {
        $input = 'something';

        $child1 = Stub::pass(1);
        $child2 = Stub::pass(1);
        $child3 = Stub::pass(1);

        $this->expectNotToPerformAssertions();

        $sut = new CompositeSub($child1, $child2, $child3);
        $sut->assert($input);
    }

    #[Test]
    public function itShouldAssertWithAllChildrenAndThrowAnExceptionWhenThereAreIssues(): void
    {
        $sut = new CompositeSub(Stub::fail(1), Stub::fail(1), Stub::fail(1));

        try {
            $sut->assert('something');
        } catch (CompositeStubException $exception) {
            self::assertCount(3, $exception->getChildren());
        }
    }

    #[Test]
    public function itShouldUpdateTheTemplateOfEveryChildrenWhenAsserting(): void
    {
        $template = 'This is my template';

        $sut = new CompositeSub(
            Stub::fail(1),
            Stub::fail(1),
            Stub::fail(1)
        );
        $sut->setTemplate($template);

        try {
            $sut->assert('something');
        } catch (CompositeStubException $exception) {
            foreach ($exception->getChildren() as $child) {
                self::assertEquals($template, $child->getMessage());
            }
        }
    }

    #[Test]
    public function itShouldUpdateTheTemplateOfEveryTheChildrenOfSomeChildWhenAsserting(): void
    {
        $template = 'This is my template';

        $sut = new CompositeSub(
            Stub::fail(1),
            Stub::fail(1),
            new CompositeSub(Stub::fail(1))
        );
        $sut->setTemplate($template);

        try {
            $sut->assert('something');
        } catch (CompositeStubException $exception) {
            foreach ($exception->getChildren() as $child) {
                self::assertEquals($template, $child->getMessage());
                if (!$child instanceof CompositeStubException) {
                    continue;
                }

                self::assertNotFalse(current($child->getChildren()));
                self::assertEquals($template, current($child->getChildren())->getMessage());
            }
        }
    }
}
