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

/**
 * @group  rule
 * @covers Respect\Validation\Rules\ScalarVal
 * @covers Respect\Validation\Exceptions\ScalarValException
 */
class ScalarValTest extends TestCase
{
    protected $rule;

    protected function setUp()
    {
        $this->rule = new ScalarVal();
    }

    /**
     * @dataProvider providerForScalar
     */
    public function testShouldValidateScalarNumbers($input)
    {
        $this->assertTrue($this->rule->validate($input));
    }

    /**
     * @dataProvider providerForNonScalar
     */
    public function testShouldNotValidateNonScalarNumbers($input)
    {
        $this->assertFalse($this->rule->validate($input));
    }

    /**
     * @expectedException Respect\Validation\Exceptions\ScalarValException
     * @expectedExceptionMessage null must be a scalar value
     */
    public function testShouldThrowScalarExceptionWhenChecking()
    {
        $this->rule->check(null);
    }

    public function providerForScalar()
    {
        return [
            ['6'],
            ['String'],
            [1.0],
            [42],
            [false],
            [true],
        ];
    }

    public function providerForNonScalar()
    {
        return [
            [[]],
            [function () {
            }],
            [new \stdClass()],
            [null],
            [tmpfile()],
        ];
    }
}
