<?php
namespace Respect\Validation\Rules;

class FloatTest extends \PHPUnit_Framework_TestCase
{
    protected $floatValidator;

    protected function setUp()
    {
        $this->floatValidator = new Float;
    }

    /**
     * @dataProvider providerForFloat
     */
    public function testFloatNumbersShouldPass($input)
    {
        $this->assertTrue($this->floatValidator->assert($input));
        $this->assertTrue($this->floatValidator->__invoke($input));
        $this->assertTrue($this->floatValidator->check($input));
    }

    /**
     * @dataProvider providerForNotFloat
     * @expectedException Respect\Validation\Exceptions\FloatException
     */
    public function testNotFloatNumbersShouldFail($input)
    {
        $this->assertFalse($this->floatValidator->__invoke($input));
        $this->assertFalse($this->floatValidator->assert($input));
    }

    public function providerForFloat()
    {
        return array(
            array(''),
            array(165),
            array(1),
            array(0),
            array(0.0),
            array('1'),
            array('19347e12'),
            array(165.0),
            array('165.7'),
            array(1e12),
        );
    }

    public function providerForNotFloat()
    {
        return array(
            array(null),
            array('a'),
            array(' '),
            array('Foo'),
        );
    }
}

