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
 * @covers Respect\Validation\Rules\IdentityCard
 * @covers Respect\Validation\Exceptions\IdentityCardException
 */
class IdentityCardTest extends \PHPUnit_Framework_TestCase
{
    protected $identityCardValidator;

    protected function setUp()
    {
        $this->identityCardValidator = new IdentityCard();
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
