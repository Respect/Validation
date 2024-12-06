<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Mixins;

use DateTimeImmutable;
use Respect\Validation\Rule;

interface StaticProperty
{
    public static function propertyAllOf(
        string $propertyName,
        Rule $rule1,
        Rule $rule2,
        Rule ...$rules,
    ): ChainedValidator;

    public static function propertyAlnum(string $propertyName, string ...$additionalChars): ChainedValidator;

    public static function propertyAlpha(string $propertyName, string ...$additionalChars): ChainedValidator;

    public static function propertyAlwaysInvalid(string $propertyName): ChainedValidator;

    public static function propertyAlwaysValid(string $propertyName): ChainedValidator;

    public static function propertyAnyOf(
        string $propertyName,
        Rule $rule1,
        Rule $rule2,
        Rule ...$rules,
    ): ChainedValidator;

    public static function propertyArrayType(string $propertyName): ChainedValidator;

    public static function propertyArrayVal(string $propertyName): ChainedValidator;

    public static function propertyBase(
        string $propertyName,
        int $base,
        string $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
    ): ChainedValidator;

    public static function propertyBase64(string $propertyName): ChainedValidator;

    public static function propertyBetween(string $propertyName, mixed $minValue, mixed $maxValue): ChainedValidator;

    public static function propertyBetweenExclusive(
        string $propertyName,
        mixed $minimum,
        mixed $maximum,
    ): ChainedValidator;

    public static function propertyBoolType(string $propertyName): ChainedValidator;

    public static function propertyBoolVal(string $propertyName): ChainedValidator;

    public static function propertyBsn(string $propertyName): ChainedValidator;

    public static function propertyCall(string $propertyName, callable $callable, Rule $rule): ChainedValidator;

    public static function propertyCallableType(string $propertyName): ChainedValidator;

    public static function propertyCallback(
        string $propertyName,
        callable $callback,
        mixed ...$arguments,
    ): ChainedValidator;

    public static function propertyCharset(
        string $propertyName,
        string $charset,
        string ...$charsets,
    ): ChainedValidator;

    public static function propertyCnh(string $propertyName): ChainedValidator;

    public static function propertyCnpj(string $propertyName): ChainedValidator;

    public static function propertyConsecutive(
        string $propertyName,
        Rule $rule1,
        Rule $rule2,
        Rule ...$rules,
    ): ChainedValidator;

    public static function propertyConsonant(string $propertyName, string ...$additionalChars): ChainedValidator;

    public static function propertyContains(
        string $propertyName,
        mixed $containsValue,
        bool $identical = false,
    ): ChainedValidator;

    /**
     * @param non-empty-array<mixed> $needles
     */
    public static function propertyContainsAny(
        string $propertyName,
        array $needles,
        bool $identical = false,
    ): ChainedValidator;

    public static function propertyControl(string $propertyName, string ...$additionalChars): ChainedValidator;

    public static function propertyCountable(string $propertyName): ChainedValidator;

    /**
     * @param "alpha-2"|"alpha-3"|"numeric" $set
     */
    public static function propertyCountryCode(string $propertyName, string $set = 'alpha-2'): ChainedValidator;

    public static function propertyCpf(string $propertyName): ChainedValidator;

    public static function propertyCreditCard(string $propertyName, string $brand = 'Any'): ChainedValidator;

    /**
     * @param "alpha-3"|"numeric" $set
     */
    public static function propertyCurrencyCode(string $propertyName, string $set = 'alpha-3'): ChainedValidator;

    public static function propertyDate(string $propertyName, string $format = 'Y-m-d'): ChainedValidator;

    public static function propertyDateTime(string $propertyName, ?string $format = null): ChainedValidator;

    /**
     * @param "years"|"months"|"days"|"hours"|"minutes"|"seconds"|"microseconds" $type
     */
    public static function propertyDateTimeDiff(
        string $propertyName,
        string $type,
        Rule $rule,
        ?string $format = null,
        ?DateTimeImmutable $now = null,
    ): ChainedValidator;

    public static function propertyDecimal(string $propertyName, int $decimals): ChainedValidator;

    public static function propertyDigit(string $propertyName, string ...$additionalChars): ChainedValidator;

    public static function propertyDirectory(string $propertyName): ChainedValidator;

    public static function propertyDomain(string $propertyName, bool $tldCheck = true): ChainedValidator;

    public static function propertyEach(string $propertyName, Rule $rule): ChainedValidator;

    public static function propertyEmail(string $propertyName): ChainedValidator;

    public static function propertyEndsWith(
        string $propertyName,
        mixed $endValue,
        bool $identical = false,
    ): ChainedValidator;

