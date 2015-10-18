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
 * @covers Respect\Validation\Rules\FloatType
 */
class FloatTypeTest extends \PHPUnit_Framework_TestCase
{

	protected $floatTypeTest;

	public function setUp()
	{
		$this->floatTypeTest = new FloatType();
	}

    /**
     * @dataProvider providerNumbersFloat
     */
	public function testNumbersTypeFloat($input)
	{
		$this->assertTrue($this->floatTypeTest->validate($input));
	}

    /**
     * @dataProvider provideNumbersNotFloat
     */
	public function testNumbersTypeNotFloat($input)
	{
		$this->assertFalse($this->floatTypeTest->validate($input));
	}

	public function providerNumbersFloat()
	{
		return array(
            array(165.23),
            array(1.3e3),
            array(7E-10),
            array(0.0),
            array(-2.44),
            array(10/33.33),
            array(PHP_INT_MAX + 1),
		);
	}

	public function provideNumbersNotFloat()
	{
		return array(
			array('1'),
			array('1.0'),
			array('7E-10'),
			array(111111),
			array(PHP_INT_MAX * -1)
		);
	}

}