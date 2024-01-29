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
use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Test\Exceptions\StubException;
use Respect\Validation\Test\Rules\AbstractClass;
use Respect\Validation\Test\Rules\CustomRule;
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
    private const TEST_EXCEPTIONS_NAMESPACE = 'Respect\\Validation\\Test\\Exceptions';

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
        $this->expectExceptionMessage('"notFoundRule" is not a valid rule name');

        $factory->rule('notFoundRule');
    }

    #[Test]
    public function shouldCreateExceptionBasedOnRule(): void
    {
        $factory = (new Factory())->withExceptionNamespace(self::TEST_EXCEPTIONS_NAMESPACE);

        $rule = new Stub();
        $input = 2;

        self::assertInstanceOf(StubException::class, $factory->exception($rule, $input));
    }

    #[Test]
    public function shouldLookUpToAllNamespacesUntilExceptionIsCreated(): void
    {
        $factory = (new Factory())
            ->withExceptionNamespace(__NAMESPACE__)
            ->withExceptionNamespace(self::TEST_EXCEPTIONS_NAMESPACE);

        $rule = new Stub();
        $input = 2;

        self::assertInstanceOf(StubException::class, $factory->exception($rule, $input));
    }

    #[Test]
    public function shouldCreateValidationExceptionWhenExceptionIsNotFound(): void
    {
        $factory = new Factory();
        $input = 'input';
        $rule = new Stub();

        self::assertInstanceOf(ValidationException::class, $factory->exception($rule, $input));
    }

    #[Test]
    public function shouldSetInputAsParameterOfCreatedException(): void
    {
        $factory = (new Factory())->withExceptionNamespace(self::TEST_EXCEPTIONS_NAMESPACE);

        $rule = new Stub();
        $input = 2;

        $exception = $factory->exception($rule, $input);

        self::assertSame($input, $exception->getParam('input'));
    }

    #[Test]
    public function shouldSetTemplateWhenTemplateKeyIsDefined(): void
    {
        $factory = (new Factory())->withExceptionNamespace(self::TEST_EXCEPTIONS_NAMESPACE);

        $extraParams = [
            'template' => 'This is my template',
        ];

        $validations = [true, false, true, true];
        $rule = new Stub(...$validations);
        $input = 2;

        $exception = $factory->exception($rule, $input, $extraParams);

        self::assertSame($extraParams['template'], $exception->getMessage());
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

    #[Test]
    public function shouldAutoResolveExceptionIfNamespacePatternMatchesAndExceptionClassFound(): void
    {
        $this->expectException(StubException::class);

        $rule = new Stub();
        $rule->assert('test');
    }

    #[Test]
    public function shouldUseDefaultExceptionIfCustomExceptionNotFound(): void
    {
        $this->expectException(ValidationException::class);

        $rule = new CustomRule();
        $rule->assert('test');
    }
}
