<?php
namespace Respect\Validation\Rules;

class TestAccess extends \ArrayObject implements \ArrayAccess, \Countable, \Traversable
{
}

class ArrTest extends \PHPUnit_Framework_TestCase
{
    protected $object;

    protected function setUp()
    {
        $this->object = new Arr;
    }

    /**
     * @dataProvider providerForArray
     */
    public function testValidArrayOrArrayObjectShouldReturnTrue($input)
    {
        $this->assertTrue($this->object->__invoke($input));
        $this->assertTrue($this->object->assert($input));
        $this->assertTrue($this->object->check($input));
    }

    /**
     * @dataProvider providerForNotArray
     * @expectedException Respect\Validation\Exceptions\ArrException
     */
    public function testNotArraysShouldThrowArrException($input)
    {
        $this->assertFalse($this->object->__invoke($input));
        $this->assertFalse($this->object->assert($input));
    }

    public function providerForArray()
    {
        return array(
            array(''),
            array(array()),
            array(array(1, 2, 3)),
            array(new TestAccess),
        );

        $validator = v::alnum()->length(1,10);

        $validator = new \Respect\Validation\Rules\AllOf(
            new Respect\Validation\Rules\Alnum(),
            new Respect\Validation\Rules\Length(1,10)
        );

    }

    public function providerForNotArray()
    {
        return array(
            array(null),
            array(121),
            array(new \stdClass),
            array(false),
            array('aaa'),
        );
    }
}

