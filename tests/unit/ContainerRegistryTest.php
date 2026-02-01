<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Test\TestCase;

#[Group('core')]
#[CoversClass(ContainerRegistry::class)]
final class ContainerRegistryTest extends TestCase
{
    #[Test]
    public function itShouldBeAbleToProvideAnInstanceOfValidator(): void
    {
        $container = ContainerRegistry::createContainer();

        self::assertNotNull($container->get(ValidatorBuilder::class));
    }

    #[Test]
    public function itShouldBeAbleToGiveDefinitionsToTheContainer(): void
    {
        $container = ContainerRegistry::createContainer(['foo' => 'bar']);

        self::assertSame('bar', $container->get('foo'));
    }

    #[Test]
    public function itAlwaysReturnsTheSameInstanceOfTheContainer(): void
    {
        self::assertSame(ContainerRegistry::getContainer(), ContainerRegistry::getContainer());
    }

    #[Test]
    public function itAllowsOverwritingTheContainer(): void
    {
        $newContainer = ContainerRegistry::createContainer();
        ContainerRegistry::setContainer($newContainer);

        self::assertSame($newContainer, ContainerRegistry::getContainer());
    }

    #[Test]
    public function itResetsTheContainerToTheDefaultState(): void
    {
        $newContainer = ContainerRegistry::createContainer(['foo' => 'bar']);
        ContainerRegistry::setContainer($newContainer);
        ContainerRegistry::resetContainer();
        $defaultContainer = ContainerRegistry::getContainer();
        self::assertNotSame($newContainer, $defaultContainer);
        self::assertFalse($defaultContainer->has('foo'));
    }
}
