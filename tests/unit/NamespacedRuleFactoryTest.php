<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Exceptions\InvalidClassException;
use Respect\Validation\Test\TestCase;
use Respect\Validation\Test\Transformers\StubTransformer;
use Respect\Validation\Test\Validators\Invalid;
use Respect\Validation\Test\Validators\MyAbstractClass;
use Respect\Validation\Test\Validators\Stub;
use Respect\Validation\Test\Validators\Valid;

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
