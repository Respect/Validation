<?php
namespace Respect\Validation\Rules;

class NotEmptyTest extends \PHPUnit_Framework_TestCase
{
    protected $object;

    protected function setUp()
    {
        $this->object = new NotEmpty;
    }

    /**
     * @dataProvider providerForNotEmpty
     */
    public function testStringNotEmpty($input)
    {
        $this->assertTrue($this->object->assert($input));
    }

    /**
     * @dataProvider providerForNotEmptyNoJuggle
     */
    public function testStringNotEmptyNoJuggle($input)
    {
        $this->object = new NotEmpty(true);
        $this->assertTrue($this->object->assert($input));
    }

    /**
     * @dataProvider providerForEmpty
     * @expectedException Respect\Validation\Exceptions\NotEmptyException
     */
    public function testStringEmpty($input)
    {
        $this->assertFalse($this->object->assert($input));
    }

    /**
     * @dataProvider providerForEmptyNoJuggle
     * @expectedException Respect\Validation\Exceptions\NotEmptyException
     */
    public function testStringEmptyNoJuggle($input)
    {
        $this->object = new NotEmpty(true);
        $this->assertFalse($this->object->assert($input));
    }

    public function providerForNotEmptyNoJuggle()
    {
        return array(
            array(1),
            array('0'),
            array(' 0 '),
            array(' oi'),
            array(array(5)),
            array(array(0)),
            array(new \stdClass)
        );
    }

    public function providerForNotEmpty()
    {
        return array(
            array(1),
            array(' oi'),
            array(array(5)),
            array(array(0)),
            array(new \stdClass)
        );
    }

    public function providerForEmpty()
    {
        return array(
            array(''),
            array('0'),
            array(' 0 '),
            array('    '),
            array("\n"),
            array(false),
            array(null),
            array(array())
        );
    }

    public function providerForEmptyNoJuggle()
    {
        return array(
            array(''),
            array('    '),
            array("\n"),
            array(false),
            array(null),
            array(array())
        );
    }
}

