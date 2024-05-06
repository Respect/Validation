<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Mixins;

use Respect\Validation\Validatable;

interface ChainedProperty
{
    public function propertyAllOf(
        string $propertyName,
        Validatable $rule1,
        Validatable $rule2,
        Validatable ...$rules,
    ): ChainedValidator;

    public function propertyAlnum(string $propertyName, string ...$additionalChars): ChainedValidator;

    public function propertyAlpha(string $propertyName, string ...$additionalChars): ChainedValidator;

    public function propertyAlwaysInvalid(string $propertyName): ChainedValidator;

    public function propertyAlwaysValid(string $propertyName): ChainedValidator;

    public function propertyAnyOf(
        string $propertyName,
        Validatable $rule1,
        Validatable $rule2,
        Validatable ...$rules,
    ): ChainedValidator;

    public function propertyArrayType(string $propertyName): ChainedValidator;

    public function propertyArrayVal(string $propertyName): ChainedValidator;

    public function propertyBase(
        string $propertyName,
        int $base,
        string $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
    ): ChainedValidator;

    public function propertyBase64(string $propertyName): ChainedValidator;

    public function propertyBetween(string $propertyName, mixed $minValue, mixed $maxValue): ChainedValidator;

    public function propertyBetweenExclusive(string $propertyName, mixed $minimum, mixed $maximum): ChainedValidator;

    public function propertyBoolType(string $propertyName): ChainedValidator;

    public function propertyBoolVal(string $propertyName): ChainedValidator;

    public function propertyBsn(string $propertyName): ChainedValidator;

    public function propertyCall(string $propertyName, callable $callable, Validatable $rule): ChainedValidator;

    public function propertyCallableType(string $propertyName): ChainedValidator;

    public function propertyCallback(string $propertyName, callable $callback, mixed ...$arguments): ChainedValidator;

    public function propertyCharset(string $propertyName, string $charset, string ...$charsets): ChainedValidator;

    public function propertyCnh(string $propertyName): ChainedValidator;

    public function propertyCnpj(string $propertyName): ChainedValidator;

    public function propertyConsecutive(
        string $propertyName,
        Validatable $rule1,
        Validatable $rule2,
        Validatable ...$rules,
    ): ChainedValidator;

    public function propertyConsonant(string $propertyName, string ...$additionalChars): ChainedValidator;

    public function propertyContains(
        string $propertyName,
        mixed $containsValue,
        bool $identical = false,
    ): ChainedValidator;

    /**
     * @param non-empty-array<mixed> $needles
     */
    public function propertyContainsAny(
        string $propertyName,
        array $needles,
        bool $identical = false,
    ): ChainedValidator;

    public function propertyControl(string $propertyName, string ...$additionalChars): ChainedValidator;

    public function propertyCountable(string $propertyName): ChainedValidator;

    /**
     * @param "alpha-2"|"alpha-3"|"numeric" $set
     */
    public function propertyCountryCode(string $propertyName, string $set = 'alpha-2'): ChainedValidator;

    public function propertyCpf(string $propertyName): ChainedValidator;

    public function propertyCreditCard(string $propertyName, string $brand = 'Any'): ChainedValidator;

    /**
     * @param "alpha-3"|"numeric" $set
     */
    public function propertyCurrencyCode(string $propertyName, string $set = 'alpha-3'): ChainedValidator;

    public function propertyDate(string $propertyName, string $format = 'Y-m-d'): ChainedValidator;

    public function propertyDateTime(string $propertyName, ?string $format = null): ChainedValidator;

    public function propertyDecimal(string $propertyName, int $decimals): ChainedValidator;

    public function propertyDigit(string $propertyName, string ...$additionalChars): ChainedValidator;

    public function propertyDirectory(string $propertyName): ChainedValidator;

    public function propertyDomain(string $propertyName, bool $tldCheck = true): ChainedValidator;

    public function propertyEach(string $propertyName, Validatable $rule): ChainedValidator;

    public function propertyEmail(string $propertyName): ChainedValidator;

    public function propertyEndsWith(string $propertyName, mixed $endValue, bool $identical = false): ChainedValidator;

    public function propertyEquals(string $propertyName, mixed $compareTo): ChainedValidator;

    public function propertyEquivalent(string $propertyName, mixed $compareTo): ChainedValidator;

    public function propertyEven(string $propertyName): ChainedValidator;

    public function propertyExecutable(string $propertyName): ChainedValidator;

