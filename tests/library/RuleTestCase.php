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
use Respect\Validation\Result;
use Respect\Validation\Rule;
use Respect\Validation\Validatable;

abstract class RuleTestCase extends TestCase
{
    /**
     * @return array
     */
    abstract public function providerForValidInput(): array;

    /**
     * @return array
     */
    abstract public function providerForInvalidInput(): array;

    /**
     * @return array
     */
    public function providerForAllInput(): array
    {
        return array_merge(
            $this->providerForValidInput(),
            $this->providerForInvalidInput()
        );
    }

    /**
     * @param bool             $expectedResult
     * @param string[optional] $mockClassName
     *
     * @deprecated
     *
     * @return Validatable
     */
    public function getRuleMock($expectedResult, $mockClassName = ''): Validatable
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
     * @api
     *
     * @param mixed $input
     * @param bool  $isValid
     *
     * @return Rule
     */
    public function createRuleMock($input, bool $isValid): Rule
    {
        $ruleMock = $this->createMock(Rule::class);

        $result = new Result($isValid, $input, $ruleMock);

        $ruleMock
            ->method('apply')
            ->with($input)
            ->willReturn($result);

        return $ruleMock;
    }

    /**
     * @api
     *
     * @param mixed $input
     * @param bool  $isValid
     * @param bool  $isValid2
     *
     * @return Rule[]
     */
    public function createManyRuleMock($input, bool ...$isValid)
    {
        $rules = [];
        foreach ($isValid as $isValidRule) {
            $rules[] = $this->createRuleMock($input, $isValidRule);
        }

        return $rules;
    }

    /**
     * @test
     *
     * @dataProvider providerForValidInput
     *
     * @param Rule  $rule
     * @param mixed $input
     */
    public function shouldValidateValidInput(Rule $rule, $input): void
    {
        $result = $rule->apply($input);

        self::assertTrue($result->isValid());
    }

    /**
     * @test
     *
     * @dataProvider providerForInvalidInput
     *
     * @param Rule  $rule
     * @param mixed $input
     */
    public function shouldValidateInvalidInput(Rule $rule, $input): void
    {
        $result = $rule->apply($input);

        self::assertFalse($result->isValid());
    }

    /**
     * @test
     *
     * @dataProvider providerForAllInput
     *
     * @param Rule  $rule
     * @param mixed $input
     */
    public function shouldReturnTheSameInputOnResult(Rule $rule, $input): void
    {
        $result = $rule->apply($input);

        self::assertSame($input, $result->getInput());
    }

    /**
     * @test
     *
     * @dataProvider providerForAllInput
     *
     * @param Rule  $rule
     * @param mixed $input
     */
    public function shouldReturnTheSameRuleOnResult(Rule $rule, $input): void
    {
        $result = $rule->apply($input);

        self::assertSame($rule, $result->getRule());
    }

    /**
     * @test
     *
     * @dataProvider providerForAllInput
     *
     * @param Rule  $rule
     * @param mixed $input
     */
    public function shouldReturnANonInvertedResult(Rule $rule, $input): void
    {
        $result = $rule->apply($input);

        self::assertFalse($result->isInverted());
    }
}
