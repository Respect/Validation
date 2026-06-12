<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation;

use DateTimeImmutable;
use DI\Container;
use PDO;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use ReflectionFunction;
use ReflectionMethod;
use Respect\Validation\Test\TestCase;
use Respect\Validation\Test\Transformers\StubTransformer;
use Respect\Validation\Test\Validators\Injectable;
use Respect\Validation\Test\Validators\InjectableWithPdo;
use Respect\Validation\Transformers\Transformer;
use Respect\Validation\Validators\AlwaysValid;
use Respect\Validation\Validators\DateTimeDiff;
use Respect\Validation\Validators\Not;

use function Respect\Validation\Test\Functions\namedFunctionWithTransformer;

#[Group('core')]
#[CoversClass(ContainerArgumentsResolver::class)]
final class ContainerArgumentsResolverTest extends TestCase
{
    #[Test]
    public function shouldAugmentArgumentsWithContainerValuesForUnfilledParameters(): void
    {
        $transformer = new StubTransformer();
        $resolver = new ContainerArgumentsResolver(new Container([Transformer::class => $transformer]));

        self::assertSame(
            ['some name', 'transformer' => $transformer],
            $resolver->resolve(self::constructor(Injectable::class), ['some name']),
        );
    }

    #[Test]
    public function shouldReturnArgumentsUnchangedWhenPositionalArgumentsFillAllParameters(): void
    {
        $resolver = new ContainerArgumentsResolver(new Container([Transformer::class => new StubTransformer()]));
        $arguments = ['some name', new StubTransformer()];

        self::assertSame($arguments, $resolver->resolve(self::constructor(Injectable::class), $arguments));
    }

    #[Test]
    public function shouldReturnArgumentsUnchangedWhenNamedArgumentsFillInjectableParameters(): void
    {
        $resolver = new ContainerArgumentsResolver(new Container([Transformer::class => new StubTransformer()]));
        $arguments = ['transformer' => new StubTransformer()];

        self::assertSame($arguments, $resolver->resolve(self::constructor(Injectable::class), $arguments));
    }

    #[Test]
    public function shouldReturnArgumentsUnchangedWhenContainerDoesNotHaveParameterType(): void
    {
        $resolver = new ContainerArgumentsResolver(new Container());

        self::assertSame([], $resolver->resolve(self::constructor(Injectable::class), []));
    }

    #[Test]
    public function shouldNotResolveUnresolvableTypesFromContainer(): void
    {
        $container = new Container();
        $resolver = new ContainerArgumentsResolver($container);
        $arguments = ['years', new AlwaysValid()];

        self::assertSame($arguments, $resolver->resolve(self::constructor(DateTimeDiff::class), $arguments));
        self::assertTrue($container->has(DateTimeImmutable::class));
    }

    #[Test]
    public function shouldNotResolveValidatorFromContainer(): void
    {
        $validator = new AlwaysValid();
        $container = new Container([Validator::class => $validator]);
        $resolver = new ContainerArgumentsResolver($container);

        $result = $resolver->resolve(self::constructor(Not::class), []);

        self::assertSame([], $result);
        self::assertTrue($container->has(Validator::class));
    }

    #[Test]
    public function shouldResolveInternalClassTypesFromContainerWhenNotUnresolvable(): void
    {
        $pdo = new PDO('sqlite::memory:');
        $container = new Container([PDO::class => $pdo]);
        $resolver = new ContainerArgumentsResolver($container);

        $result = $resolver->resolve(self::constructor(InjectableWithPdo::class), ['some name']);

        self::assertSame(['some name', 'pdo' => $pdo], $result);
    }

    #[Test]
    public function shouldUseCustomUnresolvableTypes(): void
    {
        $pdo = new PDO('sqlite::memory:');
        $container = new Container([PDO::class => $pdo]);
        $resolver = new ContainerArgumentsResolver($container, [PDO::class]);

        self::assertSame(
            ['some name'],
            $resolver->resolve(self::constructor(InjectableWithPdo::class), ['some name']),
        );
    }

    #[Test]
    public function shouldAllowOverridingDefaultUnresolvableTypes(): void
    {
        $transformer = new StubTransformer();
        $container = new Container([Transformer::class => $transformer]);
        $resolver = new ContainerArgumentsResolver($container, []);

        $result = $resolver->resolve(self::constructor(Injectable::class), ['some name']);

        self::assertSame(['some name', 'transformer' => $transformer], $result);
    }

    #[Test]
    public function shouldResolveInjectableParameterFromContainerForClosure(): void
    {
        $transformer = new StubTransformer();
        $resolver = new ContainerArgumentsResolver(new Container([Transformer::class => $transformer]));

        $closure = static fn(string $name, Transformer $transformer): bool => true;

        self::assertSame(
            ['some name', 'transformer' => $transformer],
            $resolver->resolve(new ReflectionFunction($closure), ['some name']),
        );
    }

