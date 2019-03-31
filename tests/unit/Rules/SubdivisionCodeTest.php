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
 * @covers \Respect\Validation\Exceptions\SubdivisionCodeException
 * @covers \Respect\Validation\Rules\SubdivisionCode
 *
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class SubdivisionCodeTest extends TestCase
{
    /**
     * @expectedException \Respect\Validation\Exceptions\ComponentException
     * @expectedExceptionMessage "whatever" is not a supported country code
     *
     * @test
     */
    public function shouldThrowsExceptionWhenInvalidFormat(): void
    {
        new SubdivisionCode('whatever');
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\ComponentException
     * @expectedExceptionMessage "JK" is not a supported country code
     *
     * @test
     */
    public function shouldNotAcceptWrongNamesOnConstructor(): void
    {
        new SubdivisionCode('JK');
    }

    /**
     * @return mixed[][]
     */
    public function providerForValidSubdivisionCodeInformation(): array
    {
        return [
            ['AQ',  null],
            ['BR',  'SP'],
            ['MV',  '00'],
            ['US',  'CA'],
            ['YT',  ''],
        ];
    }

    /**
     * @dataProvider providerForValidSubdivisionCodeInformation
     *
     * @test
     */
    public function shouldValidateValidSubdivisionCodeInformation(string $countryCode, ?string $input): void
    {
        $countrySubdivision = new SubdivisionCode($countryCode);

        self::assertTrue($countrySubdivision->validate($input));
    }

    /**
     * @return mixed[][]
     */
    public function providerForInvalidSubdivisionCodeInformation(): array
    {
        return [
            ['BR',  'CA'],
            ['MV',  0],
            ['US',  'CE'],
        ];
    }

    /**
     * @dataProvider providerForInvalidSubdivisionCodeInformation
     *
     * @test
     *
     * @param mixed $input
     */
    public function shouldNotValidateInvalidSubdivisionCodeInformation(string $countryCode, $input): void
    {
        $countrySubdivision = new SubdivisionCode($countryCode);

        self::assertFalse($countrySubdivision->validate($input));
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\SubdivisionCodeException
     * @expectedExceptionMessage "CA" must be a subdivision code of "Brazil"
     *
     * @test
     */
    public function shouldThrowsSubdivisionCodeException(): void
    {
        $countrySubdivision = new SubdivisionCode('BR');
        $countrySubdivision->assert('CA');
    }
}
