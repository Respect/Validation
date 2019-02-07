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

use Respect\Validation\Test\TestCase;

/**
 * @group  rule
 * @covers \Respect\Validation\Exceptions\RomanException
 * @covers \Respect\Validation\Rules\Roman
 *
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Jean Pimentel <jeanfap@gmail.com>
 */
class RomanTest extends TestCase
{
    /**
     * @var Roman
     */
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
    public function validRomansShouldReturnTrue(string $input): void
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
    public function invalidRomansShouldThrowRomanException(string $input): void
    {
        self::assertFalse($this->romanValidator->__invoke($input));
        $this->romanValidator->assert($input);
    }

    /**
     * @return string[][]
     */
    public function providerForRoman(): array
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

    /**
     * @return string[][]
     */
    public function providerForNotRoman(): array
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
