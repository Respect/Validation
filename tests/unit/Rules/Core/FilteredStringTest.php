<?php

declare(strict_types=1);

namespace Respect\Validation\Rules\Core;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Test\Rules\Core\ConcreteFilteredString;
use Respect\Validation\Test\TestCase;

use function implode;

#[Group('core')]
#[CoversClass(FilteredString::class)]
final class FilteredStringTest extends TestCase
{
    #[Test]
    #[DataProvider('providerForNonScalarValues')]
    public function itShouldAlwaysInvalidateNonScalarValues(mixed $input): void
    {
        $rule = new ConcreteFilteredString();

        self::assertInvalidInput($rule, $input);
    }

    #[Test]
    #[DataProvider('providerForEmptyScalarValues')]
    public function itShouldAlwaysInvalidateEmptyStrings(mixed $input): void
    {
        $rule = new ConcreteFilteredString();

        self::assertInvalidInput($rule, $input);
    }

    #[Test]
    #[DataProvider('providerForNonScalarValues')]
    public function itShouldPassStandardTemplateAndEmptyParametersWhenInputIsNonScalar(mixed $input): void
    {
        $rule = new ConcreteFilteredString();
        $result = $rule->evaluate($input);

        self::assertEmpty($result->parameters);
        self::assertEquals(ConcreteFilteredString::TEMPLATE_STANDARD, $result->template);
    }

    #[Test]
    #[DataProvider('providerForEmptyScalarValues')]
    public function itShouldPassStandardTemplateAndEmptyParametersWhenInputIsAnEmptyStrings(mixed $input): void
    {
        $rule = new ConcreteFilteredString();

        self::assertInvalidInput($rule, $input);
    }

    #[Test]
    #[DataProvider('providerForNonScalarValues')]
    public function itShouldPassExtraTemplateAndNonEmptyParametersWhenInputIsNonScalar(mixed $input): void
    {
        $additionalChars = ['a', 'b', 'c'];

        $rule = new ConcreteFilteredString(...$additionalChars);
        $result = $rule->evaluate($input);

        self::assertEquals(['additionalChars' => implode($additionalChars)], $result->parameters);
        self::assertEquals(ConcreteFilteredString::TEMPLATE_EXTRA, $result->template);
    }

    #[Test]
    #[DataProvider('providerForEmptyScalarValues')]
    public function itShouldPassExtraTemplateAndNonEmptyParametersWhenInputIsAnEmptyStrings(mixed $input): void
    {
        $additionalChars = ['a', 'b', 'c'];

        $rule = new ConcreteFilteredString(...$additionalChars);
        $result = $rule->evaluate($input);

        self::assertEquals(['additionalChars' => implode($additionalChars)], $result->parameters);
        self::assertEquals(ConcreteFilteredString::TEMPLATE_EXTRA, $result->template);
    }

    #[Test]
    #[DataProvider('providerForNonEmptyStringTypes')]
    public function itShouldFilterNothingWhenHasNoAdditionalCharacters(string $input): void
    {
        $rule = new ConcreteFilteredString();
        $rule->evaluate($input);

        self::assertSame($input, $rule->lastFilteredInput);
    }

    #[Test]
    public function itShouldAlwaysValidateAllCharactersAreRemovedFromInput(): void
    {
        $input = 'abc';
        $rule = new ConcreteFilteredString($input);

        self::assertValidInput($rule, $input);
    }

    #[Test]
    #[DataProvider('providerForAdditionalCharsAndInput')]
    public function itShouldFilterAdditionalCharactersWhenValidatingInput(
        string $additionalChars,
        string $input,
        string $expectedInput,
    ): void {
        $rule = new ConcreteFilteredString($additionalChars);
        $rule->evaluate($input);

        self::assertSame($expectedInput, $rule->lastFilteredInput);
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
