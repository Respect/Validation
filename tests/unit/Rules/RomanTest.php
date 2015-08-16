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

class RomanTest extends \PHPUnit_Framework_TestCase
{
    protected $romanValidator;

    protected function setUp()
    {
        $this->romanValidator = new Roman();
    }

    /**
     * @dataProvider providerForRoman
     */
    public function testValidRomansShouldReturnTrue($input)
    {
        $this->assertTrue($this->romanValidator->__invoke($input));
        $this->assertTrue($this->romanValidator->validate($input));
        $this->assertTrue($this->romanValidator->assert($input));
        $this->assertTrue($this->romanValidator->check($input));
    }

    /**
     * @dataProvider providerForNotRoman
     * @expectedException Respect\Validation\Exceptions\RomanException
     */
    public function testInvalidRomansShouldThrowRomanException($input)
    {
        $this->assertFalse($this->romanValidator->__invoke($input));
        $this->assertFalse($this->romanValidator->validate($input));
        $this->assertFalse($this->romanValidator->assert($input));
    }

    public function providerForRoman()
    {
        return array(
            array(''),
            array('III'),
            array('IV'),
            array('VI'),
            array('XIX'),
            array('XLII'),
            array('LXII'),
            array('CXLIX'),
            array('CLIII'),
            array('MCCXXXIV'),
            array('MMXXIV'),
            array('MCMLXXV'),
            array('MMMMCMXCIX'),
        );
    }

    public function providerForNotRoman()
    {
        return array(
            array(' '),
            array('IIII'),
            array('IVVVX'),
            array('CCDC'), //
            array('MXM'),
            array('XIIIIIIII'),
            array('MIMIMI'),
        );
    }
}