    public function propertyExtension(string $propertyName, string $extension): ChainedValidator;

    public function propertyFactor(string $propertyName, int $dividend): ChainedValidator;

    public function propertyFalseVal(string $propertyName): ChainedValidator;

    public function propertyFibonacci(string $propertyName): ChainedValidator;

    public function propertyFile(string $propertyName): ChainedValidator;

    public function propertyFilterVar(string $propertyName, int $filter, mixed $options = null): ChainedValidator;

    public function propertyFinite(string $propertyName): ChainedValidator;

    public function propertyFloatType(string $propertyName): ChainedValidator;

    public function propertyFloatVal(string $propertyName): ChainedValidator;

    public function propertyGraph(string $propertyName, string ...$additionalChars): ChainedValidator;

    public function propertyGreaterThan(string $propertyName, mixed $compareTo): ChainedValidator;

    public function propertyGreaterThanOrEqual(string $propertyName, mixed $compareTo): ChainedValidator;

    public function propertyHetu(string $propertyName): ChainedValidator;

    public function propertyHexRgbColor(string $propertyName): ChainedValidator;

    public function propertyIban(string $propertyName): ChainedValidator;

    public function propertyIdentical(string $propertyName, mixed $compareTo): ChainedValidator;

    public function propertyImage(string $propertyName): ChainedValidator;

    public function propertyImei(string $propertyName): ChainedValidator;

    public function propertyIn(
        string $propertyName,
        mixed $haystack,
        bool $compareIdentical = false,
    ): ChainedValidator;

    public function propertyInfinite(string $propertyName): ChainedValidator;

    /**
     * @param class-string $class
     */
    public function propertyInstance(string $propertyName, string $class): ChainedValidator;

    public function propertyIntType(string $propertyName): ChainedValidator;

    public function propertyIntVal(string $propertyName): ChainedValidator;

    public function propertyIp(string $propertyName, string $range = '*', ?int $options = null): ChainedValidator;

    public function propertyIsbn(string $propertyName): ChainedValidator;

    public function propertyIterableType(string $propertyName): ChainedValidator;

    public function propertyIterableVal(string $propertyName): ChainedValidator;

    public function propertyJson(string $propertyName): ChainedValidator;

    /**
     * @param "alpha-2"|"alpha-3" $set
     */
    public function propertyLanguageCode(string $propertyName, string $set = 'alpha-2'): ChainedValidator;

    /**
     * @param callable(mixed): Validatable $ruleCreator
     */
    public function propertyLazy(string $propertyName, callable $ruleCreator): ChainedValidator;

    public function propertyLeapDate(string $propertyName, string $format): ChainedValidator;

    public function propertyLeapYear(string $propertyName): ChainedValidator;

    public function propertyLength(string $propertyName, Validatable $rule): ChainedValidator;

    public function propertyLessThan(string $propertyName, mixed $compareTo): ChainedValidator;

    public function propertyLessThanOrEqual(string $propertyName, mixed $compareTo): ChainedValidator;

    public function propertyLowercase(string $propertyName): ChainedValidator;

    public function propertyLuhn(string $propertyName): ChainedValidator;

    public function propertyMacAddress(string $propertyName): ChainedValidator;

    public function propertyMax(string $propertyName, Validatable $rule): ChainedValidator;

    public function propertyMaxAge(string $propertyName, int $age, ?string $format = null): ChainedValidator;

    public function propertyMimetype(string $propertyName, string $mimetype): ChainedValidator;

    public function propertyMin(string $propertyName, Validatable $rule): ChainedValidator;

    public function propertyMinAge(string $propertyName, int $age, ?string $format = null): ChainedValidator;

    public function propertyMultiple(string $propertyName, int $multipleOf): ChainedValidator;

    public function propertyNegative(string $propertyName): ChainedValidator;

    public function propertyNfeAccessKey(string $propertyName): ChainedValidator;

    public function propertyNif(string $propertyName): ChainedValidator;

    public function propertyNip(string $propertyName): ChainedValidator;

    public function propertyNo(string $propertyName, bool $useLocale = false): ChainedValidator;

    public function propertyNoWhitespace(string $propertyName): ChainedValidator;

    public function propertyNoneOf(
        string $propertyName,
        Validatable $rule1,
        Validatable $rule2,
        Validatable ...$rules,
    ): ChainedValidator;

    public function propertyNot(string $propertyName, Validatable $rule): ChainedValidator;