    public static function propertyEquals(string $propertyName, mixed $compareTo): ChainedValidator;

    public static function propertyEquivalent(string $propertyName, mixed $compareTo): ChainedValidator;

    public static function propertyEven(string $propertyName): ChainedValidator;

    public static function propertyExecutable(string $propertyName): ChainedValidator;

    public static function propertyExtension(string $propertyName, string $extension): ChainedValidator;

    public static function propertyFactor(string $propertyName, int $dividend): ChainedValidator;

    public static function propertyFalseVal(string $propertyName): ChainedValidator;

    public static function propertyFibonacci(string $propertyName): ChainedValidator;

    public static function propertyFile(string $propertyName): ChainedValidator;

    public static function propertyFilterVar(
        string $propertyName,
        int $filter,
        mixed $options = null,
    ): ChainedValidator;

    public static function propertyFinite(string $propertyName): ChainedValidator;

    public static function propertyFloatType(string $propertyName): ChainedValidator;

    public static function propertyFloatVal(string $propertyName): ChainedValidator;

    public static function propertyGraph(string $propertyName, string ...$additionalChars): ChainedValidator;

    public static function propertyGreaterThan(string $propertyName, mixed $compareTo): ChainedValidator;

    public static function propertyGreaterThanOrEqual(string $propertyName, mixed $compareTo): ChainedValidator;

    public static function propertyHetu(string $propertyName): ChainedValidator;

    public static function propertyHexRgbColor(string $propertyName): ChainedValidator;

    public static function propertyIban(string $propertyName): ChainedValidator;

    public static function propertyIdentical(string $propertyName, mixed $compareTo): ChainedValidator;

    public static function propertyImage(string $propertyName): ChainedValidator;

    public static function propertyImei(string $propertyName): ChainedValidator;

    public static function propertyIn(
        string $propertyName,
        mixed $haystack,
        bool $compareIdentical = false,
    ): ChainedValidator;

    public static function propertyInfinite(string $propertyName): ChainedValidator;

    /**
     * @param class-string $class
     */
    public static function propertyInstance(string $propertyName, string $class): ChainedValidator;

    public static function propertyIntType(string $propertyName): ChainedValidator;

    public static function propertyIntVal(string $propertyName): ChainedValidator;

    public static function propertyIp(
        string $propertyName,
        string $range = '*',
        ?int $options = null,
    ): ChainedValidator;

    public static function propertyIsbn(string $propertyName): ChainedValidator;

    public static function propertyIterableType(string $propertyName): ChainedValidator;

    public static function propertyIterableVal(string $propertyName): ChainedValidator;

    public static function propertyJson(string $propertyName): ChainedValidator;

    /**
     * @param "alpha-2"|"alpha-3" $set
     */
    public static function propertyLanguageCode(string $propertyName, string $set = 'alpha-2'): ChainedValidator;

    /**
     * @param callable(mixed): Rule $ruleCreator
     */
    public static function propertyLazy(string $propertyName, callable $ruleCreator): ChainedValidator;

    public static function propertyLeapDate(string $propertyName, string $format): ChainedValidator;

    public static function propertyLeapYear(string $propertyName): ChainedValidator;

    public static function propertyLength(string $propertyName, Rule $rule): ChainedValidator;

    public static function propertyLessThan(string $propertyName, mixed $compareTo): ChainedValidator;

    public static function propertyLessThanOrEqual(string $propertyName, mixed $compareTo): ChainedValidator;

    public static function propertyLowercase(string $propertyName): ChainedValidator;

    public static function propertyLuhn(string $propertyName): ChainedValidator;

    public static function propertyMacAddress(string $propertyName): ChainedValidator;

    public static function propertyMax(string $propertyName, Rule $rule): ChainedValidator;

    public static function propertyMimetype(string $propertyName, string $mimetype): ChainedValidator;

    public static function propertyMin(string $propertyName, Rule $rule): ChainedValidator;

    public static function propertyMultiple(string $propertyName, int $multipleOf): ChainedValidator;

    public static function propertyNegative(string $propertyName): ChainedValidator;

    public static function propertyNfeAccessKey(string $propertyName): ChainedValidator;

    public static function propertyNif(string $propertyName): ChainedValidator;

    public static function propertyNip(string $propertyName): ChainedValidator;

    public static function propertyNo(string $propertyName, bool $useLocale = false): ChainedValidator;

    public static function propertyNoWhitespace(string $propertyName): ChainedValidator;

    public static function propertyNoneOf(
        string $propertyName,
        Rule $rule1,
        Rule $rule2,
        Rule ...$rules,
    ): ChainedValidator;

    public static function propertyNot(string $propertyName, Rule $rule): ChainedValidator;

