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
        $this->assertTrue($this->cnpjValidator->validate($input));
    }

    /**
     * @dataProvider providerValidUnformattedCnpj
     */
    public function test_unformatted_cnpjs_should_validates($input) 
    {
        $this->assertTrue($this->cnpjValidator->validate($input));
    }

    /**
     * @dataProvider providerInvalidFormattedCnpj
     */
    public function test_invalid_cnpj_should_fail_when_formatted($input) 
    {
        $this->assertFalse($this->cnpjValidator->validate($input));
    }

    /**
     * @dataProvider providerInvalidUnformattedCnpj
     */
    public function test_invalid_cnpj_should_fail_when_not_formatted($input) 
    {
        $this->assertFalse($this->cnpjValidator->validate($input));
    }

    
    /**
     * @dataProvider providerInvalidFormattedAndUnformattedCnpjLength
     */
    public function test_cnpjs_with_incorrect_length_should_fail($input) 
    {
        $this->assertFalse($this->cnpjValidator->validate($input));
    }
    
    public function providerValidFormattedCnpj() 
    {
        return array(
            array('32.063.364/0001-07'),
            array('24.663.454/0001-00'),
            array('57.535.083/0001-30'),
            array('24.760.428/0001-09'),
            array('27.355.204/0001-00'),
            array('36.310.327/0001-07'),
        );
    }

    public function providerValidUnformattedCnpj() 
    {
        return array(
            array('38175021000110'),
            array('37550610000179'),
            array('12774546000189'),
            array('77456211000168'),
            array('02023077000102'),
        );
    }

    public function providerInvalidFormattedCnpj() 
    {
        return array(
            array('12.345.678/9012-34'),
            array('11.111.111/1111-11'),
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
            array('99-010-0.')
        );
    }
}
