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
 * @covers Respect\Validation\Rules\Poland
 * @covers Respect\Validation\Exceptions\PeselException
 */
class PolandTest extends PHPUnit_Framework_TestCase
{
    protected $peselValidator;	
    protected $identityCardValidator;

    protected function setUp()
    {
        $this->peselValidator = new Poland('Pesel');
        $this->identityCardValidator = new Poland('IdentityCard');
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
	
    /**
     * @dataProvider providerValidIdentityCard
     */
    public function testIdentityCardShouldValidate($input)
    {
        $this->assertTrue($this->identityCardValidator->validate($input));
    }

    /**
     * @dataProvider providerInvalidIdentityCard
     */
    public function testIdentityCardShouldNotValidate($input)
    {
        $this->assertFalse($this->identityCardValidator->validate($input));
    }

    public function providerValidIdentityCard()
    {
        return [
            ['AYW036733'],
            ['APH505567'],
            ['AFS842339'],
            ['AUF659656'],
            ['AGI096148']
        ];
    }

    public function providerInvalidIdentityCard()
    {
        return [
            ['1'],
            ['ABC'],
            ['XXX036733'],
            ['AYW 036733'],
            ['AGI096141'],
            ['21120209250']
        ];
    }	
}
