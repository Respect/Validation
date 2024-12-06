<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Mixins;

use DateTimeImmutable;
use Respect\Validation\Rule;

interface StaticUndefOr
{
    public static function undefOrAllOf(Rule $rule1, Rule $rule2, Rule ...$rules): ChainedValidator;

    public static function undefOrAlnum(string ...$additionalChars): ChainedValidator;

    public static function undefOrAlpha(string ...$additionalChars): ChainedValidator;

    public static function undefOrAlwaysInvalid(): ChainedValidator;

    public static function undefOrAlwaysValid(): ChainedValidator;

    public static function undefOrAnyOf(Rule $rule1, Rule $rule2, Rule ...$rules): ChainedValidator;

    public static function undefOrArrayType(): ChainedValidator;

    public static function undefOrArrayVal(): ChainedValidator;

    public static function undefOrBase(
        int $base,
        string $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
    ): ChainedValidator;

    public static function undefOrBase64(): ChainedValidator;

    public static function undefOrBetween(mixed $minValue, mixed $maxValue): ChainedValidator;

    public static function undefOrBetweenExclusive(mixed $minimum, mixed $maximum): ChainedValidator;

    public static function undefOrBoolType(): ChainedValidator;

    public static function undefOrBoolVal(): ChainedValidator;

    public static function undefOrBsn(): ChainedValidator;

    public static function undefOrCall(callable $callable, Rule $rule): ChainedValidator;

    public static function undefOrCallableType(): ChainedValidator;

    public static function undefOrCallback(callable $callback, mixed ...$arguments): ChainedValidator;

    public static function undefOrCharset(string $charset, string ...$charsets): ChainedValidator;

    public static function undefOrCnh(): ChainedValidator;

    public static function undefOrCnpj(): ChainedValidator;

    public static function undefOrConsecutive(Rule $rule1, Rule $rule2, Rule ...$rules): ChainedValidator;

    public static function undefOrConsonant(string ...$additionalChars): ChainedValidator;

    public static function undefOrContains(mixed $containsValue, bool $identical = false): ChainedValidator;

    /**
     * @param non-empty-array<mixed> $needles
     */
    public static function undefOrContainsAny(array $needles, bool $identical = false): ChainedValidator;

    public static function undefOrControl(string ...$additionalChars): ChainedValidator;

    public static function undefOrCountable(): ChainedValidator;

    /**
     * @param "alpha-2"|"alpha-3"|"numeric" $set
     */
    public static function undefOrCountryCode(string $set = 'alpha-2'): ChainedValidator;

    public static function undefOrCpf(): ChainedValidator;

    public static function undefOrCreditCard(string $brand = 'Any'): ChainedValidator;

    /**
     * @param "alpha-3"|"numeric" $set
     */
    public static function undefOrCurrencyCode(string $set = 'alpha-3'): ChainedValidator;

    public static function undefOrDate(string $format = 'Y-m-d'): ChainedValidator;

    public static function undefOrDateTime(?string $format = null): ChainedValidator;

    /**
     * @param "years"|"months"|"days"|"hours"|"minutes"|"seconds"|"microseconds" $type
     */
    public static function undefOrDateTimeDiff(
        string $type,
        Rule $rule,
        ?string $format = null,
        ?DateTimeImmutable $now = null,
    ): ChainedValidator;

    public static function undefOrDecimal(int $decimals): ChainedValidator;

    public static function undefOrDigit(string ...$additionalChars): ChainedValidator;

    public static function undefOrDirectory(): ChainedValidator;

    public static function undefOrDomain(bool $tldCheck = true): ChainedValidator;

    public static function undefOrEach(Rule $rule): ChainedValidator;

    public static function undefOrEmail(): ChainedValidator;

    public static function undefOrEndsWith(mixed $endValue, bool $identical = false): ChainedValidator;

    public static function undefOrEquals(mixed $compareTo): ChainedValidator;

    public static function undefOrEquivalent(mixed $compareTo): ChainedValidator;

    public static function undefOrEven(): ChainedValidator;