    public static function propertyNotBlank(string $propertyName): ChainedValidator;

    public static function propertyNotEmoji(string $propertyName): ChainedValidator;

    public static function propertyNotEmpty(string $propertyName): ChainedValidator;

    public static function propertyNotOptional(string $propertyName): ChainedValidator;

    public static function propertyNotUndef(string $propertyName): ChainedValidator;

    public static function propertyNullType(string $propertyName): ChainedValidator;

    public static function propertyNumber(string $propertyName): ChainedValidator;

    public static function propertyNumericVal(string $propertyName): ChainedValidator;

    public static function propertyObjectType(string $propertyName): ChainedValidator;

    public static function propertyOdd(string $propertyName): ChainedValidator;

    public static function propertyOneOf(
        string $propertyName,
        Rule $rule1,
        Rule $rule2,
        Rule ...$rules,
    ): ChainedValidator;

    public static function propertyPerfectSquare(string $propertyName): ChainedValidator;

    public static function propertyPesel(string $propertyName): ChainedValidator;

    public static function propertyPhone(string $propertyName, ?string $countryCode = null): ChainedValidator;

    public static function propertyPhpLabel(string $propertyName): ChainedValidator;

    public static function propertyPis(string $propertyName): ChainedValidator;

    public static function propertyPolishIdCard(string $propertyName): ChainedValidator;

    public static function propertyPortugueseNif(string $propertyName): ChainedValidator;

    public static function propertyPositive(string $propertyName): ChainedValidator;

    public static function propertyPostalCode(
        string $propertyName,
        string $countryCode,
        bool $formatted = false,
    ): ChainedValidator;

    public static function propertyPrimeNumber(string $propertyName): ChainedValidator;

    public static function propertyPrintable(string $propertyName, string ...$additionalChars): ChainedValidator;

    public static function propertyPublicDomainSuffix(string $propertyName): ChainedValidator;

    public static function propertyPunct(string $propertyName, string ...$additionalChars): ChainedValidator;

    public static function propertyReadable(string $propertyName): ChainedValidator;

    public static function propertyRegex(string $propertyName, string $regex): ChainedValidator;

    public static function propertyResourceType(string $propertyName): ChainedValidator;

    public static function propertyRoman(string $propertyName): ChainedValidator;

    public static function propertyScalarVal(string $propertyName): ChainedValidator;

    /**
     * @param "B"|"KB"|"MB"|"GB"|"TB"|"PB"|"EB"|"ZB"|"YB" $unit
     */
    public static function propertySize(string $propertyName, string $unit, Rule $rule): ChainedValidator;

    public static function propertySlug(string $propertyName): ChainedValidator;

    public static function propertySorted(string $propertyName, string $direction): ChainedValidator;

    public static function propertySpace(string $propertyName, string ...$additionalChars): ChainedValidator;

    public static function propertyStartsWith(
        string $propertyName,
        mixed $startValue,
        bool $identical = false,
    ): ChainedValidator;

    public static function propertyStringType(string $propertyName): ChainedValidator;

    public static function propertyStringVal(string $propertyName): ChainedValidator;

    public static function propertySubdivisionCode(string $propertyName, string $countryCode): ChainedValidator;

    /**
     * @param mixed[] $superset
     */
    public static function propertySubset(string $propertyName, array $superset): ChainedValidator;

    public static function propertySymbolicLink(string $propertyName): ChainedValidator;

    public static function propertyTime(string $propertyName, string $format = 'H:i:s'): ChainedValidator;

    public static function propertyTld(string $propertyName): ChainedValidator;

    public static function propertyTrueVal(string $propertyName): ChainedValidator;

    public static function propertyUnique(string $propertyName): ChainedValidator;

    public static function propertyUploaded(string $propertyName): ChainedValidator;

    public static function propertyUppercase(string $propertyName): ChainedValidator;

    public static function propertyUrl(string $propertyName): ChainedValidator;

    public static function propertyUuid(string $propertyName, ?int $version = null): ChainedValidator;

    public static function propertyVersion(string $propertyName): ChainedValidator;

    public static function propertyVideoUrl(string $propertyName, ?string $service = null): ChainedValidator;

    public static function propertyVowel(string $propertyName, string ...$additionalChars): ChainedValidator;

    public static function propertyWhen(
        string $propertyName,
        Rule $when,
        Rule $then,
        ?Rule $else = null,
    ): ChainedValidator;

    public static function propertyWritable(string $propertyName): ChainedValidator;

    public static function propertyXdigit(string $propertyName, string ...$additionalChars): ChainedValidator;

    public static function propertyYes(string $propertyName, bool $useLocale = false): ChainedValidator;
}
