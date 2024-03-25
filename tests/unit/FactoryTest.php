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
use Respect\Validation\Test\Rules\AbstractClass;
use Respect\Validation\Test\Rules\Invalid;
use Respect\Validation\Test\Rules\Stub;
use Respect\Validation\Test\Rules\Valid;
use Respect\Validation\Test\TestCase;

use function sprintf;

#[Group('core')]
#[CoversClass(Factory::class)]
final class FactoryTest extends TestCase
{
    private const TEST_RULES_NAMESPACE = 'Respect\\Validation\\Test\\Rules';

    #[Test]
    public function shouldCreateRuleByNameBasedOnNamespace(): void
    {
        $factory = (new Factory())
            ->withRuleNamespace(self::TEST_RULES_NAMESPACE);

        self::assertInstanceOf(Valid::class, $factory->rule('valid'));
    }

    #[Test]
    public function shouldLookUpToAllNamespacesUntilRuleIsFound(): void
    {
        $factory = (new Factory())
            ->withRuleNamespace(__NAMESPACE__)
            ->withRuleNamespace(self::TEST_RULES_NAMESPACE);

        self::assertInstanceOf(Valid::class, $factory->rule('valid'));
    }

    #[Test]
    public function shouldDefineConstructorArgumentsWhenCreatingRule(): void
    {
        $constructorArguments = [true, false, true, false];

        $factory = (new Factory())->withRuleNamespace(self::TEST_RULES_NAMESPACE);
        /** @var Stub $rule */
        $rule = $factory->rule('stub', $constructorArguments);

        self::assertSame($constructorArguments, $rule->validations);
    }

    #[Test]
    public function shouldThrowsAnExceptionWhenRuleIsInvalid(): void
    {
        $factory = (new Factory())->withRuleNamespace(self::TEST_RULES_NAMESPACE);

        $this->expectException(InvalidClassException::class);
        $this->expectExceptionMessage(sprintf('"%s" must be an instance of "%s"', Invalid::class, Validatable::class));

        $factory->rule('invalid');
    }

    #[Test]
    public function shouldThrowsAnExceptionWhenRuleIsNotInstantiable(): void
    {
        $factory = (new Factory())->withRuleNamespace(self::TEST_RULES_NAMESPACE);

        $this->expectException(InvalidClassException::class);
        $this->expectExceptionMessage(sprintf('"%s" must be instantiable', AbstractClass::class));

        $factory->rule('abstractClass');
    }

    #[Test]
    public function shouldThrowsAnExceptionWhenRuleIsNotFound(): void
    {
        $factory = (new Factory())->withRuleNamespace(self::TEST_RULES_NAMESPACE);

        $this->expectException(ComponentException::class);
        $this->expectExceptionMessage('"nonExistingRule" is not a valid rule name');

        $factory->rule('nonExistingRule');
    }

    #[Test]
    public function shouldAlwaysReturnTheSameDefaultInstance(): void
    {
        self::assertSame(Factory::getDefaultInstance(), Factory::getDefaultInstance());
    }

    #[Test]
    public function shouldBeAbleToOverwriteDefaultInstance(): void
    {
        $factory = new Factory();

        $defaultInstance = Factory::getDefaultInstance();

        Factory::setDefaultInstance($factory);

        self::assertSame($factory, Factory::getDefaultInstance());

        Factory::setDefaultInstance($defaultInstance);
    }
}
