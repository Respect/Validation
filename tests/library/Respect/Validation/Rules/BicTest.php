<?php

namespace Respect\Validation\Rules;

class BicTest extends \PHPUnit_Framework_TestCase
{

    protected $bicValidator;

    protected function setUp()
    {
        $this->bicValidator = new Bic;
    }

    /**
     * @dataProvider providerForBic
     *
     */
    public function test_valid_bic_should_return_True($input)
    {
        $this->assertTrue($this->bicValidator->validate($input));
        $this->assertTrue($this->bicValidator->assert($input));
        $this->assertTrue($this->bicValidator->check($input));
    }

    /**
     * @dataProvider providerForNotBic
     * @expectedException Respect\Validation\Exceptions\BicException
     */
    public function test_invalid_bic_should_throw_BicException($input)
    {
        $this->assertFalse($this->bicValidator->validate($input));
        $this->assertFalse($this->bicValidator->assert($input));
    }

    public function providerForBic()
    {
        return array(
            array('BCANCAW2'), // Bank of Canada
            array('HKBCCATTMON'), // HSBC Bank Canada
            array('AIBKUS3TTMK'), // AIG
            array('BOFAUS3DSG3'), // Bank of America
        );
    }

    public function providerForNotBic()
    {
        return array(
            array(null),
            array('it isnt a BIC code'),
            array('&stR@ng3|) (|-|@r$'),
            array('1234'),
        );
    }

}