    public static function undefOrExecutable(): ChainedValidator;

    public static function undefOrExists(): ChainedValidator;

    public static function undefOrExtension(string $extension): ChainedValidator;

    public static function undefOrFactor(int $dividend): ChainedValidator;

    public static function undefOrFalseVal(): ChainedValidator;

    public static function undefOrFibonacci(): ChainedValidator;

    public static function undefOrFile(): ChainedValidator;

    public static function undefOrFilterVar(int $filter, mixed $options = null): ChainedValidator;

    public static function undefOrFinite(): ChainedValidator;

    public static function undefOrFloatType(): ChainedValidator;

    public static function undefOrFloatVal(): ChainedValidator;

    public static function undefOrGraph(string ...$additionalChars): ChainedValidator;

    public static function undefOrGreaterThan(mixed $compareTo): ChainedValidator;

    public static function undefOrGreaterThanOrEqual(mixed $compareTo): ChainedValidator;

    public static function undefOrHetu(): ChainedValidator;

    public static function undefOrHexRgbColor(): ChainedValidator;

    public static function undefOrIban(): ChainedValidator;

    public static function undefOrIdentical(mixed $compareTo): ChainedValidator;

    public static function undefOrImage(): ChainedValidator;

    public static function undefOrImei(): ChainedValidator;

    public static function undefOrIn(mixed $haystack, bool $compareIdentical = false): ChainedValidator;

    public static function undefOrInfinite(): ChainedValidator;

    /**
     * @param class-string $class
     */
    public static function undefOrInstance(string $class): ChainedValidator;

    public static function undefOrIntType(): ChainedValidator;

    public static function undefOrIntVal(): ChainedValidator;

    public static function undefOrIp(string $range = '*', ?int $options = null): ChainedValidator;

    public static function undefOrIsbn(): ChainedValidator;

    public static function undefOrIterableType(): ChainedValidator;

    public static function undefOrIterableVal(): ChainedValidator;

    public static function undefOrJson(): ChainedValidator;

    public static function undefOrKey(string|int $key, Rule $rule): ChainedValidator;

    public static function undefOrKeyExists(string|int $key): ChainedValidator;

    public static function undefOrKeyOptional(string|int $key, Rule $rule): ChainedValidator;

    public static function undefOrKeySet(Rule $rule, Rule ...$rules): ChainedValidator;

    /**
     * @param "alpha-2"|"alpha-3" $set
     */
    public static function undefOrLanguageCode(string $set = 'alpha-2'): ChainedValidator;

    /**
     * @param callable(mixed): Rule $ruleCreator
     */
    public static function undefOrLazy(callable $ruleCreator): ChainedValidator;

    public static function undefOrLeapDate(string $format): ChainedValidator;

    public static function undefOrLeapYear(): ChainedValidator;

    public static function undefOrLength(Rule $rule): ChainedValidator;

    public static function undefOrLessThan(mixed $compareTo): ChainedValidator;

    public static function undefOrLessThanOrEqual(mixed $compareTo): ChainedValidator;

    public static function undefOrLowercase(): ChainedValidator;

    public static function undefOrLuhn(): ChainedValidator;

    public static function undefOrMacAddress(): ChainedValidator;

    public static function undefOrMax(Rule $rule): ChainedValidator;

    public static function undefOrMimetype(string $mimetype): ChainedValidator;

    public static function undefOrMin(Rule $rule): ChainedValidator;

    public static function undefOrMultiple(int $multipleOf): ChainedValidator;

    public static function undefOrNegative(): ChainedValidator;

    public static function undefOrNfeAccessKey(): ChainedValidator;

    public static function undefOrNif(): ChainedValidator;

    public static function undefOrNip(): ChainedValidator;

    public static function undefOrNo(bool $useLocale = false): ChainedValidator;

    public static function undefOrNoWhitespace(): ChainedValidator;

    public static function undefOrNoneOf(Rule $rule1, Rule $rule2, Rule ...$rules): ChainedValidator;

