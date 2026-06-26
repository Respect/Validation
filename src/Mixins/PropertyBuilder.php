<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Mixins;

use DateTimeImmutable;
use Respect\StringFormatter\Formatter;
use Respect\Validation\Validator;

interface PropertyBuilder
{
    /** @return Chain<object> */
    public static function propertyAfter(string $propertyName, callable $callable, Validator $validator): Chain;

    /** @return Chain<object> */
    public static function propertyAll(string $propertyName, Validator $validator): Chain;

    /** @return Chain<object> */
    public static function propertyAllOf(string $propertyName, Validator $validator1, Validator $validator2, Validator ...$validators): Chain;

    /** @return Chain<object> */
    public static function propertyAlnum(string $propertyName, string ...$additionalChars): Chain;

    /** @return Chain<object> */
    public static function propertyAlpha(string $propertyName, string ...$additionalChars): Chain;

    /** @return Chain<object> */
    public static function propertyAlwaysInvalid(string $propertyName): Chain;

    /** @return Chain<object> */
    public static function propertyAlwaysValid(string $propertyName): Chain;

    /** @return Chain<object> */
    public static function propertyAnyOf(string $propertyName, Validator $validator1, Validator $validator2, Validator ...$validators): Chain;

    /** @return Chain<object> */
    public static function propertyArrayType(string $propertyName): Chain;

    /** @return Chain<object> */
    public static function propertyArrayVal(string $propertyName): Chain;

