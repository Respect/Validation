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

use Respect\Validation\Test\TestCase;

/**
 * @group  rule
 * @covers \Respect\Validation\Exceptions\GraphException
 * @covers \Respect\Validation\Rules\AbstractFilterRule
 * @covers \Respect\Validation\Rules\Graph
 *
 * @author Andre Ramaciotti <andre@ramaciotti.com>
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Nick Lombard <github@jigsoft.co.za>
 * @author Pascal Borreli <pascal@borreli.com>
 */
class GraphTest extends TestCase
{
    /**
     * @dataProvider providerForValidGraph
     *
     * @test
     */
    public function validDataWithGraphCharsShouldReturnTrue(string $validGraph): void
    {
        $validator = new Graph();
        self::assertTrue($validator->validate($validGraph));
    }

    /**
     * @dataProvider providerForInvalidGraph
     * @expectedException \Respect\Validation\Exceptions\GraphException
     *
     * @test
     *
     * @param mixed $invalidGraph
     */
    public function invalidGraphShouldFailAndThrowGraphException($invalidGraph): void
    {
        $validator = new Graph();
        self::assertFalse($validator->validate($invalidGraph));
        $validator->assert($invalidGraph);
    }

    /**
     * @dataProvider providerAdditionalChars
     *
     * @test
     */
    public function additionalCharsShouldBeRespected(string $additional, string $input): void
    {
        $validator = new Graph($additional);
        self::assertTrue($validator->validate($input));
    }

    /**
     * @return string[][]
     */
    public function providerAdditionalChars(): array
    {
        return [
            [' ', '!@#$%^&*(){} abc 123'],
            [" \t\n", "[]?+=/\\-_|\"',<>. \t \n abc 123"],
        ];
    }

    /**
     * @return string[][]
     */
    public function providerForValidGraph(): array
    {
        return [
            ['LKA#@%.54'],
            ['foobar'],
            ['16-50'],
            ['123'],
            ['#$%&*_'],
        ];
    }

    /**
     * @return mixed[][]
     */
    public function providerForInvalidGraph(): array
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
