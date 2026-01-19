<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Gabriel Caruso <carusogabriel34@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: Mehmet Tolga Avcioglu <mehmet@activecom.net>
 * SPDX-FileContributor: Nick Lombard <github@jigsoft.co.za>
 * SPDX-FileContributor: Róbert Nagy <vrnagy@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Test\TestCase;

#[Group('validator')]
#[CoversClass(Domain::class)]
final class DomainTest extends TestCase
{
    #[Test]
    #[DataProvider('providerForDomainWithoutRealTopLevelDomain')]
    public function itShouldValidateDomainsWithoutRealTopLevelDomain(string $input): void
    {
        self::assertValidInput(new Domain(false), $input);
    }

    #[Test]
    #[DataProvider('providerForDomainWithRealTopLevelDomain')]
    public function itShouldValidateDomainsWithRealTopLevelDomain(string $input): void
    {
        self::assertValidInput(new Domain(), $input);
    }

    #[Test]
    #[DataProvider('providerForNonStringTypes')]
    public function itShouldInvalidWhenInputIsNotString(mixed $input): void
    {
        self::assertInvalidInput(new Domain(), $input);
    }

    #[Test]
    #[DataProvider('providerForInvalidDomains')]
    public function itShouldInvalidInvalidDomains(mixed $input): void
    {
        self::assertInvalidInput(new Domain(), $input);
    }

    /** @return array<array{string}> */
    public static function providerForDomainWithoutRealTopLevelDomain(): array
    {
        return [
            ['111111111111domain.local'],
            ['111111111111.domain.local'],
        ];
    }

    /** @return array<array{string}> */
    public static function providerForDomainWithRealTopLevelDomain(): array
    {
        return [
            ['example.com'],
            ['xn--bcher-kva.ch'],
            ['mail.xn--bcher-kva.ch'],
            ['example-hyphen.com'],
            ['example--valid.com'],
            ['std--a.com'],
            ['r--w.com'],
        ];
    }

    /** @return array<array{string}> */
    public static function providerForInvalidDomains(): array
    {
        return [
            [''],
            ['no dots'],
            ['2222222domain.local'],
            ['-example-invalid.com'],
            ['example.invalid.-com'],
            ['xn--bcher--kva.ch'],
            ['example.invalid-.com'],
            ['1.2.3.256'],
            ['1.2.3.4'],
        ];
    }
}
