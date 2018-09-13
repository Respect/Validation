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
use function realpath;
use function sprintf;

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
     * Returns the directory used to store test fixtures.
     *
     * @return string
     */
    public function getFixtureDirectory(): string
    {
        return realpath(__DIR__.'/../fixtures');
    }

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
            ->expects(self::any())
            ->method('validate')
            ->willReturn($expectedResult);

        if ($expectedResult) {
            $validatableMocked
                ->expects(self::any())
                ->method('check')
                ->willReturn($expectedResult);
            $validatableMocked
                ->expects(self::any())
                ->method('assert')
                ->willReturn($expectedResult);
        } else {
            $checkException = new ValidationException(
                'validatable',
                'input',
                [],
                'trim'
            );
            $checkException->updateTemplate(sprintf('Exception for %s:check() method', $mockClassName));
            $validatableMocked
                ->expects(self::any())
                ->method('check')
                ->willThrowException($checkException);
            $assertException = new ValidationException(
                'validatable',
                'input',
                [],
                'trim'
            );
            $assertException->updateTemplate(sprintf('Exception for %s:assert() method', $mockClassName));
            $validatableMocked
                ->expects(self::any())
                ->method('assert')
                ->willThrowException($assertException);
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
        self::assertValidInput($validator, $input);
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
        self::assertInvalidInput($validator, $input);
    }

    public static function assertValidInput(Validatable $rule, $input): void
    {
        self::assertTrue($rule->validate($input));
    }

    public static function assertInvalidInput(Validatable $rule, $input): void
    {
        self::assertFalse($rule->validate($input));
    }
}
