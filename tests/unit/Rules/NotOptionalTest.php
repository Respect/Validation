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

use stdClass;

/**
 * @group  rule
 * @covers Respect\Validation\Rules\NotOptional
 */
class NotOptionalTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider providerForNotOptional
     */
    public function testShouldValidateWhenNotOptional($input)
    {
        $rule = new NotOptional();

        $this->assertTrue($rule->validate($input));
    }

    /**
     * @dataProvider providerForOptional
     */
    public function testShouldNotValidateWhenOptional($input)
    {
        $rule = new NotOptional();

        $this->assertFalse($rule->validate($input));
    }

    public function providerForNotOptional()
    {
        return [
            [[]],
            [' '],
            [0],
            ['0'],
            [0],
            ['0.0'],
            [false],
            [['']],
            [[' ']],
            [[0]],
            [['0']],
            [[false]],
            [[[''], [0]]],
            [new stdClass()],
        ];
    }

    public function providerForOptional()
    {
        return [
            [null],
            [''],
        ];
    }
}
