<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators\Core;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Test\TestCase;
use Respect\Validation\Test\Validators\Core\ConcreteFilteredString;

use function implode;

#[Group('core')]
#[CoversClass(FilteredString::class)]
final class FilteredStringTest extends TestCase
{
    #[Test]
    #[DataProvider('providerForNonScalarValues')]
    public function itShouldAlwaysInvalidateNonScalarValues(mixed $input): void
    {
        $validator = new ConcreteFilteredString();

        self::assertInvalidInput($validator, $input);
    }

    #[Test]
    #[DataProvider('providerForEmptyScalarValues')]
    public function itShouldAlwaysInvalidateEmptyStrings(mixed $input): void
    {
        $validator = new ConcreteFilteredString();

        self::assertInvalidInput($validator, $input);
    }

    #[Test]
    #[DataProvider('providerForNonScalarValues')]
    public function itShouldPassStandardTemplateAndEmptyParametersWhenInputIsNonScalar(mixed $input): void
    {
        $validator = new ConcreteFilteredString();
        $result = $validator->evaluate($input);

        self::assertEmpty($result->parameters);
        self::assertEquals(ConcreteFilteredString::TEMPLATE_STANDARD, $result->template);
    }

    #[Test]
    #[DataProvider('providerForEmptyScalarValues')]
    public function itShouldPassStandardTemplateAndEmptyParametersWhenInputIsAnEmptyStrings(mixed $input): void
    {
        $validator = new ConcreteFilteredString();

        self::assertInvalidInput($validator, $input);
    }

    #[Test]
    #[DataProvider('providerForNonScalarValues')]
    public function itShouldPassExtraTemplateAndNonEmptyParametersWhenInputIsNonScalar(mixed $input): void
    {
        $additionalChars = ['a', 'b', 'c'];

        $validator = new ConcreteFilteredString(...$additionalChars);
        $result = $validator->evaluate($input);

        self::assertEquals(['additionalChars' => implode($additionalChars)], $result->parameters);
        self::assertEquals(ConcreteFilteredString::TEMPLATE_EXTRA, $result->template);
    }

    #[Test]
    #[DataProvider('providerForEmptyScalarValues')]
    public function itShouldPassExtraTemplateAndNonEmptyParametersWhenInputIsAnEmptyStrings(mixed $input): void
    {
        $additionalChars = ['a', 'b', 'c'];

        $validator = new ConcreteFilteredString(...$additionalChars);
        $result = $validator->evaluate($input);

        self::assertEquals(['additionalChars' => implode($additionalChars)], $result->parameters);
        self::assertEquals(ConcreteFilteredString::TEMPLATE_EXTRA, $result->template);
    }

    #[Test]
    #[DataProvider('providerForNonEmptyStringTypes')]
    public function itShouldFilterNothingWhenHasNoAdditionalCharacters(string $input): void
    {
        $validator = new ConcreteFilteredString();
        $validator->evaluate($input);

        self::assertSame($input, $validator->lastFilteredInput);
    }

    #[Test]
    public function itShouldAlwaysValidateAllCharactersAreRemovedFromInput(): void
    {
        $input = 'abc';
        $validator = new ConcreteFilteredString($input);

        self::assertValidInput($validator, $input);
    }

    #[Test]
    #[DataProvider('providerForAdditionalCharsAndInput')]
    public function itShouldFilterAdditionalCharactersWhenValidatingInput(
        string $additionalChars,
        string $input,
        string $expectedInput,
    ): void {
        $validator = new ConcreteFilteredString($additionalChars);
        $validator->evaluate($input);

        self::assertSame($expectedInput, $validator->lastFilteredInput);
    }

    /** @return array<array<string>> */
    public static function providerForAdditionalCharsAndInput(): array
    {
        return [
            ['a', 'abc', 'bc'],
            ['b', 'abc', 'ac'],
            ['c', 'abc', 'ab'],
        ];
    }
}
