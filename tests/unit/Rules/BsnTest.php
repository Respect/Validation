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

use PHPUnit_Framework_TestCase;

/**
 * @group  rule
 * @covers Respect\Validation\Rules\Bsn
 * @covers Respect\Validation\Exceptions\BsnException
 */
class BsnTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Bsn
     */
    private $rule;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->rule = new Bsn();
    }

    /**
     * @dataProvider providerForBsn
     *
     * @param string $input
     */
    public function testShouldValidateBsn($input)
    {
        $this->assertTrue($this->rule->validate($input));
    }

    /**
     * @dataProvider providerForInvalidBsn
     *
     * @param string $input
     */
    public function testShouldNotValidateBsn($input)
    {
        $this->assertFalse($this->rule->validate($input));
    }

    /**
     * @return array
     */
    public function providerForBsn()
    {
        return [
            ['612890053'],
            ['087880532'],
            ['386625918'],
            ['601608021'],
            ['254650703'],
            ['478063441'],
            ['478063441'],
            ['187368429'],
            ['541777348'],
            ['254283883'],
        ];
    }

    /**
     * @return array
     */
    public function providerForInvalidBsn()
    {
        return [
            ['1234567890'],
            ['0987654321'],
            ['13579024'],
            ['612890054'],
            ['854650703'],
            ['283958721'],
            ['231859081'],
            ['189023323'],
            ['238150912'],
            ['382409678'],
            ['38240.678'],
            ['38240a678'],
            ['abcdefghi'],
        ];
    }
}
