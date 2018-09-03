<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use PHPUnit\Framework\TestCase;

/**
 * @group  rule
 * @covers \Respect\Validation\Exceptions\LengthException
 * @covers \Respect\Validation\Rules\Length
 */
class LengthTest extends TestCase
{
    /**
     * @dataProvider providerForValidLengthInclusive
     *
     * @test
     */
    public function lengthInsideBoundsForInclusiveCasesReturnTrue($string, $min, $max): void
    {
        $validator = new Length($min, $max, true);
        self::assertTrue($validator->isValid($string));
    }

    /**
     * @dataProvider providerForValidLengthNonInclusive
     *
     * @test
     */
    public function lengthInsideBoundsForNonInclusiveCasesShouldReturnTrue($string, $min, $max): void
    {
        $validator = new Length($min, $max, false);
        self::assertTrue($validator->isValid($string));
    }

    /**
     * @dataProvider providerForInvalidLengthInclusive
     *
     * @test
     */
    public function lengthOutsideBoundsForInclusiveCasesReturnFalse($string, $min, $max): void
    {
        $validator = new Length($min, $max, true);
        self::assertfalse($validator->isValid($string));
    }

    /**
     * @dataProvider providerForInvalidLengthNonInclusive
     *
     * @test
     */
    public function lengthOutsideBoundsForNonInclusiveCasesReturnFalse($string, $min, $max): void
    {
        $validator = new Length($min, $max, false);
        self::assertfalse($validator->isValid($string));
    }

    /**
     * @dataProvider providerForComponentException
     * @expectedException \Respect\Validation\Exceptions\ComponentException
     *
     * @test
     */
    public function componentExceptionsForInvalidParameters($min, $max): void
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
