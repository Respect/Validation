<?php

namespace Respect\Validation\Rules;

class AlnumTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider providerForValidAlnum
     */
    public function testAlnumValid($validAlnum, $aditional)
    {
        $validator = new Alnum($aditional);
        $this->assertTrue($validator->validate($validAlnum));
    }

    /**
     * @dataProvider providerForInvalidAlnum
     * @expectedException Respect\Validation\Exceptions\NotAlphanumericException
     */
    public function testAlnumInvalid($invalidAlnum, $aditional)
    {
        $validator = new Alnum($aditional);
        $validator->assert($invalidAlnum);
    }

    public function providerForValidAlnum()
    {
        return array(
            array('alganet', ''),
            array('1', ''),
            array('a', ''),
            array('foobar', ''),
            array('rubinho_', '_'),
            array('google.com', '.'),
        );
    }

    public function providerForInvalidAlnum()
    {
        return array(
            array('@#$', ''),
            array('_', ''),
            array('', ''),
            array('dgç', ''),
            array('alganet alganet', ''),
        );
    }

}