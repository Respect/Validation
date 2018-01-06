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

namespace Respect\Validation\Rules;

use PHPUnit\Framework\TestCase;
use Respect\Validation\Exceptions\ValidationException;

class AbstractRuleTest extends TestCase
{
    public function providerForTrueAndFalse()
    {
        return [
            [true],
            [false],
        ];
    }

    /**
     * @dataProvider providerForTrueAndFalse
     * @covers       \Respect\Validation\Rules\AbstractRule::__invoke
     */
    public function testMagicMethodInvokeCallsValidateWithInput($booleanResult): void
    {
        $input = 'something';

        $abstractRuleMock = $this
            ->getMockBuilder(AbstractRule::class)
            ->setMethods(['validate'])
            ->getMockForAbstractClass();

        $abstractRuleMock
            ->expects($this->once())
            ->method('validate')
            ->with($input)
            ->will($this->returnValue($booleanResult));

        self::assertEquals(
            $booleanResult,
            // Invoking it to trigger __invoke
            $abstractRuleMock($input),
            'When invoking an instance of AbstractRule, the method validate should be called with the same input and return the same result.'
        );
    }

    /**
     * @covers \Respect\Validation\Rules\AbstractRule::assert
     */
    public function testAssertInvokesValidateOnSuccess(): void
    {
        $input = 'something';

        $abstractRuleMock = $this
            ->getMockBuilder(AbstractRule::class)
            ->setMethods(['validate', 'reportError'])
            ->getMockForAbstractClass();

        $abstractRuleMock
            ->expects($this->once())
            ->method('validate')
            ->with($input)
            ->will($this->returnValue(true));

        $abstractRuleMock
            ->expects($this->never())
            ->method('reportError');

        $abstractRuleMock->assert($input);
    }

    /**
     * @covers            \Respect\Validation\Rules\AbstractRule::assert
     * @expectedException \Respect\Validation\Exceptions\ValidationException
     */
    public function testAssertInvokesValidateAndReportErrorOnFailure(): void
    {
        $input = 'something';

        $abstractRuleMock = $this
            ->getMockBuilder(AbstractRule::class)
            ->setMethods(['validate', 'reportError'])
            ->getMockForAbstractClass();

        $abstractRuleMock
            ->expects($this->once())
            ->method('validate')
            ->with($input)
            ->will($this->returnValue(false));

        $abstractRuleMock
            ->expects($this->once())
            ->method('reportError')
            ->with($input)
            ->will($this->throwException(new ValidationException()));

        $abstractRuleMock->assert($input);
    }

    /**
     * @covers \Respect\Validation\Rules\AbstractRule::check
     */
    public function testCheckInvokesAssertToPerformTheValidationByDefault(): void
    {
        $input = 'something';

        $abstractRuleMock = $this
            ->getMockBuilder(AbstractRule::class)
            ->setMethods(['assert'])
            ->getMockForAbstractClass();

        $abstractRuleMock
            ->expects($this->once())
            ->method('assert')
            ->with($input);

        $abstractRuleMock->check($input);
    }

    /**
     * @covers \Respect\Validation\Rules\AbstractRule::setTemplate
     */
    public function testShouldReturnTheCurrentObjectWhenDefinigTemplate(): void
    {
        $abstractRuleMock = $this
            ->getMockBuilder(AbstractRule::class)
            ->getMockForAbstractClass();

        self::assertSame($abstractRuleMock, $abstractRuleMock->setTemplate('whatever'));
    }

    /**
     * @covers \Respect\Validation\Rules\AbstractRule::setName
     */
    public function testShouldReturnTheCurrentObjectWhenDefinigName(): void
    {
        $abstractRuleMock = $this
            ->getMockBuilder(AbstractRule::class)
            ->getMockForAbstractClass();

        self::assertSame($abstractRuleMock, $abstractRuleMock->setName('whatever'));
    }

    /**
     * @covers \Respect\Validation\Rules\AbstractRule::setName
     * @covers \Respect\Validation\Rules\AbstractRule::getName
     */
    public function testShouldBeAbleToDefineAndRetrivedRuleName(): void
    {
        $abstractRuleMock = $this
            ->getMockBuilder(AbstractRule::class)
            ->getMockForAbstractClass();

        $name = 'something';

        $abstractRuleMock->setName($name);

        self::assertSame($name, $abstractRuleMock->getName());
    }
}
