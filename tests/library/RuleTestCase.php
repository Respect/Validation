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

/**
 * Abstract class to create TestCases for Rules.
 *
 * @author Antonio Spinelli <tonicospinelli85@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 *
 * @since 1.0.0
 */
abstract class RuleTestCase extends TestCase
{
    /**
     * Data providers for valid results.
     *
     * It returns an array of arrays. Each array contains an instance of Validatable
     * as the first element and an input in which the validation SHOULD pass.
     *
     * @api
     *
     * @return array[]
     */
    abstract public function providerForValidInput(): array;

    /**
     * Data providers for invalid results.
     *
     * It returns an array of arrays. Each array contains an instance of Validatable
     * as the first element and an input in which the validation SHOULD NOT pass.
     *
     * @api
     *
     * @return array[]
     */
    abstract public function providerForInvalidInput(): array;

    /**
     * Create a mock of a Validatable.
     *
     * @api
     *
     * @param bool             $expectedResult
     * @param string[optional] $mockClassName
     *
     * @return Validatable
     */
    public function createValidatableMock(bool $expectedResult, string $mockClassName = ''): Validatable
    {
        $validatableMocked = $this->getMockBuilder(Validatable::class)
            ->disableOriginalConstructor()
            ->setMethods(
                [
                    'assert', 'check', 'getName', 'reportError', 'setName', 'setTemplate', 'validate',
                ]
            )
            ->setMockClassName($mockClassName)
            ->getMock();

        $validatableMocked
            ->expects($this->any())
            ->method('validate')
            ->willReturn($expectedResult);

        if ($expectedResult) {
            $validatableMocked
                ->expects($this->any())
                ->method('check')
                ->willReturn($expectedResult);
            $validatableMocked
                ->expects($this->any())
                ->method('assert')
                ->willReturn($expectedResult);
        } else {
            $validatableMocked
                ->expects($this->any())
                ->method('check')
                ->willThrowException(new ValidationException('Exception for '.$mockClassName.':check() method'));
            $validatableMocked
                ->expects($this->any())
                ->method('assert')
                ->willThrowException(new ValidationException('Exception for '.$mockClassName.':assert() method'));
        }

        return $validatableMocked;
    }

    /**
     * @test
     *
     * @dataProvider providerForValidInput
     *
     * @param Validatable $validator
     * @param mixed       $input
     */
    public function shouldValidateValidInput(Validatable $validator, $input): void
    {
        self::assertTrue($validator->validate($input));
    }

    /**
     * @test
     *
     * @dataProvider providerForInvalidInput
     *
     * @param Validatable $validator
     * @param mixed       $input
     */
    public function shouldValidateInvalidInput(Validatable $validator, $input): void
    {
        self::assertFalse($validator->validate($input));
    }
}