    /** @return Chain<object> */
    public static function propertyBase(string $propertyName, int $base, string $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'): Chain;

    /** @return Chain<object> */
    public static function propertyBase64(string $propertyName): Chain;

    /** @return Chain<object> */
    public static function propertyBetween(string $propertyName, mixed $minValue, mixed $maxValue): Chain;

    /** @return Chain<object> */
    public static function propertyBetweenExclusive(string $propertyName, mixed $minimum, mixed $maximum): Chain;

    /** @return Chain<object> */
    public static function propertyBlank(string $propertyName): Chain;

    /** @return Chain<object> */
    public static function propertyBoolType(string $propertyName): Chain;

    /** @return Chain<object> */
    public static function propertyBoolVal(string $propertyName): Chain;

    /** @return Chain<object> */
    public static function propertyBsn(string $propertyName): Chain;

    /** @return Chain<object> */
    public static function propertyCallableType(string $propertyName): Chain;

    /** @return Chain<object> */
    public static function propertyCharset(string $propertyName, string $charset, string ...$charsets): Chain;

    /** @return Chain<object> */
    public static function propertyCnh(string $propertyName): Chain;

    /** @return Chain<object> */
    public static function propertyCnpj(string $propertyName): Chain;

    /** @return Chain<object> */
    public static function propertyConsonant(string $propertyName, string ...$additionalChars): Chain;

    /** @return Chain<object> */
    public static function propertyContains(string $propertyName, mixed $containsValue): Chain;

    /**
     * @param non-empty-array<mixed> $needles
     * @return Chain<object>
     */
    public static function propertyContainsAny(string $propertyName, array $needles): Chain;

    /** @return Chain<object> */
    public static function propertyContainsCount(string $propertyName, mixed $containsValue, int $count): Chain;

    /** @return Chain<object> */
    public static function propertyControl(string $propertyName, string ...$additionalChars): Chain;

    /** @return Chain<object> */
    public static function propertyCountable(string $propertyName): Chain;

    /**
     * @param "alpha-2"|"alpha-3"|"numeric" $set
     * @return Chain<object>
     */
    public static function propertyCountryCode(string $propertyName, string $set = 'alpha-2'): Chain;

    /** @return Chain<object> */
    public static function propertyCpf(string $propertyName): Chain;

    /** @return Chain<object> */
    public static function propertyCreditCard(string $propertyName, string $brand = 'Any'): Chain;

    /**
     * @param "alpha-3"|"numeric" $set
     * @return Chain<object>
     */
    public static function propertyCurrencyCode(string $propertyName, string $set = 'alpha-3'): Chain;

    /** @return Chain<object> */
    public static function propertyDate(string $propertyName, string $format = 'Y-m-d'): Chain;

    /** @return Chain<object> */
    public static function propertyDateTime(string $propertyName, string|null $format = null): Chain;

    /**
     * @param "years"|"months"|"days"|"hours"|"minutes"|"seconds"|"microseconds" $type
     * @return Chain<object>
     */
    public static function propertyDateTimeDiff(string $propertyName, string $type, Validator $validator, string|null $format = null, DateTimeImmutable|null $now = null): Chain;

    /** @return Chain<object> */
    public static function propertyDecimal(string $propertyName, int $decimals): Chain;

    /** @return Chain<object> */
    public static function propertyDigit(string $propertyName, string ...$additionalChars): Chain;

    /** @return Chain<object> */
    public static function propertyDirectory(string $propertyName): Chain;

    /** @return Chain<object> */
    public static function propertyDomain(string $propertyName, bool $tldCheck = true): Chain;

    /** @return Chain<object> */
    public static function propertyEach(string $propertyName, Validator $validator): Chain;

    /** @return Chain<object> */
    public static function propertyEachKey(string $propertyName, Validator $validator): Chain;

    /** @return Chain<object> */
    public static function propertyEmail(string $propertyName): Chain;

    /** @return Chain<object> */
    public static function propertyEmoji(string $propertyName): Chain;

    /** @return Chain<object> */
    public static function propertyEndsWith(string $propertyName, mixed $endValue, mixed ...$endValues): Chain;

    /** @return Chain<object> */
    public static function propertyEquals(string $propertyName, mixed $compareTo): Chain;

    /** @return Chain<object> */
    public static function propertyEquivalent(string $propertyName, mixed $compareTo): Chain;

    /** @return Chain<object> */
    public static function propertyEven(string $propertyName): Chain;

    /** @return Chain<object> */
    public static function propertyExecutable(string $propertyName): Chain;

    /** @return Chain<object> */
    public static function propertyExtension(string $propertyName, string $extension): Chain;

    /** @return Chain<object> */
    public static function propertyFactor(string $propertyName, int $dividend): Chain;

    /**
     * @param callable(mixed): Validator $factory
     * @return Chain<object>
     */
    public static function propertyFactory(string $propertyName, callable $factory): Chain;

    /** @return Chain<object> */
    public static function propertyFalseVal(string $propertyName): Chain;

    /** @return Chain<object> */
    public static function propertyFalsy(string $propertyName): Chain;

    /** @return Chain<object> */
    public static function propertyFile(string $propertyName): Chain;

    /** @return Chain<object> */
    public static function propertyFinite(string $propertyName): Chain;

    /** @return Chain<object> */
    public static function propertyFloatType(string $propertyName): Chain;

    /** @return Chain<object> */
    public static function propertyFloatVal(string $propertyName): Chain;

    /** @return Chain<object> */
    public static function propertyFormat(string $propertyName, Formatter $formatter): Chain;

    /** @return Chain<object> */
    public static function propertyGiven(string $propertyName, Validator $when, Validator $then): Chain;

    /** @return Chain<object> */
    public static function propertyGraph(string $propertyName, string ...$additionalChars): Chain;

    /** @return Chain<object> */
    public static function propertyGreaterThan(string $propertyName, mixed $compareTo): Chain;

    /** @return Chain<object> */
    public static function propertyGreaterThanOrEqual(string $propertyName, mixed $compareTo): Chain;

    /** @return Chain<object> */
    public static function propertyHetu(string $propertyName): Chain;

    /** @return Chain<object> */
    public static function propertyHexRgbColor(string $propertyName): Chain;

    /** @return Chain<object> */
    public static function propertyIban(string $propertyName): Chain;

    /** @return Chain<object> */
    public static function propertyIdentical(string $propertyName, mixed $compareTo): Chain;

    /** @return Chain<object> */
    public static function propertyImage(string $propertyName): Chain;

    /** @return Chain<object> */
    public static function propertyImei(string $propertyName): Chain;

    /** @return Chain<object> */
    public static function propertyIn(string $propertyName, mixed $haystack): Chain;

    /** @return Chain<object> */
    public static function propertyInfinite(string $propertyName): Chain;

    /**
     * @param class-string $class
     * @return Chain<object>
     */
    public static function propertyInstance(string $propertyName, string $class): Chain;

    /** @return Chain<object> */
    public static function propertyIntType(string $propertyName): Chain;

    /** @return Chain<object> */
    public static function propertyIntVal(string $propertyName): Chain;

    /** @return Chain<object> */
    public static function propertyIp(string $propertyName, string $range = '*', int|null $options = null): Chain;

    /** @return Chain<object> */
    public static function propertyIsbn(string $propertyName): Chain;

    /** @return Chain<object> */
    public static function propertyIterableType(string $propertyName): Chain;

    /** @return Chain<object> */
    public static function propertyIterableVal(string $propertyName): Chain;

    /** @return Chain<object> */
    public static function propertyJson(string $propertyName): Chain;

    /**
     * @param "alpha-2"|"alpha-3" $set
     * @return Chain<object>
     */
    public static function propertyLanguageCode(string $propertyName, string $set = 'alpha-2'): Chain;

    /** @return Chain<object> */
    public static function propertyLeapDate(string $propertyName, string $format): Chain;

    /** @return Chain<object> */
    public static function propertyLeapYear(string $propertyName): Chain;

    /** @return Chain<object> */
    public static function propertyLength(string $propertyName, Validator $validator): Chain;

    /** @return Chain<object> */
    public static function propertyLessThan(string $propertyName, mixed $compareTo): Chain;

    /** @return Chain<object> */
    public static function propertyLessThanOrEqual(string $propertyName, mixed $compareTo): Chain;

    /** @return Chain<object> */
    public static function propertyLowercase(string $propertyName): Chain;

    /** @return Chain<object> */
    public static function propertyLuhn(string $propertyName): Chain;

    /** @return Chain<object> */
    public static function propertyMacAddress(string $propertyName): Chain;

    /** @return Chain<object> */
    public static function propertyMax(string $propertyName, Validator $validator): Chain;

    /** @return Chain<object> */
    public static function propertyMimetype(string $propertyName, string $mimetype): Chain;

    /** @return Chain<object> */
    public static function propertyMin(string $propertyName, Validator $validator): Chain;

    /** @return Chain<object> */
    public static function propertyMultiple(string $propertyName, int $multipleOf): Chain;

    /** @return Chain<object> */
    public static function propertyNegative(string $propertyName): Chain;

    /** @return Chain<object> */
    public static function propertyNfeAccessKey(string $propertyName): Chain;

    /** @return Chain<object> */
    public static function propertyNif(string $propertyName): Chain;

    /** @return Chain<object> */
    public static function propertyNip(string $propertyName): Chain;

    /** @return Chain<object> */
    public static function propertyNoneOf(string $propertyName, Validator $validator1, Validator $validator2, Validator ...$validators): Chain;

    /** @return Chain<object> */
    public static function propertyNot(string $propertyName, Validator $validator): Chain;

    /** @return Chain<object> */
    public static function propertyNullType(string $propertyName): Chain;

    /** @return Chain<object> */
    public static function propertyNumber(string $propertyName): Chain;

    /** @return Chain<object> */
    public static function propertyNumericVal(string $propertyName): Chain;

    /** @return Chain<object> */
    public static function propertyObjectType(string $propertyName): Chain;

    /** @return Chain<object> */
    public static function propertyOdd(string $propertyName): Chain;

    /** @return Chain<object> */
    public static function propertyOneOf(string $propertyName, Validator $validator1, Validator $validator2, Validator ...$validators): Chain;

    /** @return Chain<object> */
    public static function propertyPesel(string $propertyName): Chain;

    /** @return Chain<object> */
    public static function propertyPhone(string $propertyName, string|null $countryCode = null): Chain;

    /** @return Chain<object> */
    public static function propertyPis(string $propertyName): Chain;

    /** @return Chain<object> */
    public static function propertyPolishIdCard(string $propertyName): Chain;

    /** @return Chain<object> */
    public static function propertyPortugueseNif(string $propertyName): Chain;

    /** @return Chain<object> */
    public static function propertyPositive(string $propertyName): Chain;

    /** @return Chain<object> */
    public static function propertyPostalCode(string $propertyName, string $countryCode, bool $formatted = false): Chain;

    /** @return Chain<object> */
    public static function propertyPrintable(string $propertyName, string ...$additionalChars): Chain;

    /** @return Chain<object> */
    public static function propertyPublicDomainSuffix(string $propertyName): Chain;

    /** @return Chain<object> */
    public static function propertyPunct(string $propertyName, string ...$additionalChars): Chain;

    /** @return Chain<object> */
    public static function propertyReadable(string $propertyName): Chain;

    /** @return Chain<object> */
    public static function propertyRegex(string $propertyName, string $regex): Chain;

    /** @return Chain<object> */
    public static function propertyResourceType(string $propertyName): Chain;

    /** @return Chain<object> */
    public static function propertyRoman(string $propertyName): Chain;

    /** @return Chain<object> */
    public static function propertySatisfies(string $propertyName, callable $callback, mixed ...$arguments): Chain;

    /** @return Chain<object> */
    public static function propertyScalarVal(string $propertyName): Chain;

    /** @return Chain<object> */
    public static function propertyShortCircuit(string $propertyName, Validator ...$validators): Chain;

    /**
     * @param "B"|"KB"|"MB"|"GB"|"TB"|"PB"|"EB"|"ZB"|"YB" $unit
     * @return Chain<object>
     */
    public static function propertySize(string $propertyName, string $unit, Validator $validator): Chain;

    /** @return Chain<object> */
    public static function propertySlug(string $propertyName): Chain;

    /** @return Chain<object> */
    public static function propertySorted(string $propertyName, string $direction): Chain;

    /** @return Chain<object> */
    public static function propertySpace(string $propertyName, string ...$additionalChars): Chain;

    /** @return Chain<object> */
    public static function propertySpaced(string $propertyName): Chain;

    /** @return Chain<object> */
    public static function propertyStartsWith(string $propertyName, mixed $startValue, mixed ...$startValues): Chain;

    /** @return Chain<object> */
    public static function propertyStringType(string $propertyName): Chain;

    /** @return Chain<object> */
    public static function propertyStringVal(string $propertyName): Chain;

    /** @return Chain<object> */
    public static function propertySubdivisionCode(string $propertyName, string $countryCode): Chain;

    /**
     * @param mixed[] $superset
     * @return Chain<object>
     */
    public static function propertySubset(string $propertyName, array $superset): Chain;

    /** @return Chain<object> */
    public static function propertySymbolicLink(string $propertyName): Chain;

    /** @return Chain<object> */
    public static function propertyTime(string $propertyName, string $format = 'H:i:s'): Chain;

    /** @return Chain<object> */
    public static function propertyTld(string $propertyName): Chain;

    /** @return Chain<object> */
    public static function propertyTrimmed(string $propertyName, string ...$trimValues): Chain;

    /** @return Chain<object> */
    public static function propertyTrueVal(string $propertyName): Chain;

    /** @return Chain<object> */
    public static function propertyUndef(string $propertyName): Chain;

    /** @return Chain<object> */
    public static function propertyUnique(string $propertyName): Chain;

    /** @return Chain<object> */
    public static function propertyUppercase(string $propertyName): Chain;

    /** @return Chain<object> */
    public static function propertyUrl(string $propertyName): Chain;

    /** @return Chain<object> */
    public static function propertyUuid(string $propertyName, int|null $version = null): Chain;

    /** @return Chain<object> */
    public static function propertyVersion(string $propertyName): Chain;

    /** @return Chain<object> */
    public static function propertyVowel(string $propertyName, string ...$additionalChars): Chain;

    /** @return Chain<object> */
    public static function propertyWhen(string $propertyName, Validator $when, Validator $then, Validator|null $else = null): Chain;

    /** @return Chain<object> */
    public static function propertyWritable(string $propertyName): Chain;

    /** @return Chain<object> */
    public static function propertyXdigit(string $propertyName, string ...$additionalChars): Chain;
}