    #[Test]
    public function shouldReturnArgumentsUnchangedForClosureWhenAllParametersAreFilled(): void
    {
        $transformer = new StubTransformer();
        $resolver = new ContainerArgumentsResolver(new Container([Transformer::class => $transformer]));

        $closure = static fn(string $name, Transformer $transformer): bool => true;
        $arguments = ['some name', $transformer];

        self::assertSame($arguments, $resolver->resolve(new ReflectionFunction($closure), $arguments));
    }

    #[Test]
    public function shouldReturnArgumentsUnchangedForClosureWhenContainerDoesNotHaveParameterType(): void
    {
        $resolver = new ContainerArgumentsResolver(new Container());

        $closure = static fn(string $name, Transformer $transformer): bool => true;

        self::assertSame([], $resolver->resolve(new ReflectionFunction($closure), []));
    }

    #[Test]
    public function shouldNotResolveBuiltInTypesForClosure(): void
    {
        $resolver = new ContainerArgumentsResolver(new Container());

        $closure = static fn(string $name, int $count): bool => true;

        self::assertSame([], $resolver->resolve(new ReflectionFunction($closure), []));
    }

    #[Test]
    public function shouldNotResolveUnresolvableTypesForClosure(): void
    {
        $container = new Container();
        $resolver = new ContainerArgumentsResolver($container);

        $closure = static fn(DateTimeImmutable $date): bool => true;

        self::assertSame([], $resolver->resolve(new ReflectionFunction($closure), []));
        self::assertTrue($container->has(DateTimeImmutable::class));
    }

    #[Test]
    public function shouldResolveNamedArgumentsForClosure(): void
    {
        $transformer = new StubTransformer();
        $resolver = new ContainerArgumentsResolver(new Container([Transformer::class => $transformer]));

        $closure = static fn(string $name, Transformer $transformer): bool => true;

        self::assertSame(
            ['transformer' => $transformer],
            $resolver->resolve(new ReflectionFunction($closure), ['transformer' => $transformer]),
        );
    }

    #[Test]
    public function shouldResolveInjectableParameterFromContainerForNamedFunction(): void
    {
        $transformer = new StubTransformer();
        $resolver = new ContainerArgumentsResolver(new Container([Transformer::class => $transformer]));

        $function = new ReflectionFunction(namedFunctionWithTransformer(...));

        self::assertSame(
            ['some name', 'transformer' => $transformer],
            $resolver->resolve($function, ['some name']),
        );
    }

    #[Test]
    public function shouldReturnArgumentsUnchangedForNamedFunctionWhenAllParametersAreFilled(): void
    {
        $transformer = new StubTransformer();
        $resolver = new ContainerArgumentsResolver(new Container([Transformer::class => $transformer]));

        $function = new ReflectionFunction(namedFunctionWithTransformer(...));
        $arguments = ['some name', $transformer];

        self::assertSame($arguments, $resolver->resolve($function, $arguments));
    }

    #[Test]
    public function shouldReturnArgumentsUnchangedForNamedFunctionWhenContainerDoesNotHaveParameterType(): void
    {
        $resolver = new ContainerArgumentsResolver(new Container());

        $function = new ReflectionFunction(namedFunctionWithTransformer(...));

        self::assertSame([], $resolver->resolve($function, []));
    }

    #[Test]
    public function shouldUseCachedInjectableParametersOnSubsequentCalls(): void
    {
        $transformer = new StubTransformer();
        $resolver = new ContainerArgumentsResolver(new Container([Transformer::class => $transformer]));

        $constructor = self::constructor(Injectable::class);

        // First call populates the cache
        $resolver->resolve($constructor, ['some name']);

        // Second call should hit the cache (line 88)
        $result = $resolver->resolve($constructor, ['another name']);

        self::assertSame(['another name', 'transformer' => $transformer], $result);
    }

    #[Test]
    public function shouldSkipParametersWithNonClassOrInterfaceType(): void
    {
        $resolver = new ContainerArgumentsResolver(new Container());

        require_once __DIR__ . '/../src/Functions/functionWithNonExistentType.php';

        $function = new ReflectionFunction('\Respect\Validation\Test\Functions\functionWithNonExistentType');

        self::assertSame([], $resolver->resolve($function, []));
    }

    #[Test]
    public function shouldCreateCacheKeyForNamedFunction(): void
    {
        $transformer = new StubTransformer();
        $resolver = new ContainerArgumentsResolver(new Container([Transformer::class => $transformer]));

        // Use string name to create ReflectionFunction for a named function (not a Closure)
        $function = new ReflectionFunction('Respect\Validation\Test\Functions\namedFunctionWithTransformer');

        $result = $resolver->resolve($function, ['some name']);

        self::assertSame(['some name', 'transformer' => $transformer], $result);
    }

    /** @param class-string $className */
    private static function constructor(string $className): ReflectionMethod
    {
        return new ReflectionMethod($className, '__construct');
    }
}
