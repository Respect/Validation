<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Mixins;

use DateTimeImmutable;
use Respect\Validation\Validatable;

interface StaticNullOr
{
    public static function nullOrAllOf(
        Validatable $rule1,
        Validatable $rule2,
        Validatable ...$rules,
    ): ChainedValidator;

    public static function nullOrAlnum(string ...$additionalChars): ChainedValidator;

    public static function nullOrAlpha(string ...$additionalChars): ChainedValidator;

    public static function nullOrAlwaysInvalid(): ChainedValidator;

    public static function nullOrAlwaysValid(): ChainedValidator;

    public static function nullOrAnyOf(
        Validatable $rule1,
        Validatable $rule2,
        Validatable ...$rules,
    ): ChainedValidator;

    public static function nullOrArrayType(): ChainedValidator;

    public static function nullOrArrayVal(): ChainedValidator;

    public static function nullOrBase(
        int $base,
        string $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
    ): ChainedValidator;

    public static function nullOrBase64(): ChainedValidator;

    public static function nullOrBetween(mixed $minValue, mixed $maxValue): ChainedValidator;

    public static function nullOrBetweenExclusive(mixed $minimum, mixed $maximum): ChainedValidator;

    public static function nullOrBoolType(): ChainedValidator;

    public static function nullOrBoolVal(): ChainedValidator;

    public static function nullOrBsn(): ChainedValidator;

    public static function nullOrCall(callable $callable, Validatable $rule): ChainedValidator;

    public static function nullOrCallableType(): ChainedValidator;

    public static function nullOrCallback(callable $callback, mixed ...$arguments): ChainedValidator;

    public static function nullOrCharset(string $charset, string ...$charsets): ChainedValidator;

    public static function nullOrCnh(): ChainedValidator;

    public static function nullOrCnpj(): ChainedValidator;

    public static function nullOrConsecutive(
        Validatable $rule1,
        Validatable $rule2,
        Validatable ...$rules,
    ): ChainedValidator;

    public static function nullOrConsonant(string ...$additionalChars): ChainedValidator;

    public static function nullOrContains(mixed $containsValue, bool $identical = false): ChainedValidator;

    /**
     * @param non-empty-array<mixed> $needles
     */
    public static function nullOrContainsAny(array $needles, bool $identical = false): ChainedValidator;

    public static function nullOrControl(string ...$additionalChars): ChainedValidator;

    public static function nullOrCountable(): ChainedValidator;

    /**
     * @param "alpha-2"|"alpha-3"|"numeric" $set
     */
    public static function nullOrCountryCode(string $set = 'alpha-2'): ChainedValidator;

    public static function nullOrCpf(): ChainedValidator;

    public static function nullOrCreditCard(string $brand = 'Any'): ChainedValidator;

    /**
     * @param "alpha-3"|"numeric" $set
     */
    public static function nullOrCurrencyCode(string $set = 'alpha-3'): ChainedValidator;

    public static function nullOrDate(string $format = 'Y-m-d'): ChainedValidator;

    public static function nullOrDateTime(?string $format = null): ChainedValidator;

    /**
     * @param "years"|"months"|"days"|"hours"|"minutes"|"seconds"|"microseconds" $type
     */
    public static function nullOrDateTimeDiff(
        string $type,
        Validatable $rule,
        ?string $format = null,
        ?DateTimeImmutable $now = null,
    ): ChainedValidator;

    public static function nullOrDecimal(int $decimals): ChainedValidator;

    public static function nullOrDigit(string ...$additionalChars): ChainedValidator;

    public static function nullOrDirectory(): ChainedValidator;

    public static function nullOrDomain(bool $tldCheck = true): ChainedValidator;

    public static function nullOrEach(Validatable $rule): ChainedValidator;

    public static function nullOrEmail(): ChainedValidator;

    public static function nullOrEndsWith(mixed $endValue, bool $identical = false): ChainedValidator;

    public static function nullOrEquals(mixed $compareTo): ChainedValidator;

    public static function nullOrEquivalent(mixed $compareTo): ChainedValidator;

    public static function nullOrEven(): ChainedValidator;

