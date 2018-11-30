<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

namespace Respect\Validation\Rules;

use Respect\Validation\TestCase;
use Respect\Validation\Validator;

/**
 * @group  rule
 * @covers Respect\Validation\Rules\Not
 * @covers Respect\Validation\Exceptions\NotException
 */
class NotTest extends TestCase
{
    /**
     * @dataProvider providerForValidNot
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

    /**
     * @dataProvider providerForSetName
     */
    public function testNotSetName($v)
    {
        $not = new Not($v);
        $not->setName('Foo');

        $this->assertEquals('Foo', $not->getName());
        $this->assertEquals('Foo', $v->getName());
    }

    public function providerForValidNot()
    {
        return [
            [new IntVal(), ''],
            [new IntVal(), 'aaa'],
            [new AllOf(new NoWhitespace(), new Digit()), 'as df'],
            [new AllOf(new NoWhitespace(), new Digit()), '12 34'],
            [new AllOf(new AllOf(new NoWhitespace(), new Digit())), '12 34'],
            [new AllOf(new NoneOf(new Numeric(), new IntVal())), 13.37],
            [new NoneOf(new Numeric(), new IntVal()), 13.37],
            [Validator::noneOf(Validator::numeric(), Validator::intVal()), 13.37],
        ];
    }

    public function providerForInvalidNot()
    {
        return [
            [new IntVal(), 123],
            [new AllOf(new OneOf(new Numeric(), new IntVal())), 13.37],
            [new OneOf(new Numeric(), new IntVal()), 13.37],
            [Validator::oneOf(Validator::numeric(), Validator::intVal()), 13.37],
        ];
    }

    public function providerForSetName()
    {
        return [
            [new IntVal()],
            [new AllOf(new Numeric, new IntVal)],
            [new Not(new Not(new IntVal()))],
            [Validator::intVal()->setName('Bar')],
            [Validator::noneOf(Validator::numeric(), Validator::intVal())],
        ];
    }
}
