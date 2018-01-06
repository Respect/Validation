<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation;

use PHPUnit\Framework\TestCase;
use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Exceptions\EqualsException;
use Respect\Validation\Exceptions\InvalidClassException;
use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Rules\Equals;
use Respect\Validation\Rules\Uppercase;
use Respect\Validation\Test\Exceptions\StubException;
use Respect\Validation\Test\Rules\AbstractClass;
use Respect\Validation\Test\Rules\Invalid;
use Respect\Validation\Test\Rules\Stub;
use Respect\Validation\Test\Rules\Valid;
use function sprintf;

/**
 * @covers \Respect\Validation\Factory
 */
final class FactoryTest extends TestCase
{
    private const TEST_RULES_NAMESPACE = 'Respect\\Validation\\Test\\Rules';
    private const TEST_EXCEPTIONS_NAMESPACE = 'Respect\\Validation\\Test\\Exceptions';

    /**
     * @test
     */
    public function shouldCreateARuleByNameBasedOnNamespace(): void
    {
        $factory = new Factory([self::TEST_RULES_NAMESPACE], []);

        self::assertInstanceOf(Valid::class, $factory->rule('valid'));
    }

    /**
     * @test
     */
    public function shouldLookUpToAllNamespacesUntilRuleIsFound(): void
    {
        $factory = new Factory([__NAMESPACE__, self::TEST_RULES_NAMESPACE], []);

        self::assertInstanceOf(Valid::class, $factory->rule('valid'));
    }

    /**
     * @test
     */
    public function shouldDefineConstructorArgumentsWhenCreatingARule(): void
    {
        $constructorArguments = [true, false, true, false];

        $factory = new Factory([self::TEST_RULES_NAMESPACE], []);
        $rule = $factory->rule('stub', $constructorArguments);

        self::assertSame($constructorArguments, $rule->validations);
    }

    /**
     * @test
     */
    public function shouldThrowsAnExceptionWhenRuleIsInvalid(): void
    {
        $factory = new Factory([self::TEST_RULES_NAMESPACE], []);

        $this->expectException(InvalidClassException::class);
        $this->expectExceptionMessage(sprintf('"%s" must be an instance of "%s"', Invalid::class, Validatable::class));

        $factory->rule('invalid');
    }

    /**
     * @test
     */
    public function shouldThrowsAnExceptionWhenRuleIsNotInstantiable(): void
    {
        $factory = new Factory([self::TEST_RULES_NAMESPACE], []);

        $this->expectException(InvalidClassException::class);
        $this->expectExceptionMessage(sprintf('"%s" must be instantiable', AbstractClass::class));

        $factory->rule('abstractClass');
    }

    /**
     * @test
     */
    public function shouldThrowsAnExceptionWhenRuleIsNotFound(): void
    {
        $factory = new Factory([self::TEST_RULES_NAMESPACE], []);

        $this->expectException(ComponentException::class);
        $this->expectExceptionMessage('"notFoundRule" is not a valid rule name');

        $factory->rule('notFoundRule');
    }

    /**
     * @test
     */
    public function shouldCreateExceptionBasedOnRule(): void
    {
        $factory = new Factory([], [self::TEST_EXCEPTIONS_NAMESPACE]);

        $rule = new Stub();
        $input = 2;

        self::assertInstanceOf(StubException::class, $factory->exception($rule, $input));
    }

    /**
     * @test
     */
    public function shouldLookUpToAllNamespacesUntilExceptionIsCreated(): void
    {
        $factory = new Factory([], [__NAMESPACE__, self::TEST_EXCEPTIONS_NAMESPACE]);

        $rule = new Stub();
        $input = 2;

        self::assertInstanceOf(StubException::class, $factory->exception($rule, $input));
    }

    /**
     * @test
     */
    public function shouldThrowAnExceptionWhenExceptionIsNotFound(): void
    {
        $factory = new Factory([], []);

        $this->expectException(ComponentException::class);
        $this->expectExceptionMessage('Cannot find exception for "stub" rule');

        $factory->exception(new Stub(), 'foo');
    }

    /**
     * @test
     */
    public function shouldSetInputAsParameterOfCreatedException(): void
    {
        $factory = new Factory([], [self::TEST_EXCEPTIONS_NAMESPACE]);

        $rule = new Stub();
        $input = 2;

        $exception = $factory->exception($rule, $input);

        self::assertSame($input, $exception->getParam('input'));
    }

    /**
     * @test
     */
    public function shouldPassPropertiesToCreatedException(): void
    {
        $factory = new Factory([], [self::TEST_EXCEPTIONS_NAMESPACE]);

        $validations = [true, false, true, true];
        $rule = new Stub(...$validations);
        $input = 2;

        $exception = $factory->exception($rule, $input);

        self::assertSame($validations, $exception->getParam('validations'));
    }

    /**
     * @test
     */
    public function shouldSetTemplateWhenTemplateKeyIsDefined(): void
    {
        $factory = new Factory([], [self::TEST_EXCEPTIONS_NAMESPACE]);

        $extraParams = [
            'template' => 'This is my template',
        ];

        $validations = [true, false, true, true];
        $rule = new Stub(...$validations);
        $input = 2;

        $exception = $factory->exception($rule, $input, $extraParams);

        self::assertSame($extraParams['template'], $exception->getTemplate());
    }

    /**
     * @test
     */
    public function shouldAlwaysReturnTheSameDefaultInstance(): void
    {
        self::assertSame(Factory::getDefaultInstance(), Factory::getDefaultInstance());
    }

    /**
     * @test
     */
    public function shouldBeAbleToOverwriteDefaultInstance(): void
    {
        $factory = new Factory([], []);

        $defaultInstance = Factory::getDefaultInstance();

        Factory::setDefaultInstance($factory);

        self::assertSame($factory, Factory::getDefaultInstance());

        Factory::setDefaultInstance($defaultInstance);
    }
}
