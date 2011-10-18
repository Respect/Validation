<?php

namespace Respect\Validation\Rules;

class CnpjTest extends \PHPUnit_Framework_TestCase {

    protected $cnpjValidator;

    protected function setUp() 
    {
        $this->cnpjValidator = new Cnpj;
    }
    
    /**
     * @dataProvider providerValidFormattedCnpj
     */
    public function test_formatted_cnpjs_should_validate($input) 
    {
        $this->assertTrue($this->cnpjValidator->assert($input));
    }

    /**
     * @dataProvider providerValidUnformattedCnpj
     */
    public function test_unformatted_cnpjs_should_validates($input) 
    {
        $this->assertTrue($this->cpfValidator->assert($input));
    }

    /**
     * @dataProvider providerInvalidFormattedCnpj
     */
    public function test_invalid_cnpj_should_fail_when_formatted($input) 
    {
        $this->assertFalse($this->cnpjValidator->assert($input));
    }

    /**
     * @dataProvider providerInvalidUnformattedCnpj
     */
    public function test_invalid_cnpj_should_fail_when_not_formatted($input) 
    {
        $this->assertFalse($this->cnpjValidator->assert($input));
    }

    
    /**
     * @dataProvider providerInvalidFormattedAndUnformattedCnpjLength
     */
    public function test_cnpjs_with_incorrect_length_should_fail($input) 
    {
        $this->assertFalse($this->cnpjValidator->assert($input));
    }
    
    public function providerValidFormattedCnpj() 
    {
        return array(
            array('342.444.198-88'),
            array('342.444.198.88'),
            array('350.45261819'),
            array('693-319-118-40'),
            array('3.6.8.8.9.2.5.5.4.8.8')
        );
    }

    public function providerValidUnformattedCnpj() 
    {
        return array(
            array('11598647644'),
            array('86734718697'),
            array('86223423284'),
            array('24845408333'),
            array('95574461102'),
        );
    }

    public function providerInvalidFormattedCnpj() 
    {
        return array(
            array('000.000.000-00'),
            array('111.222.444-05'),
            array('999999999.99'),
            array('8.8.8.8.8.8.8.8.8.8.8'),
            array('693-319-110-40'),
            array('698.111-111.00')
        );
    }

    public function providerInvalidUnformattedCnpj()
    {
        return array(
            array('11111111111'),
            array('22222222222'),
            array('12345678900'),
            array('99299929384'),
            array('84434895894'),
            array('44242340000')
        );
    }
    
    public function providerInvalidFormattedAndUnformattedCnpjLength()
    {
        return array(
            array('1'),
            array('22'),
            array('123'),
            array('992999999999929384'),
            array('')
        );
    }
}