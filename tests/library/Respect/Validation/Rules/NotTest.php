<?php
namespace Respect\Validation\Rules;

use Respect\Validation\Validator;

class NotTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider providerForValidNot
     *
     */
    public function testNot($v, $input)
    {
        $not = new Not($v);
        $this->assertTrue($not->assert($input));
    }

    public function testShortcutNot()
    {
        $this->assertTrue(Validator::int()->not()->assert('afg'));
    }

    /**
     * @dataProvider providerForInvalidNot
     * @expectedException Respect\Validation\Exceptions\ValidationException
     */
    public function testNotNotHaha($v, $input)
    {
        $not = new Not($v);
        $this->assertFalse($not->assert($input));
    }

    /**
     * @expectedException Respect\Validation\Exceptions\ValidationException
     */
    public function testShortcutNotNotHaha()
    {
        $this->assertFalse(Validator::int()->not()->assert(10));
    }

    public function providerForValidNot()
    {
        return array(
            array(new Int, 'aaa'),
            array(new AllOf(new NoWhitespace, new Digit), 'as df')
        );
    }

    public function providerForInvalidNot()
    {
        return array(
            array(new Int, ''),
            array(new Int, 123),
            array(new AllOf(new NoWhitespace, new Digit), '12 34')
        );
    }
}

