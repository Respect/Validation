<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation;

use Error;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Respect\Fluent\Factories\NamespaceLookup;
use Respect\Fluent\Resolvers\Ucfirst;
use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Exceptions\InvalidClassException;
use Respect\Validation\Test\TestCase;
use Respect\Validation\Test\Validators\Stub;
use Respect\Validation\Test\Validators\Valid;

#[Group('core')]
#[CoversClass(FluentValidatorFactory::class)]
final class FluentValidatorFactoryTest extends TestCase
{
    private const string TEST_NAMESPACE = 'Respect\\Validation\\Test\\Validators';

    #[Test]
    public function itShouldCreateValidatorByName(): void
    {
        $factory = new FluentValidatorFactory(
            new NamespaceLookup(new Ucfirst(), Validator::class, self::TEST_NAMESPACE),
        );

        self::assertInstanceOf(Valid::class, $factory->create('valid'));
    }

    #[Test]
    public function itShouldPassArgumentsToConstructor(): void
    {
        $factory = new FluentValidatorFactory(
            new NamespaceLookup(new Ucfirst(), Validator::class, self::TEST_NAMESPACE),
        );

        $validator = $factory->create('stub', [true, false, true]);

        self::assertInstanceOf(Stub::class, $validator);
        self::assertSame([true, false, true], $validator->validations);
    }

    #[Test]
    public function itShouldThrowComponentExceptionWhenRuleIsNotFound(): void
    {
        $factory = new FluentValidatorFactory(
            new NamespaceLookup(new Ucfirst(), Validator::class, self::TEST_NAMESPACE),
        );

        $this->expectException(ComponentException::class);
        $this->expectExceptionMessage('"nonExistingRule" is not a valid rule name');

        $factory->create('nonExistingRule');
    }

    #[Test]
    public function itShouldThrowInvalidClassExceptionWhenNonValidatorIsResolved(): void
    {
        $factory = new FluentValidatorFactory(
            new NamespaceLookup(new Ucfirst(), null, self::TEST_NAMESPACE),
        );

        $this->expectException(InvalidClassException::class);
        $this->expectExceptionMessage('must be an instance of');

        $factory->create('invalid');
    }

    #[Test]
    public function itShouldBubbleUpErrorWhenInstantiationFails(): void
    {
        $factory = new FluentValidatorFactory(
            new NamespaceLookup(new Ucfirst(), null, self::TEST_NAMESPACE),
        );

        $this->expectException(Error::class);

        $factory->create('myAbstractClass');
    }

    #[Test]
    public function itShouldThrowInvalidClassExceptionWhenInstantiationFails(): void
    {
        $factory = new FluentValidatorFactory(
            new NamespaceLookup(new Ucfirst(), null, self::TEST_NAMESPACE),
        );

        $this->expectException(InvalidClassException::class);

        $factory->create('nonPublic');
    }

    #[Test]
    public function itShouldPrependNamespaceViaWithNamespace(): void
    {
        $factory = new FluentValidatorFactory(
            new NamespaceLookup(new Ucfirst(), Validator::class, 'NonExistent\\Namespace'),
        );

        $extended = $factory->withNamespace(self::TEST_NAMESPACE);

        self::assertInstanceOf(Valid::class, $extended->create('valid'));
    }

    #[Test]
    public function itShouldReturnNewInstanceFromWithNamespace(): void
    {
        $factory = new FluentValidatorFactory(
            new NamespaceLookup(new Ucfirst(), Validator::class, self::TEST_NAMESPACE),
        );

        $extended = $factory->withNamespace('Another\\Namespace');

        self::assertNotSame($factory, $extended);
    }
}