    public function propertyNotBlank(string $propertyName): ChainedValidator;

    public function propertyNotEmoji(string $propertyName): ChainedValidator;

    public function propertyNotEmpty(string $propertyName): ChainedValidator;

    public function propertyNotOptional(string $propertyName): ChainedValidator;

    public function propertyNotUndef(string $propertyName): ChainedValidator;

    public function propertyNullType(string $propertyName): ChainedValidator;

    public function propertyNumber(string $propertyName): ChainedValidator;

    public function propertyNumericVal(string $propertyName): ChainedValidator;

    public function propertyObjectType(string $propertyName): ChainedValidator;

    public function propertyOdd(string $propertyName): ChainedValidator;

    public function propertyOneOf(
        string $propertyName,
        Validatable $rule1,
        Validatable $rule2,
        Validatable ...$rules,
    ): ChainedValidator;

    public function propertyPerfectSquare(string $propertyName): ChainedValidator;

    public function propertyPesel(string $propertyName): ChainedValidator;

    public function propertyPhone(string $propertyName, ?string $countryCode = null): ChainedValidator;

    public function propertyPhpLabel(string $propertyName): ChainedValidator;

    public function propertyPis(string $propertyName): ChainedValidator;

    public function propertyPolishIdCard(string $propertyName): ChainedValidator;

    public function propertyPortugueseNif(string $propertyName): ChainedValidator;

    public function propertyPositive(string $propertyName): ChainedValidator;

    public function propertyPostalCode(
        string $propertyName,
        string $countryCode,
        bool $formatted = false,
    ): ChainedValidator;

    public function propertyPrimeNumber(string $propertyName): ChainedValidator;

    public function propertyPrintable(string $propertyName, string ...$additionalChars): ChainedValidator;

    public function propertyPublicDomainSuffix(string $propertyName): ChainedValidator;

    public function propertyPunct(string $propertyName, string ...$additionalChars): ChainedValidator;

    public function propertyReadable(string $propertyName): ChainedValidator;

    public function propertyRegex(string $propertyName, string $regex): ChainedValidator;

    public function propertyResourceType(string $propertyName): ChainedValidator;

    public function propertyRoman(string $propertyName): ChainedValidator;

    public function propertyScalarVal(string $propertyName): ChainedValidator;

    public function propertySize(
        string $propertyName,
        string|int|null $minSize = null,
        string|int|null $maxSize = null,
    ): ChainedValidator;

    public function propertySlug(string $propertyName): ChainedValidator;

    public function propertySorted(string $propertyName, string $direction): ChainedValidator;

    public function propertySpace(string $propertyName, string ...$additionalChars): ChainedValidator;

    public function propertyStartsWith(
        string $propertyName,
        mixed $startValue,
        bool $identical = false,
    ): ChainedValidator;

    public function propertyStringType(string $propertyName): ChainedValidator;

    public function propertyStringVal(string $propertyName): ChainedValidator;

    public function propertySubdivisionCode(string $propertyName, string $countryCode): ChainedValidator;

    /**
     * @param mixed[] $superset
     */
    public function propertySubset(string $propertyName, array $superset): ChainedValidator;

    public function propertySymbolicLink(string $propertyName): ChainedValidator;

    public function propertyTime(string $propertyName, string $format = 'H:i:s'): ChainedValidator;

    public function propertyTld(string $propertyName): ChainedValidator;

    public function propertyTrueVal(string $propertyName): ChainedValidator;

    public function propertyUnique(string $propertyName): ChainedValidator;

    public function propertyUploaded(string $propertyName): ChainedValidator;

    public function propertyUppercase(string $propertyName): ChainedValidator;

    public function propertyUrl(string $propertyName): ChainedValidator;

    public function propertyUuid(string $propertyName, ?int $version = null): ChainedValidator;

    public function propertyVersion(string $propertyName): ChainedValidator;

    public function propertyVideoUrl(string $propertyName, ?string $service = null): ChainedValidator;

    public function propertyVowel(string $propertyName, string ...$additionalChars): ChainedValidator;

    public function propertyWhen(
        string $propertyName,
        Validatable $when,
        Validatable $then,
        ?Validatable $else = null,
    ): ChainedValidator;

    public function propertyWritable(string $propertyName): ChainedValidator;

    public function propertyXdigit(string $propertyName, string ...$additionalChars): ChainedValidator;

    public function propertyYes(string $propertyName, bool $useLocale = false): ChainedValidator;
}
