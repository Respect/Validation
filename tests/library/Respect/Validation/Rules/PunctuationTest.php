<?php

namespace Respect\Validation\Rules;

class PunctuationTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider providerForValidPunctuation
     */
    public function testValidDataWithPunctuationShouldReturnTrue($validPunctuation, $aditional='')
    {
        $validator = new Punctuation($aditional);
        $this->assertTrue($validator->validate($validPunctuation));
    }

    /**
     * @dataProvider providerForInvalidPunctuation
     * @expectedException Respect\Validation\Exceptions\PunctuationException
     */
    public function testInvalidPunctuationShouldFailAndThrowPunctuationException($invalidPunctuation, $aditional='')
    {
        $validator = new Punctuation($aditional);
        $this->assertFalse($validator->validate($invalidPunctuation));
        $this->assertFalse($validator->assert($invalidPunctuation));
    }

    /**
     * @dataProvider providerForInvalidParams
     * @expectedException Respect\Validation\Exceptions\ComponentException
     */
    public function testInvalidConstructorParamsShouldThrowComponentExceptionUponInstantiation($aditional)
    {
        $validator = new Punctuation($aditional);
    }

    public function providerForInvalidParams()
    {
        return array(
            array(new \stdClass),
            array(array()),
            array(0x2)
        );
    }

    public function providerForValidPunctuation()
    {
        return array(
            array('.'),
            array(',;:'),
            array('-@#$*'),
            array('()[]{}'),
        );
    }

    public function providerForInvalidPunctuation()
    {
        return array(
            array(''),
            array('16-50'),
            array('a'),
            array(' '),
            array('Foo'),
            array('12.1'),
            array('-12'),
            array(-12),
            array('( )_{}'),
        );
    }

}
