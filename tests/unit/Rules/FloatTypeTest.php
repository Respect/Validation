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

class FloatTypeTest extends \PHPUnit_Framework_TestCase
{

	protected $floatTypeTest;

	public function setUp()
	{
		$this->floatTypeTest = new FloatTypeTest();
	}

	public function providerNumbersOfTypeFloat()
	{
		return array(
            array(165),
            array(1),
            array(0),
            array(0.0),
            array('1'),
            array('19347e12'),
            array(165.0),
            array('165.7'),
            array(1e12),
		);
	}

	public function providerNumbersOfTypeNotFloat()
	{

	}

}