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
 * @covers Respect\Validation\Rules\Cnh
 * @covers Respect\Validation\Exceptions\CnhException
 */
class IterableTest extends \PHPUnit_Framework_TestCase
{

	/**
	 * @dataProvider providerForValidIterable
	 */
	public function testValidIterableParamShouldReturnTrue($iterable)
	{
		$validator = new Iterable();
		$this->assertTrue($validator->validate($iterable));
	}

	/**
	 * @dataProvider providerForInvalidIterable
	 */
	public function testInvalidIterableParamShouldReturnFalse($iterable)
	{
		$validator = new Iterable();
		$this->assertFalse($validator->validate($iterable));
	}

	public function providerForValidIterable()
	{
		return array(
			array(array(1, 2, 3)),
			array(new \stdClass),
			array(new \ArrayIterator)
		);
	}

	public function providerForInvalidIterable()
	{
		return array(
			array(3),
			array('asdf'),
			array(9.85),
			array(null),
			array(true)
		);
	}	
}
