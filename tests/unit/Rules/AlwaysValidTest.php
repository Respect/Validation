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
 * @covers \Respect\Validation\Rules\AlwaysValid
 */
class AlwaysValidTest extends \PHPUnit_Framework_TestCase
{
    public function providerForValidAlwaysValid()
    {
        return [
            [0],
            [1],
            ['string'],
            [true],
            [false],
            [null],
            [''],
            [[]],
            [['array_full']],
        ];
    }

    /**
     * @dataProvider providerForValidAlwaysValid
     */
    public function testShouldValidateInputWhenItIsAValidAlwaysValid($input)
    {
        $rule = new AlwaysValid();

        $this->assertTrue($rule->validate($input));
    }
}
