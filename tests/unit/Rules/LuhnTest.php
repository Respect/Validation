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
 * @covers \Respect\Validation\Rules\CreditCard
 */
class LuhnTest extends \PHPUnit_Framework_TestCase
{
    /** @var Luhn */
    private $luhn;

    protected function setUp()
    {
        $this->luhn = new Luhn();
    }

    public function testValidCardNumbers()
    {
        static::assertTrue($this->luhn->validate('2222 4000 4124 0011'));
        static::assertTrue($this->luhn->validate('340-3161-9380-9364'));
        static::assertTrue($this->luhn->validate('6011000990139424'));
        static::assertTrue($this->luhn->validate('2223000048400011\''));
    }

    public function testInvalidCardNumber()
    {
        static::assertFalse($this->luhn->validate('2222 4000 4124 0021'));
        static::assertFalse($this->luhn->validate('340-3161-9380-9334'));
        static::assertFalse($this->luhn->validate('6011000990139421'));
        static::assertFalse($this->luhn->validate('2223000048400010\''));
    }
}
