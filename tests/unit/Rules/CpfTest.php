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
 * @covers Respect\Validation\Rules\Cpf
 * @covers Respect\Validation\Exceptions\CpfException
 */
class CpfTest extends \PHPUnit_Framework_TestCase
{
    protected $cpfValidator;

    protected function setUp()
    {
        $this->cpfValidator = new Cpf();
    }

    /**
     * @dataProvider providerValidFormattedCpf
     */
    public function testFormattedCpfsShouldValidate($input)
    {
        $this->assertTrue($this->cpfValidator->assert($input));
    }

    /**
     * @dataProvider providerValidUnformattedCpf
     */
    public function testUnformattedCpfsShouldValidates($input)
    {
        $this->assertTrue($this->cpfValidator->assert($input));
    }

    /**
     * @dataProvider providerInvalidFormattedCpf
     * @expectedException Respect\Validation\Exceptions\CpfException
     */
    public function testInvalidCpfShouldFailWhenFormatted($input)
    {
        $this->assertFalse($this->cpfValidator->assert($input));
    }

    /**
     * @dataProvider providerInvalidUnformattedCpf
     * @expectedException Respect\Validation\Exceptions\CpfException
     */
    public function testInvalidCpfShouldFailWhenNotFormatted($input)
    {
        $this->assertFalse($this->cpfValidator->assert($input));
    }

    /**
     * @dataProvider providerInvalidFormattedAndUnformattedCpfLength
     * @expectedException Respect\Validation\Exceptions\CpfException
     */
    public function testCpfsWithIncorrectLengthShouldFail($input)
    {
        $this->assertFalse($this->cpfValidator->assert($input));
    }

    public function providerValidFormattedCpf()
    {
        return array(
            array('342.444.198-88'),
            array('342.444.198.88'),
            array('350.45261819'),
            array('693-319-118-40'),
            array('3.6.8.8.9.2.5.5.4.8.8'),
        );
    }

    public function providerValidUnformattedCpf()
    {
        return array(
            array('11598647644'),
            array('86734718697'),
            array('86223423284'),
            array('24845408333'),
            array('95574461102'),
        );
    }

    public function providerInvalidFormattedCpf()
    {
        return array(
            array(''),
            array('000.000.000-00'),
            array('111.222.444-05'),
            array('999999999.99'),
            array('8.8.8.8.8.8.8.8.8.8.8'),
            array('693-319-110-40'),
            array('698.111-111.00'),
        );
    }

    public function providerInvalidUnformattedCpf()
    {
        return array(
            array('11111111111'),
            array('22222222222'),
            array('12345678900'),
            array('99299929384'),
            array('84434895894'),
            array('44242340000'),
        );
    }

    public function providerInvalidFormattedAndUnformattedCpfLength()
    {
        return array(
            array('1'),
            array('22'),
            array('123'),
            array('992999999999929384'),
        );
    }
}
