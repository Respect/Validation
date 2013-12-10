<?php
namespace Respect\Validation\Rules;

class CharsetTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider providerForValidCharset
     */
    public function testValidDataWithCharsetShouldReturnTrue($charset, $input)
    {
        $validator = new Charset($charset);
        $this->assertTrue($validator->__invoke($input));
    }

    /**
     * @dataProvider providerForInvalidCharset
     * @expectedException Respect\Validation\Exceptions\CharsetException
     */
    public function testInvalidCharsetShouldFailAndThrowCharsetException($charset, $input)
    {
        $validator = new Charset($charset);
        $this->assertFalse($validator->__invoke($input));
        $this->assertFalse($validator->assert($input));
    }

    /**
     * @dataProvider providerForInvalidParams
     * @expectedException Respect\Validation\Exceptions\ComponentException
     */
    public function testInvalidConstructorParamsShouldThrowComponentExceptionUponInstantiation($charset)
    {
        $validator = new Charset($charset);
    }

    public function providerForInvalidParams()
    {
        return array(
            array(new \stdClass),
            array(array()),
            array(null),
            array('16'),
            array('aeiou'),
            array('a'),
            array('Foo'),
            array('basic'),
            array(10)
        );
    }

    public function providerForValidCharset()
    {
        return array(
            array('UTF-8', ''),
            array('ISO-8859-1', mb_convert_encoding('açaí', 'ISO-8859-1')),
            array(array('UTF-8', 'ASCII'), 'strawberry'),
            array('ASCII', mb_convert_encoding('strawberry', 'ASCII')),
            array('UTF-8', '日本国'),
            array(array('ISO-8859-1', 'EUC-JP'), '日本国'),
            array('UTF-8', 'açaí'),
            array('ISO-8859-1', 'açaí'),
        );
    }

    public function providerForInvalidCharset()
    {
        return array(
            array('ASCII', '日本国'),
            array('ASCII', 'açaí')
        );
    }
}

