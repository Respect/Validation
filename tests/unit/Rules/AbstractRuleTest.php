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

namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Message\Formatter;
use Respect\Validation\Message\Stringifier\KeepOriginalStringName;
use Respect\Validation\Test\TestCase;

/**
 * @covers \Respect\Validation\Rules\AbstractRule
 *
 * @author Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class AbstractRuleTest extends TestCase
{
    /**
     * @return bool[][]
     */
    public function providerForTrueAndFalse(): array
    {
        return [
            [true],
            [false],
        ];
    }

    /**
     * @dataProvider providerForTrueAndFalse
     * @covers       \Respect\Validation\Rules\AbstractRule::__invoke
     *
     * @test
     */
    public function magicMethodInvokeCallsValidateWithInput(bool $booleanResult): void
    {
        $input = 'something';

        $abstractRuleMock = $this
            ->getMockBuilder(AbstractRule::class)
            ->getMockForAbstractClass();

        $abstractRuleMock
            ->expects(self::once())
            ->method('validate')
            ->with($input)
            ->will(self::returnValue($booleanResult));

        self::assertEquals(
            $booleanResult,
            // Invoking it to trigger __invoke
            $abstractRuleMock($input),
            'When invoking an instance of AbstractRule, the method validate should' .
            'be called with the same input and return the same result.'
        );
    }

    /**
     * @covers \Respect\Validation\Rules\AbstractRule::assert
     *
     * @test
     */
    public function assertInvokesValidateOnSuccess(): void
    {
        $input = 'something';

        $abstractRuleMock = $this
            ->getMockBuilder(AbstractRule::class)
            ->onlyMethods(['validate', 'reportError'])
            ->getMockForAbstractClass();

        $abstractRuleMock
            ->expects(self::once())
            ->method('validate')
            ->with($input)
            ->will(self::returnValue(true));

        $abstractRuleMock
            ->expects(self::never())
            ->method('reportError');

        $abstractRuleMock->assert($input);
    }

    /**
     * @covers \Respect\Validation\Rules\AbstractRule::assert
     *
     * @test
     */
    public function assertInvokesValidateAndReportErrorOnFailure(): void
    {
        $input = 'something';
        $exception = new ValidationException(
            $input,
            'abstract',
            [],
            new Formatter('strval', new KeepOriginalStringName())
        );

        $abstractRuleMock = $this
            ->getMockBuilder(AbstractRule::class)
            ->onlyMethods(['validate', 'reportError'])
            ->getMockForAbstractClass();

        $abstractRuleMock
            ->expects(self::once())
            ->method('validate')
            ->with($input)
            ->will(self::returnValue(false));

        $abstractRuleMock
            ->expects(self::once())
            ->method('reportError')
            ->with($input)
            ->will(self::throwException($exception));

        $this->expectExceptionObject($exception);

        $abstractRuleMock->assert($input);
    }

    /**
     * @covers \Respect\Validation\Rules\AbstractRule::check
     *
     * @test
     */
    public function checkInvokesAssertToPerformTheValidationByDefault(): void
    {
        $input = 'something';

        $abstractRuleMock = $this
            ->getMockBuilder(AbstractRule::class)
            ->onlyMethods(['assert'])
            ->getMockForAbstractClass();

        $abstractRuleMock
            ->expects(self::once())
            ->method('assert')
            ->with($input);

        $abstractRuleMock->check($input);
    }

    /**
     * @covers \Respect\Validation\Rules\AbstractRule::setTemplate
     *
     * @test
     */
    public function shouldReturnTheCurrentObjectWhenDefinigTemplate(): void
    {
        $abstractRuleMock = $this
            ->getMockBuilder(AbstractRule::class)
            ->getMockForAbstractClass();

        self::assertSame($abstractRuleMock, $abstractRuleMock->setTemplate('whatever'));
    }

    /**
     * @covers \Respect\Validation\Rules\AbstractRule::setName
     *
     * @test
     */
    public function shouldReturnTheCurrentObjectWhenDefinigName(): void
    {
        $abstractRuleMock = $this
            ->getMockBuilder(AbstractRule::class)
            ->getMockForAbstractClass();

        self::assertSame($abstractRuleMock, $abstractRuleMock->setName('whatever'));
    }

    /**
     * @covers \Respect\Validation\Rules\AbstractRule::getName
     * @covers \Respect\Validation\Rules\AbstractRule::setName
     *
     * @test
     */
    public function shouldBeAbleToDefineAndRetrivedRuleName(): void
    {
        $abstractRuleMock = $this
            ->getMockBuilder(AbstractRule::class)
            ->getMockForAbstractClass();

        $name = 'something';

        $abstractRuleMock->setName($name);

        self::assertSame($name, $abstractRuleMock->getName());
    }
}
