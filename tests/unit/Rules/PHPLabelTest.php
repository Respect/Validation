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
 * @covers Respect\Validation\Rules\PHPLabel
 * @covers Respect\Validation\Exceptions\PHPLabelException
 */
class PHPLabelTest extends \PHPUnit_Framework_TestCase
{
    protected $phpLabelValidator;

    protected function setUp()
    {
        $this->phpLabelValidator = new PHPLabel();
    }

    /**
     * @dataProvider providerForPHPLabel
     */
    public function testValidPHPLabelShouldReturnTrue($input)
    {
        $this->assertTrue($this->phpLabelValidator->__invoke($input));
        $this->assertTrue($this->phpLabelValidator->assert($input));
        $this->assertTrue($this->phpLabelValidator->check($input));
    }

    /**
     * @dataProvider providerForNotPHPLabel
     * @expectedException Respect\Validation\Exceptions\PHPLabelException
     */
    public function testInvalidPHPLabelShouldThrowPhoneException($input)
    {
        $this->assertFalse($this->phpLabelValidator->__invoke($input));
        $this->assertFalse($this->phpLabelValidator->assert($input));
    }

    public function providerForPHPLabel()
    {
        return array_map(function($test) { return array($test); }, array(
            '_',
            'foo',
            'f00',
            uniqid('_'),
            uniqid('a'),
            strtoupper(uniqid('_')),
            strtoupper(uniqid('a')),
        ));
    }

    public function providerForNotPHPLabel()
    {
        return array_map(function($test) { return array($test); }, array(
            '%',
            '*',
            '-',
            'f-o-o-',
            "\n",
            "\r",
            "\t",
            ' ',
            'f o o',
            '0ne',
            '0_ne',
            uniqid(mt_rand(0, 9)),
            // Add some things that aren't even strings.
            null,
            mt_rand(),
            0,
            1,
            array(),
            new \StdClass(),
            new \DateTime(),
        ));
    }
}
