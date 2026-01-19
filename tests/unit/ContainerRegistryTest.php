<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DoesNotPerformAssertions;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Test\TestCase;

#[Group('core')]
#[CoversClass(ContainerRegistry::class)]
final class ContainerRegistryTest extends TestCase
{
    #[Test]
    #[DoesNotPerformAssertions]
    public function itTheCreatedContainerShouldBeAbleToProvideAnInstanceOfValidator(): void
    {
        $container = ContainerRegistry::createContainer();
        $container->get(ValidatorBuilder::class);
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
}