    public static function nullOrExecutable(): ChainedValidator;

    public static function nullOrExists(): ChainedValidator;

    public static function nullOrExtension(string $extension): ChainedValidator;

    public static function nullOrFactor(int $dividend): ChainedValidator;

    public static function nullOrFalseVal(): ChainedValidator;

    public static function nullOrFibonacci(): ChainedValidator;

    public static function nullOrFile(): ChainedValidator;

    public static function nullOrFilterVar(int $filter, mixed $options = null): ChainedValidator;

    public static function nullOrFinite(): ChainedValidator;

    public static function nullOrFloatType(): ChainedValidator;

    public static function nullOrFloatVal(): ChainedValidator;

    public static function nullOrGraph(string ...$additionalChars): ChainedValidator;

    public static function nullOrGreaterThan(mixed $compareTo): ChainedValidator;

    public static function nullOrGreaterThanOrEqual(mixed $compareTo): ChainedValidator;

    public static function nullOrHetu(): ChainedValidator;

    public static function nullOrHexRgbColor(): ChainedValidator;

    public static function nullOrIban(): ChainedValidator;

    public static function nullOrIdentical(mixed $compareTo): ChainedValidator;

    public static function nullOrImage(): ChainedValidator;

    public static function nullOrImei(): ChainedValidator;

    public static function nullOrIn(mixed $haystack, bool $compareIdentical = false): ChainedValidator;

    public static function nullOrInfinite(): ChainedValidator;

    /**
     * @param class-string $class
     */
    public static function nullOrInstance(string $class): ChainedValidator;

    public static function nullOrIntType(): ChainedValidator;

    public static function nullOrIntVal(): ChainedValidator;

    public static function nullOrIp(string $range = '*', ?int $options = null): ChainedValidator;

    public static function nullOrIsbn(): ChainedValidator;

    public static function nullOrIterableType(): ChainedValidator;

    public static function nullOrIterableVal(): ChainedValidator;

    public static function nullOrJson(): ChainedValidator;

    public static function nullOrKey(string|int $key, Validatable $rule): ChainedValidator;

    public static function nullOrKeyExists(string|int $key): ChainedValidator;

    public static function nullOrKeyOptional(string|int $key, Validatable $rule): ChainedValidator;

    public static function nullOrKeySet(Validatable $rule, Validatable ...$rules): ChainedValidator;

    /**
     * @param "alpha-2"|"alpha-3" $set
     */
    public static function nullOrLanguageCode(string $set = 'alpha-2'): ChainedValidator;

    /**
     * @param callable(mixed): Validatable $ruleCreator
     */
    public static function nullOrLazy(callable $ruleCreator): ChainedValidator;

    public static function nullOrLeapDate(string $format): ChainedValidator;

    public static function nullOrLeapYear(): ChainedValidator;

    public static function nullOrLength(Validatable $rule): ChainedValidator;

    public static function nullOrLessThan(mixed $compareTo): ChainedValidator;

    public static function nullOrLessThanOrEqual(mixed $compareTo): ChainedValidator;

    public static function nullOrLowercase(): ChainedValidator;

    public static function nullOrLuhn(): ChainedValidator;

    public static function nullOrMacAddress(): ChainedValidator;

    public static function nullOrMax(Validatable $rule): ChainedValidator;

    public static function nullOrMaxAge(int $age, ?string $format = null): ChainedValidator;

    public static function nullOrMimetype(string $mimetype): ChainedValidator;

    public static function nullOrMin(Validatable $rule): ChainedValidator;

    public static function nullOrMinAge(int $age, ?string $format = null): ChainedValidator;

    public static function nullOrMultiple(int $multipleOf): ChainedValidator;

    public static function nullOrNegative(): ChainedValidator;

    public static function nullOrNfeAccessKey(): ChainedValidator;

    public static function nullOrNif(): ChainedValidator;

    public static function nullOrNip(): ChainedValidator;

    public static function nullOrNo(bool $useLocale = false): ChainedValidator;

    public static function nullOrNoWhitespace(): ChainedValidator;

