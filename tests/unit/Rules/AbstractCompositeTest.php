<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Test\Exceptions\CompositeStubException;
use Respect\Validation\Test\Rules\Stub;
use Respect\Validation\Test\Stubs\CompositeSub;
use Respect\Validation\Test\TestCase;

use function current;

/**
 * @group rule
 * @covers \Respect\Validation\Rules\AbstractComposite
 */
final class AbstractCompositeTest extends TestCase
{
    /**
     * @test
     */
    public function itShouldUpdateTheNameOfTheChildWhenUpdatingItsName(): void
    {
        $ruleName = 'something';

        $child = new Stub();

        $parent = new CompositeSub($child);

        self::assertNull($child->getName());

        $parent->setName($ruleName);

        self::assertSame($ruleName, $child->getName());
    }

    /**
     * @test
     */
    public function itShouldUpdateTheNameOfTheChildWhenAddingIt(): void
    {
        $ruleName = 'something';

        $rule = new Stub();

        $sut = new CompositeSub();
        $sut->setName($ruleName);

        self::assertNull($rule->getName());

        $sut->addRule($rule);

        self::assertSame($ruleName, $rule->getName());
    }

    /**
     * @test
     */
    public function itShouldNotUpdateTheNameOfTheChildWhenUpdatingItsNameIfTheChildAlreadyHasSomeName(): void
    {
        $ruleName1 = 'something';
        $ruleName2 = 'something else';

        $rule = new Stub();
        $rule->setName($ruleName1);

        $sut = new CompositeSub($rule);
        $sut->setName($ruleName2);

        self::assertSame($ruleName1, $rule->getName());
    }

    /**
     * @test
     */
    public function itNotShouldUpdateTheNameOfTheChildWhenAddingItIfTheChildAlreadyHasSomeName(): void
    {
        $ruleName1 = 'something';
        $ruleName2 = 'something else';

        $rule = new Stub();
        $rule->setName($ruleName1);

        $sut = new CompositeSub();
        $sut->setName($ruleName2);
        $sut->addRule($rule);

        self::assertSame($ruleName1, $rule->getName());
    }

    /**
     * @test
     */
    public function itShouldReturnItsChildren(): void
    {
        $child1 = new Stub();
        $child2 = new Stub();
        $child3 = new Stub();

        $sut = new CompositeSub($child1, $child2, $child3);
        $children = $sut->getRules();

        self::assertCount(3, $children);
        self::assertSame($child1, $children[0]);
        self::assertSame($child2, $children[1]);
        self::assertSame($child3, $children[2]);
    }

    /**
     * @test
     */
    public function itShouldAssertWithAllChildrenAndNotThrowAnExceptionWhenThereAreNoIssues(): void
    {
        $input = 'something';

        $child1 = new Stub(true);
        $child2 = new Stub(true);
        $child3 = new Stub(true);

        $this->expectNotToPerformAssertions();

        $sut = new CompositeSub($child1, $child2, $child3);
        $sut->assert($input);
    }

    /**
     * @test
     */
    public function itShouldAssertWithAllChildrenAndThrowAnExceptionWhenThereAreIssues(): void
    {
        $sut = new CompositeSub(new Stub(false), new Stub(false), new Stub(false));

        try {
            $sut->assert('something');
        } catch (CompositeStubException $exception) {
            self::assertCount(3, $exception->getChildren());
        }
    }

    /**
     * @test
     */
    public function itShouldUpdateTheTemplateOfEveryChildrenWhenAsserting(): void
    {
        $template = 'This is my template';

        $sut = new CompositeSub(
            new Stub(false),
            new Stub(false),
            new Stub(false)
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

    /**
     * @test
     */
    public function itShouldUpdateTheTemplateOfEveryTheChildrenOfSomeChildWhenAsserting(): void
    {
        $template = 'This is my template';

        $sut = new CompositeSub(
            new Stub(false),
            new Stub(false),
            new CompositeSub(new Stub(false))
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
