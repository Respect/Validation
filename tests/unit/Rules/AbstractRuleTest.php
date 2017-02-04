<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\ValidationException;

class AbstractRuleTest extends \PHPUnit_Framework_TestCase
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
    public function testMagicMethodInvokeCallsValidateWithInput($booleanResult)
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

        $this->assertEquals(
            $booleanResult,
            // Invoking it to trigger __invoke
            $abstractRuleMock($input),
            'When invoking an instance of AbstractRule, the method validate should be called with the same input and return the same result.'
        );
    }

    /**
     * @covers \Respect\Validation\Rules\AbstractRule::assert
     */
    public function testAssertInvokesValidateOnSuccess()
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
    public function testAssertInvokesValidateAndReportErrorOnFailure()
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
    public function testCheckInvokesAssertToPerformTheValidationByDefault()
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
     * @covers \Respect\Validation\Rules\AbstractRule::reportError
     * @covers \Respect\Validation\Rules\AbstractRule::createException
     */
    public function testShouldCreateExceptionBasedOnTheCurrentClassName()
    {
        if (defined('HHVM_VERSION')) {
            return $this->markTestSkipped('If you are a HHVM user, and you are in the mood, please fix it');
        }

        $exceptionMock = $this
            ->getMockBuilder(ValidationException::class)
            ->setMockClassName('MockRule1Exception')
            ->getMock();

        $abstractRuleMock = $this
            ->getMockBuilder(AbstractRule::class)
            ->setMockClassName('MockRule1')
            ->getMockForAbstractClass();

        $exception = $abstractRuleMock->reportError('something');

        $this->assertInstanceOf(get_class($exceptionMock), $exception);
    }

    /**
     * @covers \Respect\Validation\Rules\AbstractRule::reportError
     * @covers \Respect\Validation\Rules\AbstractRule::setTemplate
     */
    public function testShouldUseDefinedTemplateOnCreatedException()
    {
        $template = 'This is my template';

        $exceptionMock = $this
            ->getMockBuilder(ValidationException::class)
            ->setMethods(['setTemplate'])
            ->getMock();

        $exceptionMock
            ->expects($this->once())
            ->method('setTemplate')
            ->with($template);

        $abstractRuleMock = $this
            ->getMockBuilder(AbstractRule::class)
            ->setMethods(['createException'])
            ->getMockForAbstractClass();

        $abstractRuleMock
            ->expects($this->once())
            ->method('createException')
            ->will($this->returnValue($exceptionMock));

        $abstractRuleMock->setTemplate($template);
        $abstractRuleMock->reportError('something');
    }

    /**
     * @covers \Respect\Validation\Rules\AbstractRule::setTemplate
     */
    public function testShouldReturnTheCurrentObjectWhenDefinigTemplate()
    {
        $abstractRuleMock = $this
            ->getMockBuilder(AbstractRule::class)
            ->getMockForAbstractClass();

        $this->assertSame($abstractRuleMock, $abstractRuleMock->setTemplate('whatever'));
    }

    /**
     * @covers \Respect\Validation\Rules\AbstractRule::setName
     */
    public function testShouldReturnTheCurrentObjectWhenDefinigName()
    {
        $abstractRuleMock = $this
            ->getMockBuilder(AbstractRule::class)
            ->getMockForAbstractClass();

        $this->assertSame($abstractRuleMock, $abstractRuleMock->setName('whatever'));
    }

    /**
     * @covers \Respect\Validation\Rules\AbstractRule::setName
     * @covers \Respect\Validation\Rules\AbstractRule::getName
     */
    public function testShouldBeAbleToDefineAndRetrivedRuleName()
    {
        $abstractRuleMock = $this
            ->getMockBuilder(AbstractRule::class)
            ->getMockForAbstractClass();

        $name = 'something';

        $abstractRuleMock->setName($name);

        $this->assertSame($name, $abstractRuleMock->getName());
    }
}
