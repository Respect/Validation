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

/**
 * @group  rule
 * @covers Respect\Validation\Rules\Length
 * @covers Respect\Validation\Exceptions\LengthException
 */
class LengthTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider providerForValidLengthInclusive
     */
    public function testLengthInsideBoundsForInclusiveCasesReturnTrue($string, $min, $max)
    {
        $validator = new Length($min, $max, true);
        $this->assertTrue($validator->validate($string));
    }

    /**
     * @dataProvider providerForValidLengthNonInclusive
     */
    public function testLengthInsideBoundsForNonInclusiveCasesShouldReturnTrue($string, $min, $max)
    {
        $validator = new Length($min, $max, false);
        $this->assertTrue($validator->validate($string));
    }

    /**
     * @dataProvider providerForInvalidLengthInclusive
     */
    public function testLengthOutsideBoundsForInclusiveCasesReturnFalse($string, $min, $max)
    {
        $validator = new Length($min, $max, true);
        $this->assertfalse($validator->validate($string));
    }

    /**
     * @dataProvider providerForInvalidLengthNonInclusive
     */
    public function testLengthOutsideBoundsForNonInclusiveCasesReturnFalse($string, $min, $max)
    {
        $validator = new Length($min, $max, false);
        $this->assertfalse($validator->validate($string));
    }

    /**
     * @dataProvider providerForComponentException
     * @expectedException Respect\Validation\Exceptions\ComponentException
     */
    public function testComponentExceptionsForInvalidParameters($min, $max)
    {
        $buggyValidator = new Length($min, $max);
    }

    public function providerForValidLengthInclusive()
    {
        return [
            ['alganet', 1, 15],
            ['ççççç', 4, 6],
            [range(1, 20), 1, 30],
            [(object) ['foo' => 'bar', 'bar' => 'baz'], 0, 2],
            ['alganet', 1, null], //null is a valid max length, means "no maximum",
            ['alganet', null, 15], //null is a valid min length, means "no minimum"
        ];
    }

    public function providerForValidLengthNonInclusive()
    {
        return [
            ['alganet', 1, 15],
            ['ççççç', 4, 6],
            [range(1, 20), 1, 30],
            [(object) ['foo' => 'bar', 'bar' => 'baz'], 1, 3],
            ['alganet', 1, null], //null is a valid max length, means "no maximum",
            ['alganet', null, 15], //null is a valid min length, means "no minimum"
        ];
    }

    public function providerForInvalidLengthInclusive()
    {
        return [
            ['', 1, 15],
            ['alganet', 1, 6],
            [range(1, 20), 1, 19],
            ['alganet', 8, null], //null is a valid max length, means "no maximum",
            ['alganet', null, 6], //null is a valid min length, means "no minimum"
        ];
    }

    public function providerForInvalidLengthNonInclusive()
    {
        return [
            ['alganet', 1, 7],
            [(object) ['foo' => 'bar', 'bar' => 'baz'], 3, 5],
            [range(1, 50), 1, 30],
        ];
    }

    public function providerForComponentException()
    {
        return [
            ['a', 15],
            [1, 'abc d'],
            [10, 1],
        ];
    }
}
