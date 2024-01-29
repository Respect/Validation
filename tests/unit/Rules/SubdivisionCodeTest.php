<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Test\TestCase;

#[Group('rule')]
#[CoversClass(SubdivisionCode::class)]
final class SubdivisionCodeTest extends TestCase
{
    #[Test]
    public function shouldThrowsExceptionWhenInvalidFormat(): void
    {
        $this->expectException(ComponentException::class);
        $this->expectExceptionMessage('"whatever" is not a supported country code');

        new SubdivisionCode('whatever');
    }

    #[Test]
    public function shouldNotAcceptWrongNamesOnConstructor(): void
    {
        $this->expectException(ComponentException::class);
        $this->expectExceptionMessage('"JK" is not a supported country code');

        new SubdivisionCode('JK');
    }

    #[Test]
    #[DataProvider('providerForValidSubdivisionCodeInformation')]
    public function shouldValidateValidSubdivisionCodeInformation(string $countryCode, ?string $input): void
    {
        $countrySubdivision = new SubdivisionCode($countryCode);

        self::assertTrue($countrySubdivision->validate($input));
    }

    #[Test]
    #[DataProvider('providerForInvalidSubdivisionCodeInformation')]
    public function shouldNotValidateInvalidSubdivisionCodeInformation(string $countryCode, mixed $input): void
    {
        $countrySubdivision = new SubdivisionCode($countryCode);

        self::assertFalse($countrySubdivision->validate($input));
    }

    #[Test]
    public function shouldThrowsValidationException(): void
    {
        $countrySubdivision = new SubdivisionCode('BR');

        $this->expectException(ValidationException::class);
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
