<?php

namespace Respect\Validation\Rules;

class AlphaTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider providerForValidAlpha
     */
    public function testAlphaValid($validAlpha, $aditional)
    {
        $validator = new Alpha($aditional);
        $this->assertTrue($validator->validate($validAlpha));
    }

    /**
     * @dataProvider providerForInvalidAlpha
     * @expectedException Respect\Validation\Exceptions\NotAlphaException
     */
    public function testAlphaInvalid($invalidAlpha, $aditional)
    {
        $validator = new Alpha($aditional);
        $validator->assert($invalidAlpha);
    }

    public function providerForValidAlpha()
    {
        return array(
            array('alganet', ''),
            array('a', ''),
            array('foobar', ''),
            array('rubinho_', '_'),
            array('google.com', '.'),
            array('al ganet', ' '),
        );
    }

    public function providerForInvalidAlpha()
    {
        return array(
            array('@#$', ''),
            array('_', ''),
            array('', ''),
            array('dgç', ''),
            array('1abc', ''),
            array('alganet alganet', ''),
            array('123', ''),
            array(123, ''),
        );
    }

}