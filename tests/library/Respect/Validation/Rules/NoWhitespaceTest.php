<?php
namespace Respect\Validation\Rules;

class NoWhitespaceTest extends \PHPUnit_Framework_TestCase
{
    protected $noWhitespaceValidator;

    protected function setUp()
    {
        $this->noWhitespaceValidator = new NoWhitespace;
    }

    public function testStringWithNoWhitespaceShouldPass()
    {
        $this->assertTrue($this->noWhitespaceValidator->validate('wpoiur'));
        $this->assertTrue($this->noWhitespaceValidator->check('wpoiur'));
        $this->assertTrue($this->noWhitespaceValidator->assert('wpoiur'));
    }

    /**
     * @expectedException Respect\Validation\Exceptions\NoWhitespaceException
     */
    public function testStringWithWhitespaceShouldFail()
    {
        $this->assertFalse($this->noWhitespaceValidator->validate('w poiur'));
        $this->assertFalse($this->noWhitespaceValidator->assert('w poiur'));
    }
    /**
     * @expectedException Respect\Validation\Exceptions\NoWhitespaceException
     */
    public function testStringWithLineBreaksShouldFail()
    {
        $this->assertFalse($this->noWhitespaceValidator->validate("w\npoiur"));
        $this->assertFalse($this->noWhitespaceValidator->assert("w\npoiur"));
    }
}

