<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
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
    public function extraNamespacesResolveCustomValidators(): void
    {
        $mainContainer = ContainerRegistry::getContainer();
        ContainerRegistry::setContainer(ContainerRegistry::createContainer([
            'respect.validation.rule_factory.namespaces' => ['Respect\\Validation\\Test\\Validators'],
        ]));

        try {
            // 'CustomRule' exists in Test\Validators but not in Validators
            $builder = ValidatorBuilder::customRule(); // @phpstan-ignore staticMethod.notFound
            self::assertCount(1, $builder->getValidators());
        } finally {
            ContainerRegistry::setContainer($mainContainer);
        }
    }
}
