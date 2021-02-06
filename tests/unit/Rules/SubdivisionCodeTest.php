<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Exceptions\SubdivisionCodeException;
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
     * @test
     */
    public function shouldThrowsExceptionWhenInvalidFormat(): void
    {
        $this->expectException(ComponentException::class);
        $this->expectExceptionMessage('"whatever" is not a supported country code');

        new SubdivisionCode('whatever');
    }

    /**
     * @test
     */
    public function shouldNotAcceptWrongNamesOnConstructor(): void
    {
        $this->expectException(ComponentException::class);
        $this->expectExceptionMessage('"JK" is not a supported country code');

        new SubdivisionCode('JK');
    }

    /**
     * @return mixed[][]
     */
    public function providerForValidSubdivisionCodeInformation(): array
    {
        return [
            ['BR',  'SP'],
            ['MV',  '00'],
            ['US',  'CA'],
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
            ['AQ',  null],
            ['YT',  ''],
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
     * @test
     */
    public function shouldThrowsSubdivisionCodeException(): void
    {
        $countrySubdivision = new SubdivisionCode('BR');

        $this->expectException(SubdivisionCodeException::class);
        $this->expectExceptionMessage('"CA" must be a subdivision code of "Brazil"');

        $countrySubdivision->assert('CA');
    }
}
