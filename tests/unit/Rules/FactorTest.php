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

/**
 * @group  rule
 * @covers Respect\Validation\Rules\Factor
 * @covers Respect\Validation\Exceptions\FactorException
 *
 * @author David Meister <thedavidmeister@gmail.com>
 */
class FactorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider providerForValidFactor
     */
    public function testValidFactorShouldReturnTrue($dividend, $input)
    {
        $min = new Factor($dividend);
        $this->assertTrue($min->__invoke($input));
        $this->assertTrue($min->check($input));
        $this->assertTrue($min->assert($input));
    }

    /**
     * @dataProvider providerForInvalidFactor
     */
    public function testInvalidFactorShouldThrowFactorException($dividend, $input)
    {
        $this->setExpectedException(
            'Respect\\Validation\\Exceptions\\FactorException',
            ValidationException::stringify($input).' must be a factor of '.$dividend
        );

        $min = new Factor($dividend);
        $this->assertFalse($min->__invoke($input));
        $this->assertFalse($min->assert($input));
    }

    /**
     * @dataProvider providerForInvalidFactorDividend
     */
    public function testInvalidDividentShouldThrowComponentException($dividend, $input)
    {
        $this->setExpectedException(
            'Respect\\Validation\\Exceptions\\ComponentException',
            'Dividend '.ValidationException::stringify($dividend).' must be an integer'
        );

        // It is enough to simply create a new Factor to trigger the dividend
        // exceptions in __construct.
        new Factor($dividend);
    }

    public function providerForValidFactor()
    {
        $tests = array(
            // Run through the first few integers.
            array(1, 1),
            array(2, 1),
            array(2, 2),
            array(3, 1),
            array(3, 3),
            array(4, 1),
            array(4, 2),
            array(4, 4),
            array(5, 1),
            array(5, 5),
            array(6, 1),
            array(6, 2),
            array(6, 3),
            array(6, 6),
            // Zero as a dividend is always a pass.
            array(0, 0),
            array(0, 1),
            array(0, mt_rand()),
        );

        $tests = $this->generateNegativeCombinations($tests);

        $tests = $this->generateStringAndFloatCombinations($tests);

        return $tests;
    }

    public function providerForInvalidFactor()
    {
        $tests = array(
            // Run through the first few integers.
            array(3, 2),
            array(4, 3),
            array(5, 2),
            array(5, 3),
            array(5, 4),
            // Zeros.
            array(1, 0),
            array(2, 0),
        );

        $tests = $this->generateNegativeCombinations($tests);

        $tests = $this->generateStringAndFloatCombinations($tests);

        // Valid (but random) dividends, invalid inputs.
        $extra_tests = array_map(
            function ($test) {
                return array(mt_rand(), $test);
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
                return array($test, mt_rand());
            },
            $this->thingsThatAreNotIntegers()
        );

        // Also check for an empty dividend string.
        $tests[] = array('', mt_rand());

        return $tests;
    }

    private function thingsThatAreNotIntegers()
    {
        return array(
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
            array(),
            new \StdClass(),
            new \DateTime(),
            null,
            true,
            false,
        );
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
                    return array(-$test[0], $test[1]);
                },
                $tests
            )
        );

        // Negate all the inputs.
        $tests = array_merge(
            $tests,
            array_map(
                function ($test) {
                    return array($test[0], -$test[1]);
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
                    return array((string) $test[0], (string) $test[1]);
                },
                $base_tests
            )
        );

        // Test everything again as a float.
        $tests = array_merge(
            $tests,
            array_map(
                function ($test) {
                    return array((float) $test[0], (float) $test[1]);
                },
                $base_tests
            )
        );

        return $tests;
    }
}
