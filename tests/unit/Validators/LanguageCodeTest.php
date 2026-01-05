<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Exceptions\InvalidRuleConstructorException;
use Respect\Validation\Test\RuleTestCase;

#[Group('validator')]
#[CoversClass(LanguageCode::class)]
final class LanguageCodeTest extends RuleTestCase
{
    #[Test]
    public function itShouldThrowAnExceptionWhenSetIsInvalid(): void
    {
        $this->expectException(InvalidRuleConstructorException::class);
        $this->expectExceptionMessage(
            '"whatever" is not a valid set for ISO 639-3 (Available: "alpha-2" and "alpha-3")',
        );

        // @phpstan-ignore-next-line
        new LanguageCode('whatever');
    }

    /** @return iterable<array{LanguageCode, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $sutAlpha2 = new LanguageCode('alpha-2');
        $sutAlpha3 = new LanguageCode('alpha-3');

        return [
            'alpha-2: en' => [$sutAlpha2, 'en'],
            'alpha-2: it' => [$sutAlpha2, 'it'],
            'alpha-2: la' => [$sutAlpha2, 'la'],
            'alpha-2: pt' => [$sutAlpha2, 'pt'],
            'alpha-3: eng' => [$sutAlpha3, 'eng'],
            'alpha-3: ita' => [$sutAlpha3, 'ita'],
            'alpha-3: lat' => [$sutAlpha3, 'lat'],
            'alpha-3: por' => [$sutAlpha3, 'por'],
        ];
    }

    /** @return iterable<array{LanguageCode, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $sutAlpha2 = new LanguageCode('alpha-2');
        $sutAlpha3 = new LanguageCode('alpha-3');

        return [
            'alpha-2: alpha-3 code' => [$sutAlpha2, 'por'],
            'alpha-2: boolean' => [$sutAlpha2, false],
            'alpha-2: empty array' => [$sutAlpha2, []],
            'alpha-2: empty' => [$sutAlpha2, ''],
            'alpha-2: null' => [$sutAlpha2, null],
            'alpha-3: alpha-2 code' => [$sutAlpha3, 'pt'],
            'alpha-3: boolean' => [$sutAlpha3, true],
            'alpha-3: empty array' => [$sutAlpha3, []],
            'alpha-3: empty' => [$sutAlpha3, ''],
            'alpha-3: null' => [$sutAlpha3, ''],
        ];
    }
}
