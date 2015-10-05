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
 * @covers Respect\Validation\Rules\NotOptional
 * @covers Respect\Validation\Exceptions\NotOptionalException
 */
class NotOptionalTest extends \PHPUnit_Framework_TestCase
{
    protected $rule;

    protected function setUp()
    {
        $this->rule = new NotOptional();
    }

    /**
     * @dataProvider providerNotOptional
     */
    public function testStringNotOptional($input)
    {
        $this->assertTrue($this->rule->validate($input));
    }

    /**
     * @dataProvider providerForOptional
     */
    public function testStringOptional($input)
    {
        $this->assertFalse($this->rule->validate($input));
    }

    public function providerNotOptional()
    {
        return array(
            array(' '),
            array(null),
            array(array(5)),
            array(array(0)),
            array(new \stdClass()),
        );
    }

    public function providerForOptional()
    {
        return array(
            array(''),
        );
    }
}
