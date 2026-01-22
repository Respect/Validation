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
use Respect\Validation\Validator;

interface PropertyBuilder
{
    public static function propertyAll(string $propertyName, Validator $validator): Chain;

    public static function propertyAllOf(
        string $propertyName,
        Validator $validator1,
        Validator $validator2,
        Validator ...$validators,
    ): Chain;

    public static function propertyAlnum(string $propertyName, string ...$additionalChars): Chain;

    public static function propertyAlpha(string $propertyName, string ...$additionalChars): Chain;

    public static function propertyAlwaysInvalid(string $propertyName): Chain;

    public static function propertyAlwaysValid(string $propertyName): Chain;

    public static function propertyAnyOf(
        string $propertyName,
        Validator $validator1,
        Validator $validator2,
        Validator ...$validators,
    ): Chain;

    public static function propertyArrayType(string $propertyName): Chain;

    public static function propertyArrayVal(string $propertyName): Chain;

    public static function propertyBase(
        string $propertyName,
        int $base,
        string $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
    ): Chain;

    public static function propertyBase64(string $propertyName): Chain;

    public static function propertyBetween(string $propertyName, mixed $minValue, mixed $maxValue): Chain;

    public static function propertyBetweenExclusive(string $propertyName, mixed $minimum, mixed $maximum): Chain;

    public static function propertyBlank(string $propertyName): Chain;

    public static function propertyBoolType(string $propertyName): Chain;

    public static function propertyBoolVal(string $propertyName): Chain;

    public static function propertyBsn(string $propertyName): Chain;

    public static function propertyCall(string $propertyName, callable $callable, Validator $validator): Chain;

    public static function propertyCallableType(string $propertyName): Chain;

    public static function propertyCallback(string $propertyName, callable $callback, mixed ...$arguments): Chain;

    public static function propertyCharset(string $propertyName, string $charset, string ...$charsets): Chain;

    public static function propertyCircuit(
        string $propertyName,
        Validator $validator1,
        Validator $validator2,
        Validator ...$validators,
    ): Chain;

    public static function propertyCnh(string $propertyName): Chain;

    public static function propertyCnpj(string $propertyName): Chain;

    public static function propertyConsonant(string $propertyName, string ...$additionalChars): Chain;

    public static function propertyContains(
        string $propertyName,
        mixed $containsValue,
        bool $identical = false,
    ): Chain;

    /** @param non-empty-array<mixed> $needles */
    public static function propertyContainsAny(string $propertyName, array $needles, bool $identical = false): Chain;

    public static function propertyContainsCount(
        string $propertyName,
        mixed $containsValue,
        int $count,
        bool $identical = false,
    ): Chain;

    public static function propertyControl(string $propertyName, string ...$additionalChars): Chain;

    public static function propertyCountable(string $propertyName): Chain;

    /** @param "alpha-2"|"alpha-3"|"numeric" $set */
    public static function propertyCountryCode(string $propertyName, string $set = 'alpha-2'): Chain;

    public static function propertyCpf(string $propertyName): Chain;

    public static function propertyCreditCard(string $propertyName, string $brand = 'Any'): Chain;

    /** @param "alpha-3"|"numeric" $set */
    public static function propertyCurrencyCode(string $propertyName, string $set = 'alpha-3'): Chain;

    public static function propertyDate(string $propertyName, string $format = 'Y-m-d'): Chain;

    public static function propertyDateTime(string $propertyName, string|null $format = null): Chain;

    /** @param "years"|"months"|"days"|"hours"|"minutes"|"seconds"|"microseconds" $type */
    public static function propertyDateTimeDiff(
        string $propertyName,
        string $type,
        Validator $validator,
        string|null $format = null,
        DateTimeImmutable|null $now = null,
    ): Chain;

    public static function propertyDecimal(string $propertyName, int $decimals): Chain;

    public static function propertyDigit(string $propertyName, string ...$additionalChars): Chain;

    public static function propertyDirectory(string $propertyName): Chain;

    public static function propertyDomain(string $propertyName, bool $tldCheck = true): Chain;

