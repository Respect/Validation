<?php
/*
 * This file is part of Respect/Validation.
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

namespace Respect\Validation\Rules;

/**
 * @group  rule
 * @covers \Respect\Validation\Rules\Pis
 * @covers \Respect\Validation\Exceptions\PisException
 */
class PisTest extends \PHPUnit_Framework_TestCase
{
    protected $pisValidator;

    protected function setUp()
    {
        $this->pisValidator = new Pis();
    }

    /**
     * @dataProvider providerValidFormattedPis
     */
    public function testFormattedPisShouldValidate($input)
    {
        $this->assertTrue($this->pisValidator->assert($input));
    }

    /**
     * @dataProvider providerValidUnformattedPis
     */
    public function testUnformattedPisShouldValidates($input)
    {
        $this->assertTrue($this->pisValidator->assert($input));
    }

    /**
     * @dataProvider providerInvalidFormattedPis
     * @expectedException \Respect\Validation\Exceptions\PisException
     */
    public function testInvalidPisShouldFailWhenFormatted($input)
    {
        $this->assertFalse($this->pisValidator->assert($input));
    }

    /**
     * @dataProvider providerInvalidUnformattedPis
     * @expectedException \Respect\Validation\Exceptions\PisException
     */
    public function testInvalidPisShouldFailWhenNotFormatted($input)
    {
        $this->assertFalse($this->pisValidator->assert($input));
    }

    /**
     * @dataProvider providerInvalidFormattedAndUnformattedPisLength
     * @expectedException \Respect\Validation\Exceptions\PisException
     */
    public function testPisWithIncorrectLengthShouldFail($input)
    {
        $this->assertFalse($this->pisValidator->assert($input));
    }

    public function providerValidFormattedPis()
    {
        return [
            ['120.4454.683-5'],
            ['120.8995.084-8'],
            ['120.5146.8577'],
            ['120.01842459'],
            ['1.2.0.7.9.8.1.6.7.8.2']
        ];
    }

    public function providerValidUnformattedPis()
    {
        return [
            ['12044546835'],
            ['12089950848'],
            ['12051468577'],
            ['12001842459'],
            ['12079816782']
        ];
    }

    public function providerInvalidFormattedPis()
    {
        return [
            [''],
            ['000.0000.000-0'],
            ['111.2222.444-5'],
            ['999999999.99'],
            ['8.8.8.8.8.8.8.8.8.8.8'],
            ['693-3129-110-0'],
            ['698.1131-111.0'],
        ];
    }

    public function providerInvalidUnformattedPis()
    {
        return [
            ['11111111111'],
            ['22222222222'],
            ['12345678900'],
            ['99299929384'],
            ['84434895894'],
            ['44242340000'],
        ];
    }

    public function providerInvalidFormattedAndUnformattedPisLength()
    {
        return [
            ['1'],
            ['22'],
            ['123'],
            ['992999999999929384'],
        ];
    }
}
