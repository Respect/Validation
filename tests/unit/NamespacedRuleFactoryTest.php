<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Augusto Pascutti <augusto.hp@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation;

use DI\Container;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Exceptions\InvalidClassException;
use Respect\Validation\Test\TestCase;
use Respect\Validation\Test\Transformers\StubTransformer;
use Respect\Validation\Test\Validators\Injectable;
use Respect\Validation\Test\Validators\Invalid;
use Respect\Validation\Test\Validators\MyAbstractClass;
use Respect\Validation\Test\Validators\Stub;
use Respect\Validation\Test\Validators\Valid;
use Respect\Validation\Transformers\Transformer;

use function assert;
use function sprintf;

#[Group('core')]
#[CoversClass(NamespacedValidatorFactory::class)]
final class NamespacedRuleFactoryTest extends TestCase
{
    private const string TEST_RULES_NAMESPACE = 'Respect\\Validation\\Test\\Validators';

    #[Test]
    public function shouldCreateRuleByNameBasedOnNamespace(): void
    {
        $factory = new NamespacedValidatorFactory(new StubTransformer(), [self::TEST_RULES_NAMESPACE]);

        self::assertInstanceOf(Valid::class, $factory->create('valid'));
    }

    #[Test]
    public function shouldLookUpToAllNamespacesUntilRuleIsFound(): void
    {
        $factory = (new NamespacedValidatorFactory(new StubTransformer(), [self::TEST_RULES_NAMESPACE]))
            ->withNamespace(__NAMESPACE__);

        self::assertInstanceOf(Valid::class, $factory->create('valid'));
    }

    #[Test]
    public function shouldDefineConstructorArgumentsWhenCreatingRule(): void
    {
        $constructorArguments = [true, false, true, false];

        $factory = new NamespacedValidatorFactory(new StubTransformer(), [self::TEST_RULES_NAMESPACE]);
        $validator = $factory->create('stub', $constructorArguments);
        assert($validator instanceof Stub);

        self::assertSame($constructorArguments, $validator->validations);
    }

    #[Test]
    public function shouldInjectServicesFromContainerIntoUnfilledConstructorParameters(): void
    {
        $transformer = new StubTransformer();
        $resolver = new ContainerArgumentsResolver(new Container([Transformer::class => $transformer]));

        $factory = new NamespacedValidatorFactory(new StubTransformer(), [self::TEST_RULES_NAMESPACE], $resolver);
        $validator = $factory->create('injectable', ['some name']);
        assert($validator instanceof Injectable);

        self::assertSame('some name', $validator->name);
        self::assertSame($transformer, $validator->transformer);
    }

    #[Test]
    public function shouldNotInjectServicesIntoParametersFilledByArguments(): void
    {
        $argumentTransformer = new StubTransformer();
        $resolver = new ContainerArgumentsResolver(new Container([Transformer::class => new StubTransformer()]));

        $factory = new NamespacedValidatorFactory(new StubTransformer(), [self::TEST_RULES_NAMESPACE], $resolver);
        $validator = $factory->create('injectable', ['some name', $argumentTransformer]);
        assert($validator instanceof Injectable);

        self::assertSame($argumentTransformer, $validator->transformer);
    }

    #[Test]
    public function shouldNotInjectServicesWhenCreatedWithoutArgumentsResolver(): void
    {
        $factory = new NamespacedValidatorFactory(new StubTransformer(), [self::TEST_RULES_NAMESPACE]);
        $validator = $factory->create('injectable');
        assert($validator instanceof Injectable);

        self::assertNull($validator->transformer);
    }

    #[Test]
    public function shouldNotInjectServicesTheContainerDoesNotHave(): void
    {
        $factory = new NamespacedValidatorFactory(
            new StubTransformer(),
            [self::TEST_RULES_NAMESPACE],
            new ContainerArgumentsResolver(new Container()),
        );
        $validator = $factory->create('injectable');
        assert($validator instanceof Injectable);

        self::assertNull($validator->transformer);
    }

    #[Test]
    public function shouldThrowsAnExceptionOnConstructorReflectionFailure(): void
    {
        $constructorArguments = ['a', 'b'];

        $factory = new NamespacedValidatorFactory(new StubTransformer(), [self::TEST_RULES_NAMESPACE]);

        $this->expectException(InvalidClassException::class);
        $this->expectExceptionMessage('"noConstructor" could not be instantiated with arguments `["a", "b"]`');

        $factory->create('noConstructor', $constructorArguments);
    }

    #[Test]
    public function shouldThrowsAnExceptionWhenRuleIsInvalid(): void
    {
        $factory = new NamespacedValidatorFactory(new StubTransformer(), [self::TEST_RULES_NAMESPACE]);

        $this->expectException(InvalidClassException::class);
        $this->expectExceptionMessage(sprintf('"%s" must be an instance of "%s"', Invalid::class, Validator::class));

        $factory->create('invalid');
    }

    #[Test]
    public function shouldThrowsAnExceptionWhenRuleIsNotInstantiable(): void
    {
        $factory = new NamespacedValidatorFactory(new StubTransformer(), [self::TEST_RULES_NAMESPACE]);

        $this->expectException(InvalidClassException::class);
        $this->expectExceptionMessage(sprintf('"%s" must be instantiable', MyAbstractClass::class));

        $factory->create('myAbstractClass');
    }

    #[Test]
    public function shouldThrowsAnExceptionWhenRuleIsNotFound(): void
    {
        $factory = new NamespacedValidatorFactory(new StubTransformer(), [self::TEST_RULES_NAMESPACE]);

        $this->expectException(ComponentException::class);
        $this->expectExceptionMessage('"nonExistingRule" is not a valid rule name');

        $factory->create('nonExistingRule');
    }
}
