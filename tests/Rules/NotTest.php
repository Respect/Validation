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

    /**
     * @dataProvider providerForInvalidNot
     * @expectedException Respect\Validation\Exceptions\ValidationException
     */
    public function testNotNotHaha($v, $input)
    {
        $not = new Not($v);
        $this->assertFalse($not->assert($input));
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