    public static function undefOrNot(Rule $rule): ChainedValidator;

    public static function undefOrNotBlank(): ChainedValidator;

    public static function undefOrNotEmoji(): ChainedValidator;

    public static function undefOrNotEmpty(): ChainedValidator;

    public static function undefOrNullType(): ChainedValidator;

    public static function undefOrNumber(): ChainedValidator;

    public static function undefOrNumericVal(): ChainedValidator;

    public static function undefOrObjectType(): ChainedValidator;

    public static function undefOrOdd(): ChainedValidator;

    public static function undefOrOneOf(Rule $rule1, Rule $rule2, Rule ...$rules): ChainedValidator;

    public static function undefOrPerfectSquare(): ChainedValidator;

    public static function undefOrPesel(): ChainedValidator;

    public static function undefOrPhone(?string $countryCode = null): ChainedValidator;

    public static function undefOrPhpLabel(): ChainedValidator;

    public static function undefOrPis(): ChainedValidator;

    public static function undefOrPolishIdCard(): ChainedValidator;

    public static function undefOrPortugueseNif(): ChainedValidator;

    public static function undefOrPositive(): ChainedValidator;

    public static function undefOrPostalCode(string $countryCode, bool $formatted = false): ChainedValidator;

    public static function undefOrPrimeNumber(): ChainedValidator;

    public static function undefOrPrintable(string ...$additionalChars): ChainedValidator;

    public static function undefOrProperty(string $propertyName, Rule $rule): ChainedValidator;

    public static function undefOrPropertyExists(string $propertyName): ChainedValidator;

    public static function undefOrPropertyOptional(string $propertyName, Rule $rule): ChainedValidator;

    public static function undefOrPublicDomainSuffix(): ChainedValidator;

    public static function undefOrPunct(string ...$additionalChars): ChainedValidator;

    public static function undefOrReadable(): ChainedValidator;

    public static function undefOrRegex(string $regex): ChainedValidator;

    public static function undefOrResourceType(): ChainedValidator;

    public static function undefOrRoman(): ChainedValidator;

    public static function undefOrScalarVal(): ChainedValidator;

    /**
     * @param "B"|"KB"|"MB"|"GB"|"TB"|"PB"|"EB"|"ZB"|"YB" $unit
     */
    public static function undefOrSize(string $unit, Rule $rule): ChainedValidator;

    public static function undefOrSlug(): ChainedValidator;

    public static function undefOrSorted(string $direction): ChainedValidator;

    public static function undefOrSpace(string ...$additionalChars): ChainedValidator;

    public static function undefOrStartsWith(mixed $startValue, bool $identical = false): ChainedValidator;

    public static function undefOrStringType(): ChainedValidator;

    public static function undefOrStringVal(): ChainedValidator;

    public static function undefOrSubdivisionCode(string $countryCode): ChainedValidator;

    /**
     * @param mixed[] $superset
     */
    public static function undefOrSubset(array $superset): ChainedValidator;

    public static function undefOrSymbolicLink(): ChainedValidator;

    public static function undefOrTime(string $format = 'H:i:s'): ChainedValidator;

    public static function undefOrTld(): ChainedValidator;

    public static function undefOrTrueVal(): ChainedValidator;

    public static function undefOrUnique(): ChainedValidator;

    public static function undefOrUploaded(): ChainedValidator;

    public static function undefOrUppercase(): ChainedValidator;

    public static function undefOrUrl(): ChainedValidator;

    public static function undefOrUuid(?int $version = null): ChainedValidator;

    public static function undefOrVersion(): ChainedValidator;

    public static function undefOrVideoUrl(?string $service = null): ChainedValidator;

    public static function undefOrVowel(string ...$additionalChars): ChainedValidator;

    public static function undefOrWhen(Rule $when, Rule $then, ?Rule $else = null): ChainedValidator;

    public static function undefOrWritable(): ChainedValidator;

    public static function undefOrXdigit(string ...$additionalChars): ChainedValidator;

    public static function undefOrYes(bool $useLocale = false): ChainedValidator;
}