    public static function propertyEach(string $propertyName, Validator $validator): Chain;

    public static function propertyEmail(string $propertyName): Chain;

    public static function propertyEmoji(string $propertyName): Chain;

    public static function propertyEndsWith(string $propertyName, mixed $endValue, bool $identical = false): Chain;

    public static function propertyEquals(string $propertyName, mixed $compareTo): Chain;

    public static function propertyEquivalent(string $propertyName, mixed $compareTo): Chain;

    public static function propertyEven(string $propertyName): Chain;

    public static function propertyExecutable(string $propertyName): Chain;

    public static function propertyExtension(string $propertyName, string $extension): Chain;

    public static function propertyFactor(string $propertyName, int $dividend): Chain;

    public static function propertyFalseVal(string $propertyName): Chain;

    public static function propertyFalsy(string $propertyName): Chain;

    public static function propertyFibonacci(string $propertyName): Chain;

    public static function propertyFile(string $propertyName): Chain;

    public static function propertyFilterVar(string $propertyName, int $filter, mixed $options = null): Chain;

    public static function propertyFinite(string $propertyName): Chain;

    public static function propertyFloatType(string $propertyName): Chain;

    public static function propertyFloatVal(string $propertyName): Chain;

    public static function propertyGraph(string $propertyName, string ...$additionalChars): Chain;

    public static function propertyGreaterThan(string $propertyName, mixed $compareTo): Chain;

    public static function propertyGreaterThanOrEqual(string $propertyName, mixed $compareTo): Chain;

    public static function propertyHetu(string $propertyName): Chain;

    public static function propertyHexRgbColor(string $propertyName): Chain;

    public static function propertyIban(string $propertyName): Chain;

    public static function propertyIdentical(string $propertyName, mixed $compareTo): Chain;

    public static function propertyImage(string $propertyName): Chain;

    public static function propertyImei(string $propertyName): Chain;

    public static function propertyIn(string $propertyName, mixed $haystack, bool $compareIdentical = false): Chain;

    public static function propertyInfinite(string $propertyName): Chain;

    /** @param class-string $class */
    public static function propertyInstance(string $propertyName, string $class): Chain;

    public static function propertyIntType(string $propertyName): Chain;

    public static function propertyIntVal(string $propertyName): Chain;

    public static function propertyIp(string $propertyName, string $range = '*', int|null $options = null): Chain;

    public static function propertyIsbn(string $propertyName): Chain;

    public static function propertyIterableType(string $propertyName): Chain;

    public static function propertyIterableVal(string $propertyName): Chain;

    public static function propertyJson(string $propertyName): Chain;

    /** @param "alpha-2"|"alpha-3" $set */
    public static function propertyLanguageCode(string $propertyName, string $set = 'alpha-2'): Chain;

    /** @param callable(mixed): Validator $validatorCreator */
    public static function propertyLazy(string $propertyName, callable $validatorCreator): Chain;

    public static function propertyLeapDate(string $propertyName, string $format): Chain;

    public static function propertyLeapYear(string $propertyName): Chain;

    public static function propertyLength(string $propertyName, Validator $validator): Chain;

    public static function propertyLessThan(string $propertyName, mixed $compareTo): Chain;

    public static function propertyLessThanOrEqual(string $propertyName, mixed $compareTo): Chain;

    public static function propertyLowercase(string $propertyName): Chain;

    public static function propertyLuhn(string $propertyName): Chain;

    public static function propertyMacAddress(string $propertyName): Chain;

    public static function propertyMax(string $propertyName, Validator $validator): Chain;

    public static function propertyMimetype(string $propertyName, string $mimetype): Chain;

    public static function propertyMin(string $propertyName, Validator $validator): Chain;

    public static function propertyMultiple(string $propertyName, int $multipleOf): Chain;

    public static function propertyNegative(string $propertyName): Chain;

    public static function propertyNfeAccessKey(string $propertyName): Chain;

    public static function propertyNif(string $propertyName): Chain;

    public static function propertyNip(string $propertyName): Chain;

