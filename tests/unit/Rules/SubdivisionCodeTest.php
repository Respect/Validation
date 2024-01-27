<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
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
     * @expectedException \Respect\Validation\Exceptions\ComponentException
     * @expectedExceptionMessage "whatever" is not a supported country code
     *
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

    /**
     * @return mixed[][]
     */
    public static function providerForValidSubdivisionCodeInformation(): array
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
     * @return mixed[][]
     */
    public static function providerForInvalidSubdivisionCodeInformation(): array
    {
        return [
            ['BR',  'CA'],
            ['MV',  0],
            ['US',  'CE'],
        ];
    }
}