    public static function nullOrNoneOf(
        Validatable $rule1,
        Validatable $rule2,
        Validatable ...$rules,
    ): ChainedValidator;

    public static function nullOrNot(Validatable $rule): ChainedValidator;

    public static function nullOrNotBlank(): ChainedValidator;

    public static function nullOrNotEmoji(): ChainedValidator;

    public static function nullOrNotEmpty(): ChainedValidator;

    public static function nullOrNullType(): ChainedValidator;

    public static function nullOrNumber(): ChainedValidator;

    public static function nullOrNumericVal(): ChainedValidator;

    public static function nullOrObjectType(): ChainedValidator;

    public static function nullOrOdd(): ChainedValidator;

    public static function nullOrOneOf(
        Validatable $rule1,
        Validatable $rule2,
        Validatable ...$rules,
    ): ChainedValidator;

    public static function nullOrPerfectSquare(): ChainedValidator;

    public static function nullOrPesel(): ChainedValidator;

    public static function nullOrPhone(?string $countryCode = null): ChainedValidator;

    public static function nullOrPhpLabel(): ChainedValidator;

    public static function nullOrPis(): ChainedValidator;

    public static function nullOrPolishIdCard(): ChainedValidator;

    public static function nullOrPortugueseNif(): ChainedValidator;

    public static function nullOrPositive(): ChainedValidator;

    public static function nullOrPostalCode(string $countryCode, bool $formatted = false): ChainedValidator;

    public static function nullOrPrimeNumber(): ChainedValidator;

    public static function nullOrPrintable(string ...$additionalChars): ChainedValidator;

    public static function nullOrProperty(string $propertyName, Validatable $rule): ChainedValidator;

    public static function nullOrPropertyExists(string $propertyName): ChainedValidator;

    public static function nullOrPropertyOptional(string $propertyName, Validatable $rule): ChainedValidator;

    public static function nullOrPublicDomainSuffix(): ChainedValidator;

    public static function nullOrPunct(string ...$additionalChars): ChainedValidator;

    public static function nullOrReadable(): ChainedValidator;

    public static function nullOrRegex(string $regex): ChainedValidator;

    public static function nullOrResourceType(): ChainedValidator;

    public static function nullOrRoman(): ChainedValidator;

    public static function nullOrScalarVal(): ChainedValidator;

    public static function nullOrSize(
        string|int|null $minSize = null,
        string|int|null $maxSize = null,
    ): ChainedValidator;

    public static function nullOrSlug(): ChainedValidator;

    public static function nullOrSorted(string $direction): ChainedValidator;

    public static function nullOrSpace(string ...$additionalChars): ChainedValidator;

    public static function nullOrStartsWith(mixed $startValue, bool $identical = false): ChainedValidator;

    public static function nullOrStringType(): ChainedValidator;

    public static function nullOrStringVal(): ChainedValidator;

    public static function nullOrSubdivisionCode(string $countryCode): ChainedValidator;

    /**
     * @param mixed[] $superset
     */
    public static function nullOrSubset(array $superset): ChainedValidator;

    public static function nullOrSymbolicLink(): ChainedValidator;

    public static function nullOrTime(string $format = 'H:i:s'): ChainedValidator;

    public static function nullOrTld(): ChainedValidator;

    public static function nullOrTrueVal(): ChainedValidator;

    public static function nullOrUnique(): ChainedValidator;

    public static function nullOrUploaded(): ChainedValidator;

    public static function nullOrUppercase(): ChainedValidator;

    public static function nullOrUrl(): ChainedValidator;

    public static function nullOrUuid(?int $version = null): ChainedValidator;

    public static function nullOrVersion(): ChainedValidator;

    public static function nullOrVideoUrl(?string $service = null): ChainedValidator;

    public static function nullOrVowel(string ...$additionalChars): ChainedValidator;

    public static function nullOrWhen(
        Validatable $when,
        Validatable $then,
        ?Validatable $else = null,
    ): ChainedValidator;

    public static function nullOrWritable(): ChainedValidator;

    public static function nullOrXdigit(string ...$additionalChars): ChainedValidator;

    public static function nullOrYes(bool $useLocale = false): ChainedValidator;
}
