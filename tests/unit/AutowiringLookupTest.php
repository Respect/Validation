<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Respect\Config\Container;
use Respect\Fluent\Exceptions\CouldNotCreate;
use Respect\Fluent\Exceptions\CouldNotResolve;
use Respect\Fluent\Factories\NamespaceLookup;
use Respect\Fluent\Resolvers\ComposableMap;
use Respect\Fluent\Resolvers\Ucfirst;
use Respect\Parameter\ContainerResolver;
use Respect\Validation\Mixins\PrefixConstants;
use Respect\Validation\Test\TestCase;
use Respect\Validation\Test\Validators\Stub;
use Respect\Validation\Test\Validators\Valid;
use Respect\Validation\Test\Validators\WithDependency;
use stdClass;

use function assert;

#[Group('core')]
#[CoversClass(AutowiringLookup::class)]
final class AutowiringLookupTest extends TestCase
{
    private const string TEST_RULES_NAMESPACE = 'Respect\\Validation\\Test\\Validators';

    #[Test]
    public function itShouldCreateRuleByNameFromNamespace(): void
    {
        self::assertInstanceOf(Valid::class, $this->createLookup()->create('valid'));
    }

    #[Test]
    public function itShouldPrependNamespaceWithWithNamespace(): void
    {
        $lookup = $this->createLookup()->withNamespace(__NAMESPACE__);

        self::assertInstanceOf(Valid::class, $lookup->create('valid'));
    }

    #[Test]
    public function itShouldPassAllArgumentsToVariadicConstructors(): void
    {
        $arguments = [true, false, true, false];

        $rule = $this->createLookup()->create('stub', $arguments);
        assert($rule instanceof Stub);

        self::assertSame($arguments, $rule->validations);
    }

    #[Test]
    public function itShouldAutowireConstructorDependenciesFromTheContainer(): void
    {
        $dependency = new stdClass();

        $rule = $this->createLookup([stdClass::class => $dependency])->create('withDependency');
        assert($rule instanceof WithDependency);

        self::assertSame($dependency, $rule->dependency);
    }

    #[Test]
    public function itShouldThrowWhenRuleNameCannotBeResolved(): void
    {
        $this->expectException(CouldNotResolve::class);

        $this->createLookup()->create('nonExistingRule');
    }

    #[Test]
    public function itShouldThrowWhenInstantiationFails(): void
    {
        $this->expectException(CouldNotCreate::class);

        $this->createLookup()->create('noConstructor', ['a', 'b']);
    }

    /** @param array<string, mixed> $definitions */
    private function createLookup(array $definitions = []): AutowiringLookup
    {
        return new AutowiringLookup(
            new NamespaceLookup(new Ucfirst(), Validator::class, self::TEST_RULES_NAMESPACE),
            new ComposableMap(PrefixConstants::COMPOSABLE, PrefixConstants::COMPOSABLE_WITH_ARGUMENT),
            new ContainerResolver(new Container($definitions)),
        );
    }
}