    public static function propertyNoneOf(
        string $propertyName,
        Validator $validator1,
        Validator $validator2,
        Validator ...$validators,
    ): Chain;

    public static function propertyNot(string $propertyName, Validator $validator): Chain;

    public static function propertyNullType(string $propertyName): Chain;

    public static function propertyNumber(string $propertyName): Chain;

    public static function propertyNumericVal(string $propertyName): Chain;

    public static function propertyObjectType(string $propertyName): Chain;

    public static function propertyOdd(string $propertyName): Chain;

    public static function propertyOneOf(
        string $propertyName,
        Validator $validator1,
        Validator $validator2,
        Validator ...$validators,
    ): Chain;

    public static function propertyPerfectSquare(string $propertyName): Chain;

    public static function propertyPesel(string $propertyName): Chain;

    public static function propertyPhone(string $propertyName, string|null $countryCode = null): Chain;

    public static function propertyPhpLabel(string $propertyName): Chain;

    public static function propertyPis(string $propertyName): Chain;

    public static function propertyPolishIdCard(string $propertyName): Chain;

    public static function propertyPortugueseNif(string $propertyName): Chain;

    public static function propertyPositive(string $propertyName): Chain;

    public static function propertyPostalCode(
        string $propertyName,
        string $countryCode,
        bool $formatted = false,
    ): Chain;

    public static function propertyPrimeNumber(string $propertyName): Chain;

    public static function propertyPrintable(string $propertyName, string ...$additionalChars): Chain;

    public static function propertyPublicDomainSuffix(string $propertyName): Chain;

    public static function propertyPunct(string $propertyName, string ...$additionalChars): Chain;

    public static function propertyReadable(string $propertyName): Chain;

    public static function propertyRegex(string $propertyName, string $regex): Chain;

    public static function propertyResourceType(string $propertyName): Chain;

    public static function propertyRoman(string $propertyName): Chain;

    public static function propertyScalarVal(string $propertyName): Chain;

    /** @param "B"|"KB"|"MB"|"GB"|"TB"|"PB"|"EB"|"ZB"|"YB" $unit */
    public static function propertySize(string $propertyName, string $unit, Validator $validator): Chain;

    public static function propertySlug(string $propertyName): Chain;

    public static function propertySorted(string $propertyName, string $direction): Chain;

    public static function propertySpace(string $propertyName, string ...$additionalChars): Chain;

    public static function propertySpaced(string $propertyName): Chain;

    public static function propertyStartsWith(
        string $propertyName,
        mixed $startValue,
        bool $identical = false,
    ): Chain;

    public static function propertyStringType(string $propertyName): Chain;

    public static function propertyStringVal(string $propertyName): Chain;

    public static function propertySubdivisionCode(string $propertyName, string $countryCode): Chain;

    /** @param mixed[] $superset */
    public static function propertySubset(string $propertyName, array $superset): Chain;

    public static function propertySymbolicLink(string $propertyName): Chain;

    public static function propertyTime(string $propertyName, string $format = 'H:i:s'): Chain;

    public static function propertyTld(string $propertyName): Chain;

    public static function propertyTrueVal(string $propertyName): Chain;

    public static function propertyUndef(string $propertyName): Chain;

    public static function propertyUnique(string $propertyName): Chain;

    public static function propertyUploaded(string $propertyName): Chain;

    public static function propertyUppercase(string $propertyName): Chain;

    public static function propertyUrl(string $propertyName): Chain;

    public static function propertyUuid(string $propertyName, int|null $version = null): Chain;

    public static function propertyVersion(string $propertyName): Chain;

    public static function propertyVideoUrl(string $propertyName, string|null $service = null): Chain;

    public static function propertyVowel(string $propertyName, string ...$additionalChars): Chain;

    public static function propertyWhen(
        string $propertyName,
        Validator $when,
        Validator $then,
        Validator|null $else = null,
    ): Chain;

    public static function propertyWritable(string $propertyName): Chain;

    public static function propertyXdigit(string $propertyName, string ...$additionalChars): Chain;
}
