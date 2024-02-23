<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Exceptions\InvalidRuleConstructorException;
use Respect\Validation\Test\RuleTestCase;

#[Group('rule')]
#[CoversClass(CountryCode::class)]
final class CountryCodeTest extends RuleTestCase
{
    #[Test]
    public function itShouldThrowsExceptionWhenInvalidFormat(): void
    {
        $this->expectException(InvalidRuleConstructorException::class);
        $this->expectExceptionMessage(
            '"whatever" is not a valid set for ISO 3166-1 (Available: `["alpha-2", "alpha-3", "numeric"]`)'
        );

        // @phpstan-ignore-next-line
        new CountryCode('whatever');
    }

    /** @return iterable<array{CountryCode, mixed}> */
    public static function providerForValidInput(): iterable
    {
        return [
            [new CountryCode('alpha-2'),  'BR'],
            [new CountryCode('alpha-3'),  'BRA'],
            [new CountryCode('numeric'), '076'],
            [new CountryCode('alpha-2'),  'DE'],
            [new CountryCode('alpha-3'),  'DEU'],
            [new CountryCode('numeric'), '276'],
            [new CountryCode('alpha-2'),  'US'],
            [new CountryCode('alpha-3'),  'USA'],
            [new CountryCode('numeric'), '840'],
        ];
    }

    /** @return iterable<array{CountryCode, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        return [
            [new CountryCode(), []],
            [new CountryCode(), 'ca'],
            [new CountryCode('alpha-2'),  'USA'],
            [new CountryCode('alpha-3'),  'US'],
            [new CountryCode('numeric'), '000'],
        ];
    }
}
