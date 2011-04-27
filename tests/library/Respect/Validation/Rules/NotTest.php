<?php

namespace Respect\Validation\Rules;

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
            array(new AllOf(new NoWhitespace, new Digits), 'as df')
        );
    }

    public function providerForInvalidNot()
    {
        return array(
            array(new Int, 123),
            array(new AllOf(new NoWhitespace, new Digits), '12 34')
        );
    }

}