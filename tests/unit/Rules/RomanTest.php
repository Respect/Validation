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
 * @covers \Respect\Validation\Exceptions\RomanException
 * @covers \Respect\Validation\Rules\Roman
 */
class RomanTest extends TestCase
{
    protected $romanValidator;

    protected function setUp(): void
    {
        $this->romanValidator = new Roman();
    }

    /**
     * @dataProvider providerForRoman
     *
     * @test
     */
    public function validRomansShouldReturnTrue($input): void
    {
        self::assertTrue($this->romanValidator->__invoke($input));
        $this->romanValidator->assert($input);
        $this->romanValidator->check($input);
    }

    /**
     * @dataProvider providerForNotRoman
     * @expectedException \Respect\Validation\Exceptions\RomanException
     *
     * @test
     */
    public function invalidRomansShouldThrowRomanException($input): void
    {
        self::assertFalse($this->romanValidator->__invoke($input));
        $this->romanValidator->assert($input);
    }

    public function providerForRoman()
    {
        return [
            [''],
            ['III'],
            ['IV'],
            ['VI'],
            ['XIX'],
            ['XLII'],
            ['LXII'],
            ['CXLIX'],
            ['CLIII'],
            ['MCCXXXIV'],
            ['MMXXIV'],
            ['MCMLXXV'],
            ['MMMMCMXCIX'],
        ];
    }

    public function providerForNotRoman()
    {
        return [
            [' '],
            ['IIII'],
            ['IVVVX'],
            ['CCDC'],
            ['MXM'],
            ['XIIIIIIII'],
            ['MIMIMI'],
        ];
    }
}
