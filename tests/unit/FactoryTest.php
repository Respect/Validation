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
use Respect\Validation\Exceptions\EqualsException;
use Respect\Validation\Exceptions\InvalidClassException;
use Respect\Validation\Exceptions\RuleNotFoundException;
use Respect\Validation\Test\Rules\AbstractRule;
use Respect\Validation\Test\Rules\Equals;
use Respect\Validation\Test\Rules\Stub;
use stdClass;

/**
 * @group engine
 *
 * @covers \Respect\Validation\Factory
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 *
 * @since 0.8.0
 */
final class FactoryTest extends TestCase
{
    const TEST_NAMESPACE = 'Respect\Validation\\Test';
    const DEFAULT_NAMESPACE = __NAMESPACE__;

    /**
     * @test
     */
    public function shouldReturnHaveTheDefaultNamespaceWhenNoneIsDefined(): void
    {
        $factory = new Factory();

        $expectedNamespaces = [self::DEFAULT_NAMESPACE];
        $actualNamespaces = $factory->getNamespaces();

        self::assertSame($expectedNamespaces, $actualNamespaces);
    }

    /**
     * @test
     */
    public function shouldAddDefaultNamespaceToTheEndOfTheArrayWhenItIsNotInTheArray(): void
    {
        $factory = new Factory([self::TEST_NAMESPACE]);

        $expectedNamespaces = [self::TEST_NAMESPACE, self::DEFAULT_NAMESPACE];
        $actualNamespaces = $factory->getNamespaces();

        self::assertSame($expectedNamespaces, $actualNamespaces);
    }

    /**
     * @test
     */
    public function shouldNotAddDefaultNamespaceToTheEndOfTheArrayWhenItIsAlreadyInTheArray(): void
    {
        $namespaces = [self::DEFAULT_NAMESPACE, self::TEST_NAMESPACE];

        $factory = new Factory($namespaces);

        $expectedNamespaces = $namespaces;
        $actualNamespaces = $factory->getNamespaces();

        self::assertSame($expectedNamespaces, $actualNamespaces);
    }

    /**
     * @test
     */
    public function shouldCreateARuleBasedOnTheDefinedNamespace(): void
    {
        $factory = new Factory([self::TEST_NAMESPACE]);

        $rule = $factory->rule('Stub', [true, []]);

        self::assertInstanceOf(Stub::class, $rule);
    }

    /**
     * @test
     */
    public function shouldCreateARulePrioritizingTheFirstNamespaces(): void
    {
        $factory = new Factory([self::TEST_NAMESPACE, self::DEFAULT_NAMESPACE]);

        $rule = $factory->rule('Equals');

        self::assertInstanceOf(Equals::class, $rule);
    }

    /**
     * @test
     */
    public function shouldThrowAnExceptionWhenClassIsNotARespectRule(): void
    {
        $factory = new Factory([self::TEST_NAMESPACE]);

        $this->expectException(InvalidClassException::class);
        $this->expectExceptionMessage('"Respect\Validation\Test\Rules\NotARule" is not subclass of "Respect\Validation\Rule"');

        $factory->rule('NotARule');
    }

    /**
     * @test
     */
    public function shouldCreateRuleWithTheDefinedArgumentsAsConstructorArguments(): void
    {
        $isValid = true;
        $properties = [new stdClass()];

        $factory = new Factory([self::TEST_NAMESPACE]);

        $rule = $factory->rule('Stub', [$isValid, $properties]);

        self::assertSame($rule->isValid, $isValid);
        self::assertSame($rule->properties, $properties);
    }

    /**
     * @test
     */
    public function shouldThrowAnExceptionWhenRuleCannotBeInstantiated(): void
    {
        $factory = new Factory([self::TEST_NAMESPACE]);

        $this->expectException(InvalidClassException::class);
        $this->expectExceptionMessage(sprintf('"%s" is not instantiable', AbstractRule::class));

        $factory->rule('AbstractRule');
    }

    /**
     * @test
     */
    public function shouldThrowAnExceptionWhenRuleCouldNotBeFound(): void
    {
        $factory = new Factory();

        $this->expectException(RuleNotFoundException::class);
        $this->expectExceptionMessage('Could not find "HopeNobodyCreatesThisRule" rule');

        $factory->rule('HopeNobodyCreatesThisRule');
    }

    /**
     * @test
     */
    public function shouldAlwaysReturnTheDefaultInstance(): void
    {
        $defaultInstance1 = Factory::getDefaultInstance();
        $defaultInstance2 = Factory::getDefaultInstance();

        self::assertSame($defaultInstance1, $defaultInstance2);
    }

    /**
     * @test
     */
    public function shouldBeAbleToOverrideTheDefaultInstance(): void
    {
        $newDefaultInstance = new Factory();

        Factory::setDefaultInstance($newDefaultInstance);

        self::assertSame($newDefaultInstance, Factory::getDefaultInstance());
    }

    /**
     * @test
     */
    public function shouldCreateAnExceptionFromAMessage(): void
    {
        $factory = new Factory();

        $message = new Message('Equals', 'template', 'input');

        $exception = $factory->exception($message);

        self::assertInstanceOf(EqualsException::class, $exception);
    }

    /**
     * @test
     */
    public function shouldCreateAnExceptionFromAMessageUsingTheMessageTemplate(): void
    {
        $factory = new Factory();

        $template = 'This is my template';

        $message = new Message('Equals', $template, 'input');

        $exception = $factory->exception($message);

        self::assertSame($template, $exception->getMessage());
    }
}
