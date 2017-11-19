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
use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Exceptions\FactorException;
use Respect\Validation\Exceptions\ValidationException;

/**
 * @group  rule
 * @covers \Respect\Validation\Rules\Factor
 * @covers \Respect\Validation\Exceptions\FactorException
 *
 * @author David Meister <thedavidmeister@gmail.com>
 */
class FactorTest extends TestCase
{
    /**
     * @dataProvider providerForValidFactor
     */
    public function testValidFactorShouldReturnTrue($dividend, $input): void
    {
        $min = new Factor($dividend);
        self::assertTrue($min->__invoke($input));
        self::assertTrue($min->check($input));
        self::assertTrue($min->assert($input));
    }

    /**
     * @dataProvider providerForInvalidFactor
     */
    public function testInvalidFactorShouldThrowFactorException($dividend, $input): void
    {
        $this->expectException(
            FactorException::class,
            ValidationException::stringify($input).' must be a factor of '.$dividend
        );

        $min = new Factor($dividend);
        self::assertFalse($min->__invoke($input));
        self::assertFalse($min->assert($input));
    }

    /**
     * @dataProvider providerForInvalidFactorDividend
     */
    public function testInvalidDividentShouldThrowComponentException($dividend, $input): void
    {
        $this->expectException(
            ComponentException::class,
            'Dividend '.ValidationException::stringify($dividend).' must be an integer'
        );

        // It is enough to simply create a new Factor to trigger the dividend
        // exceptions in __construct.
        new Factor($dividend);
    }

    public function providerForValidFactor()
    {
        $tests = [
            // Run through the first few integers.
            [1, 1],
            [2, 1],
            [2, 2],
            [3, 1],
            [3, 3],
            [4, 1],
            [4, 2],
            [4, 4],
            [5, 1],
            [5, 5],
            [6, 1],
            [6, 2],
            [6, 3],
            [6, 6],
            // Zero as a dividend is always a pass.
            [0, 0],
            [0, 1],
            [0, mt_rand()],
        ];

        $tests = $this->generateNegativeCombinations($tests);

        $tests = $this->generateStringAndFloatCombinations($tests);

        return $tests;
    }

    public function providerForInvalidFactor()
    {
        $tests = [
            // Run through the first few integers.
            [3, 2],
            [4, 3],
            [5, 2],
            [5, 3],
            [5, 4],
            // Zeros.
            [1, 0],
            [2, 0],
        ];

        $tests = $this->generateNegativeCombinations($tests);

        $tests = $this->generateStringAndFloatCombinations($tests);

        // Valid (but random) dividends, invalid inputs.
        $extra_tests = array_map(
            function ($test) {
                return [mt_rand(), $test];
            },
            $this->thingsThatAreNotIntegers()
        );
        $tests = array_merge($tests, $extra_tests);

        return $tests;
    }

    public function providerForInvalidFactorDividend()
    {
        // Invalid dividends, valid (but random) inputs.
        $tests = array_map(
            function ($test) {
                return [$test, mt_rand()];
            },
            $this->thingsThatAreNotIntegers()
        );

        // Also check for an empty dividend string.
        $tests[] = ['', mt_rand()];

        return $tests;
    }

    private function thingsThatAreNotIntegers()
    {
        return [
            0.5,
            1.5,
            -0.5,
            -1.5,
            PHP_INT_MAX + 1,
            // Non integer values.
            $this->randomFloatBeweenZeroAndOne(),
            -$this->randomFloatBeweenZeroAndOne(),
            'a',
            'foo',
            // Randomish string.
            uniqid('a'),
            // Non-scalars.
            [],
            new \StdClass(),
            new \DateTime(),
            null,
            true,
            false,
        ];
    }

    private function randomFloatBeweenZeroAndOne()
    {
        return mt_rand(1, mt_getrandmax() - 1) / mt_getrandmax();
    }

    private function generateNegativeCombinations($tests)
    {
        // Negate all the dividends.
        $tests = array_merge(
            $tests,
            array_map(
                function ($test) {
                    return [-$test[0], $test[1]];
                },
                $tests
            )
        );

        // Negate all the inputs.
        $tests = array_merge(
            $tests,
            array_map(
                function ($test) {
                    return [$test[0], -$test[1]];
                },
                $tests
            )
        );

        return $tests;
    }

    private function generateStringAndFloatCombinations($tests)
    {
        $base_tests = $tests;

        // Test everything again as a string.
        $tests = array_merge(
            $tests,
            array_map(
                function ($test) {
                    return [(string) $test[0], (string) $test[1]];
                },
                $base_tests
            )
        );

        // Test everything again as a float.
        $tests = array_merge(
            $tests,
            array_map(
                function ($test) {
                    return [(float) $test[0], (float) $test[1]];
                },
                $base_tests
            )
        );

        return $tests;
    }
}
