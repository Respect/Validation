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
 * @covers \Respect\Validation\Rules\TrueVal
 * @covers \Respect\Validation\Exceptions\TrueValException
 */
class TrueValTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider validTrueProvider
     */
    public function testShouldValidatePatternAccordingToTheDefinedLocale($input)
    {
        $rule = new TrueVal();

        $this->assertTrue($rule->validate($input));
    }

    public function validTrueProvider()
    {
        return [
            [true],
            [1],
            ['1'],
            ['true'],
            ['on'],
            ['yes'],
            ['TRUE'],
            ['ON'],
            ['YES'],
            ['True'],
            ['On'],
            ['Yes'],
        ];
    }

    /**
     * @dataProvider invalidTrueProvider
     */
    public function testShouldNotValidatePatternAccordingToTheDefinedLocale($input)
    {
        $rule = new TrueVal();

        $this->assertFalse($rule->validate($input));
    }

    public function invalidTrueProvider()
    {
        return [
            [false],
            [0],
            [0.5],
            [2],
            ['0'],
            ['false'],
            ['off'],
            ['no'],
            ['truth'],
        ];
    }
}
