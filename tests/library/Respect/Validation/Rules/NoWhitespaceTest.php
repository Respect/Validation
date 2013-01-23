<?php
namespace Respect\Validation\Rules;

class NoWhitespaceTest extends \PHPUnit_Framework_TestCase
{
    protected $noWhitespaceValidator;

    protected function setUp()
    {
        $this->noWhitespaceValidator = new NoWhitespace;
    }

    /**
     * @dataProvider providerForPass
     */
    public function testStringWithNoWhitespaceShouldPass($input)
    {
        $this->assertTrue($this->noWhitespaceValidator->validate($input));
        $this->assertTrue($this->noWhitespaceValidator->check($input));
        $this->assertTrue($this->noWhitespaceValidator->assert($input));
    }

    /**
     * @dataProvider providerForFail
     * @expectedException Respect\Validation\Exceptions\NoWhitespaceException
     */
    public function testStringWithWhitespaceShouldFail($input)
    {
        $this->assertFalse($this->noWhitespaceValidator->validate($input));
        $this->assertFalse($this->noWhitespaceValidator->assert($input));
    }
    /**
     * @expectedException Respect\Validation\Exceptions\NoWhitespaceException
     */
    public function testStringWithLineBreaksShouldFail()
    {
        $this->assertFalse($this->noWhitespaceValidator->validate("w\npoiur"));
        $this->assertFalse($this->noWhitespaceValidator->assert("w\npoiur"));
    }

    public function providerForPass()
    {
        return array(
            array(0),
            array('wpoiur'),
            array('Foo'),
        );
    }

    public function providerForFail()
    {
        return array(
            array(' '),
            array('w poiur'),
            array('      '),
            array("Foo\nBar"),
            array("Foo\tBar"),
        );
    }
}
