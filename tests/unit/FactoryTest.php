<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation;

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

/**
 * @covers \Respect\Validation\Factory
 *
 * @author Augusto Pascutti <augusto@phpsp.org.br>
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class FactoryTest extends TestCase
{
    private const TEST_RULES_NAMESPACE = 'Respect\\Validation\\Test\\Rules';
    private const TEST_EXCEPTIONS_NAMESPACE = 'Respect\\Validation\\Test\\Exceptions';

    /**
     * @test
     */
    public function shouldCreateRuleByNameBasedOnNamespace(): void
    {
        $factory = (new Factory())
            ->withRuleNamespace(self::TEST_RULES_NAMESPACE);

        self::assertInstanceOf(Valid::class, $factory->rule('valid'));
    }

    /**
     * @test
     */
    public function shouldLookUpToAllNamespacesUntilRuleIsFound(): void
    {
        $factory = (new Factory())
            ->withRuleNamespace(__NAMESPACE__)
            ->withRuleNamespace(self::TEST_RULES_NAMESPACE);

        self::assertInstanceOf(Valid::class, $factory->rule('valid'));
    }

    /**
     * @test
     */
    public function shouldDefineConstructorArgumentsWhenCreatingRule(): void
    {
        $constructorArguments = [true, false, true, false];

        $factory = (new Factory())->withRuleNamespace(self::TEST_RULES_NAMESPACE);
        /** @var Stub $rule */
        $rule = $factory->rule('stub', $constructorArguments);

        self::assertSame($constructorArguments, $rule->validations);
    }

    /**
     * @test
     */
    public function shouldThrowsAnExceptionWhenRuleIsInvalid(): void
    {
        $factory = (new Factory())->withRuleNamespace(self::TEST_RULES_NAMESPACE);

        $this->expectException(InvalidClassException::class);
        $this->expectExceptionMessage(sprintf('"%s" must be an instance of "%s"', Invalid::class, Validatable::class));

        $factory->rule('invalid');
    }

    /**
     * @test
     */
    public function shouldThrowsAnExceptionWhenRuleIsNotInstantiable(): void
    {
        $factory = (new Factory())->withRuleNamespace(self::TEST_RULES_NAMESPACE);

        $this->expectException(InvalidClassException::class);
        $this->expectExceptionMessage(sprintf('"%s" must be instantiable', AbstractClass::class));

        $factory->rule('abstractClass');
    }

    /**
     * @test
     */
    public function shouldThrowsAnExceptionWhenRuleIsNotFound(): void
    {
        $factory = (new Factory())->withRuleNamespace(self::TEST_RULES_NAMESPACE);

        $this->expectException(ComponentException::class);
        $this->expectExceptionMessage('"notFoundRule" is not a valid rule name');

        $factory->rule('notFoundRule');
    }

    /**
     * @test
     */
    public function shouldCreateExceptionBasedOnRule(): void
    {
        $factory = (new Factory())->withExceptionNamespace(self::TEST_EXCEPTIONS_NAMESPACE);

        $rule = new Stub();
        $input = 2;

        self::assertInstanceOf(StubException::class, $factory->exception($rule, $input));
    }

    /**
     * @test
     */
    public function shouldLookUpToAllNamespacesUntilExceptionIsCreated(): void
    {
        $factory = (new Factory())
            ->withExceptionNamespace(__NAMESPACE__)
            ->withExceptionNamespace(self::TEST_EXCEPTIONS_NAMESPACE);

        $rule = new Stub();
        $input = 2;

        self::assertInstanceOf(StubException::class, $factory->exception($rule, $input));
    }

    /**
     * @test
     */
    public function shouldCreateValidationExceptionWhenExceptionIsNotFound(): void
    {
        $factory = new Factory();
        $input = 'input';
        $rule = new Stub();

        self::assertInstanceOf(ValidationException::class, $factory->exception($rule, $input));
    }

    /**
     * @test
     */
    public function shouldSetInputAsParameterOfCreatedException(): void
    {
        $factory = (new Factory())->withExceptionNamespace(self::TEST_EXCEPTIONS_NAMESPACE);

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
        $factory = (new Factory())->withExceptionNamespace(self::TEST_EXCEPTIONS_NAMESPACE);

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
        $factory = new Factory();

        $defaultInstance = Factory::getDefaultInstance();

        Factory::setDefaultInstance($factory);

        self::assertSame($factory, Factory::getDefaultInstance());

        Factory::setDefaultInstance($defaultInstance);
    }

    /**
     * @test
     */
    public function shouldAutoResolveExceptionIfNamespacePatternMatchesAndExceptionClassFound(): void
    {
        $this->expectException(StubException::class);

        $rule = new Stub();
        $rule->assert('test');
    }

    /**
     * @test
     */
    public function shouldUseDefaultExceptionIfCustomExceptionNotFound(): void
    {
        $this->expectException(ValidationException::class);

        $rule = new CustomRule();
        $rule->assert('test');
    }
}
