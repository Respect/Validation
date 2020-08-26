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

namespace Respect\Validation\Test;

use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Message\Formatter;
use Respect\Validation\Message\Stringifier\KeepOriginalStringName;
use Respect\Validation\Validatable;

use function realpath;
use function Respect\Stringifier\stringify;
use function sprintf;

/**
 * Abstract class to create TestCases for Rules.
 *
 * @since 1.0.0
 *
 * @author Antonio Spinelli <tonicospinelli85@gmail.com>
 * @author Danilo Correa <danilosilva87@gmail.com>
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author William Espindola <oi@williamespindola.com.br>
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
     * @return mixed[][]
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
     * @return mixed[][]
     */
    abstract public function providerForInvalidInput(): array;

    /**
     * Returns the directory used to store test fixtures.
     */
    public function getFixtureDirectory(): string
    {
        return (string) realpath(__DIR__ . '/../fixtures');
    }

    /**
     * Create a mock of a Validatable.
     *
     * @api
     */
    public function createValidatableMock(bool $expectedResult, string $mockClassName = ''): Validatable
    {
        $validatableMocked = $this->getMockBuilder(Validatable::class)
            ->disableOriginalConstructor()
            ->setMockClassName($mockClassName)
            ->getMock();

        $validatableMocked
            ->expects(self::any())
            ->method('validate')
            ->willReturn($expectedResult);

        if ($expectedResult) {
            $validatableMocked
                ->expects(self::any())
                ->method('check');
            $validatableMocked
                ->expects(self::any())
                ->method('assert');
        } else {
            $checkException = new ValidationException(
                'validatable',
                'input',
                [],
                new Formatter('strval', new KeepOriginalStringName())
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
                new Formatter('strval', new KeepOriginalStringName())
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
     * @param mixed       $input
     */
    public function shouldValidateInvalidInput(Validatable $validator, $input): void
    {
        self::assertInvalidInput($validator, $input);
    }

    /**
     * @param mixed $input
     */
    public static function assertValidInput(Validatable $rule, $input): void
    {
        self::assertTrue(
            $rule->validate($input),
            sprintf('Validation with input %s is expected to pass', stringify($input))
        );
    }

    /**
     * @param mixed $input
     */
    public static function assertInvalidInput(Validatable $rule, $input): void
    {
        self::assertFalse(
            $rule->validate($input),
            sprintf('Validation with input %s it not expected to pass', stringify($input))
        );
    }
}
