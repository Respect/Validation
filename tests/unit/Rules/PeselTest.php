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
 * @covers Respect\Validation\Rules\Pesel
 * @covers Respect\Validation\Exceptions\PeselException
 */
class PeselTest extends \PHPUnit_Framework_TestCase
{
    protected $peselValidator;

    protected function setUp()
    {
        $this->peselValidator = new Pesel();
    }

    /**
     * @dataProvider providerValidPesel
     */
    public function testPeselShouldValidate($input)
    {
        $this->assertTrue($this->peselValidator->validate($input));
    }

    /**
     * @dataProvider providerInvalidPesel
     */
    public function testPeselShouldNotValidate($input)
    {
        $this->assertFalse($this->peselValidator->validate($input));
    }

    public function providerValidPesel()
    {
        return [
            ['49040501580'],
            ['39012110375'],
            ['50083014540'],
            ['69090515504'],
            ['21120209256']
        ];
    }

    public function providerInvalidPesel()
    {
        return [
            ['1'],
            ['22'],
            ['PESEL'],
            ['PESEL123456'],
            ['21120209251'],
            ['21120209250'],
        ];
    }
}
