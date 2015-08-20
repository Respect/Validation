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

/**
 * @group  rule
 * @covers Respect\Validation\Rules\Scalar
 * @covers Respect\Validation\Exceptions\ScalarException
 */
class ScalarTest extends \PHPUnit_Framework_TestCase
{
    protected $rule;

    protected function setUp()
    {
        $this->rule = new Scalar();
    }

    /**
     * @dataProvider providerForScalar
     */
    public function testShouldValidateScalarNumbers($input)
    {
        $this->assertTrue($this->rule->validate($input));
    }

    /**
     * @dataProvider providerForNonScalar
     */
    public function testShouldNotValidateNonScalarNumbers($input)
    {
        $this->assertFalse($this->rule->validate($input));
    }

    /**
     * @expectedException Respect\Validation\Exceptions\ScalarException
     * @expectedExceptionMessage "" must be a scalar value
     */
    public function testShouldThrowScalarExceptionWhenChecking()
    {
        $this->rule->check(null);
    }

    public function providerForScalar()
    {
        return array(
            array('6'),
            array('String'),
            array(1.0),
            array(42),
            array(false),
            array(true),
        );
    }

    public function providerForNonScalar()
    {
        return array(
            array(array()),
            array(function () {}),
            array(new \stdClass()),
            array(null),
            array(tmpfile()),
        );
    }
}
