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

namespace Respect\Validation\Test;

use PHPUnit\Framework\TestCase;
use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Validatable;

abstract class RuleTestCase extends TestCase
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
     * @param bool             $expectedResult
     * @param string[optional] $mockClassName
     *
     * @return Validatable
     */
    public function getRuleMock($expectedResult, $mockClassName = '')
    {
        $ruleMocked = $this->getMockBuilder(Validatable::class)
            ->disableOriginalConstructor()
            ->setMethods(
                [
                    'assert', 'check', 'getName', 'reportError', 'setName', 'setTemplate', 'validate',
                ]
            )
            ->setMockClassName($mockClassName)
            ->getMock();

        $ruleMocked
            ->expects($this->any())
            ->method('validate')
            ->willReturn($expectedResult);

        if ($expectedResult) {
            $ruleMocked
                ->expects($this->any())
                ->method('check')
                ->willReturn($expectedResult);
            $ruleMocked
                ->expects($this->any())
                ->method('assert')
                ->willReturn($expectedResult);
        } else {
            $ruleMocked
                ->expects($this->any())
                ->method('check')
                ->willThrowException(new ValidationException('Exception for '.$mockClassName.':check() method'));
            $ruleMocked
                ->expects($this->any())
                ->method('assert')
                ->willThrowException(new ValidationException('Exception for '.$mockClassName.':assert() method'));
        }

        return $ruleMocked;
    }

    /**
     * @dataProvider providerForValidInput
     *
     * @param Validatable $validator
     * @param mixed       $input
     */
    public function testShouldValidateValidInput(Validatable $validator, $input): void
    {
        self::assertTrue($validator->validate($input));
    }

    /**
     * @dataProvider providerForInvalidInput
     *
     * @param Validatable $validator
     * @param mixed       $input
     */
    public function testShouldValidateInvalidInput(Validatable $validator, $input): void
    {
        self::assertFalse($validator->validate($input));
    }
}
