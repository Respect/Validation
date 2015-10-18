<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

namespace Respect\Validation\Test;

use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Validatable;

abstract class RuleTestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * It is to provide constructor arguments and.
     *
     * @return array
     */
    abstract public function providerForValidInput();

    /**
     * @return array
     */
    abstract public function providerForInvalidInput();

    /**
     * @return \Respect\Validation\Validatable
     */
    public function getRuleMock($expectedResult = true)
    {
        $ruleMocked = $this->getMockBuilder('Respect\Validation\Validatable')
            ->disableOriginalConstructor()
            ->setMethods(
                [
                    'assert', 'check', 'getName', 'reportError', 'setName', 'setTemplate', 'validate',
                ]
            )
            ->getMock();

        $ruleMocked
            ->expects($this->any())
            ->method('validate')
            ->willReturn($expectedResult)
        ;

        if ($expectedResult) {
            $ruleMocked
                ->expects($this->any())
                ->method('check')
                ->willReturn($expectedResult)
            ;
            $ruleMocked
                ->expects($this->any())
                ->method('assert')
                ->willReturn($expectedResult)
            ;
        } else {
            $ruleMocked
                ->expects($this->any())
                ->method('check')
                ->willThrowException(new ValidationException())
            ;
            $ruleMocked
                ->expects($this->any())
                ->method('assert')
                ->willThrowException(new ValidationException())
            ;
        }

        return $ruleMocked;
    }

    /**
     * @dataProvider providerForValidInput
     *
     * @param Validatable $validator
     * @param mixed       $input
     */
    public function testShouldValidateValidInput(Validatable $validator, $input)
    {
        $this->assertTrue($validator->validate($input));
    }

    /**
     * @dataProvider providerForValidInput
     *
     * @param Validatable $validator
     * @param mixed       $input
     */
    public function testShouldCheckValidInput(Validatable $validator, $input)
    {
        $this->assertTrue($validator->check($input));
    }

    /**
     * @dataProvider providerForValidInput
     *
     * @param Validatable $validator
     * @param mixed       $input
     */
    public function testShouldAsserValidInput(Validatable $validator, $input)
    {
        $this->assertTrue($validator->assert($input));
    }

    /**
     * @dataProvider providerForInvalidInput
     *
     * @param Validatable $validator
     * @param mixed       $input
     */
    public function testShouldValidateInvalidInput(Validatable $validator, $input)
    {
        $this->assertFalse($validator->validate($input));
    }

    /**
     * @dataProvider providerForInvalidInput
     *
     * @param Validatable $validator
     * @param mixed       $input
     * @param string      $expectedExceptionMessage [optional]
     */
    public function testShouldCheckInvalidInput(Validatable $validator, $input, $expectedExceptionMessage = null)
    {
        $this->setExpectedException(
            '\Respect\Validation\Exceptions\ValidationException',
            $expectedExceptionMessage
        );

        $validator->check($input);
    }

    /**
     * @dataProvider providerForInvalidInput
     *
     * @param Validatable $validator
     * @param mixed       $input
     */
    public function testShouldAsserInvalidInput(Validatable $validator, $input, $expectedExceptionMessage = null)
    {
        $this->setExpectedException(
            '\Respect\Validation\Exceptions\ValidationException',
            $expectedExceptionMessage
        );

        $this->assertFalse($validator->assert($input));
    }
}
