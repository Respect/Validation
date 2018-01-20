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

use PHPUnit\Framework\TestCase;

/**
 * @group  rule
 * @covers \Respect\Validation\Rules\MacAddress
 * @covers \Respect\Validation\Exceptions\MacAddressException
 */
class MacAddressTest extends TestCase
{
    protected $macaddressValidator;

    protected function setUp(): void
    {
        $this->macaddressValidator = new MacAddress();
    }

    /**
     * @dataProvider providerForMacAddress
     */
    public function testValidMacaddressesShouldReturnTrue($input): void
    {
        self::assertTrue($this->macaddressValidator->__invoke($input));
        self::assertTrue($this->macaddressValidator->assert($input));
        self::assertTrue($this->macaddressValidator->check($input));
    }

    /**
     * @dataProvider providerForNotMacAddress
     * @expectedException \Respect\Validation\Exceptions\MacAddressException
     */
    public function testInvalidMacaddressShouldThrowMacAddressException($input): void
    {
        self::assertFalse($this->macaddressValidator->__invoke($input));
        self::assertFalse($this->macaddressValidator->assert($input));
    }

    public function providerForMacAddress()
    {
        return [
            ['00:11:22:33:44:55'],
            ['66-77-88-99-aa-bb'],
            ['AF:0F:bd:12:44:ba'],
            ['90-bc-d3-1a-dd-cc'],
        ];
    }

    public function providerForNotMacAddress()
    {
        return [
            [''],
            ['00-1122:33:44:55'],
            ['66-77--99-jj-bb'],
            ['HH:0F-bd:12:44:ba'],
            ['90-bc-nk:1a-dd-cc'],
        ];
    }
}
