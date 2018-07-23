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
 * @covers \Respect\Validation\Exceptions\GraphException
 * @covers \Respect\Validation\Rules\Graph
 */
class GraphTest extends TestCase
{
    /**
     * @dataProvider providerForValidGraph
     *
     * @test
     */
    public function validDataWithGraphCharsShouldReturnTrue($validGraph, $additional = ''): void
    {
        $validator = new Graph($additional);
        self::assertTrue($validator->validate($validGraph));
    }

    /**
     * @dataProvider providerForInvalidGraph
     * @expectedException \Respect\Validation\Exceptions\GraphException
     *
     * @test
     */
    public function invalidGraphShouldFailAndThrowGraphException($invalidGraph, $additional = ''): void
    {
        $validator = new Graph($additional);
        self::assertFalse($validator->validate($invalidGraph));
        $validator->assert($invalidGraph);
    }

    /**
     * @dataProvider providerForInvalidParams
     * @expectedException \Respect\Validation\Exceptions\ComponentException
     *
     * @test
     */
    public function invalidConstructorParamsShouldThrowComponentExceptionUponInstantiation($additional): void
    {
        $validator = new Graph($additional);
    }

    /**
     * @dataProvider providerAdditionalChars
     *
     * @test
     */
    public function additionalCharsShouldBeRespected($additional, $query): void
    {
        $validator = new Graph($additional);
        self::assertTrue($validator->validate($query));
    }

    public function providerAdditionalChars()
    {
        return [
            [' ', '!@#$%^&*(){} abc 123'],
            [" \t\n", "[]?+=/\\-_|\"',<>. \t \n abc 123"],
        ];
    }

    public function providerForInvalidParams()
    {
        return [
            [new \stdClass()],
            [[]],
            [0x2],
        ];
    }

    public function providerForValidGraph()
    {
        return [
            ['LKA#@%.54'],
            ['foobar'],
            ['16-50'],
            ['123'],
            ['#$%&*_'],
        ];
    }

    public function providerForInvalidGraph()
    {
        return [
            [''],
            [null],
            ["foo\nbar"],
            ["foo\tbar"],
            ['foo bar'],
            [' '],
        ];
    }
}
