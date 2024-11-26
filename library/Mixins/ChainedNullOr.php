<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Mixins;

use DateTimeImmutable;
use Respect\Validation\Validatable;

interface ChainedNullOr
{
    public function nullOrAllOf(Validatable $rule1, Validatable $rule2, Validatable ...$rules): ChainedValidator;

    public function nullOrAlnum(string ...$additionalChars): ChainedValidator;

    public function nullOrAlpha(string ...$additionalChars): ChainedValidator;

    public function nullOrAlwaysInvalid(): ChainedValidator;

    public function nullOrAlwaysValid(): ChainedValidator;

    public function nullOrAnyOf(Validatable $rule1, Validatable $rule2, Validatable ...$rules): ChainedValidator;

    public function nullOrArrayType(): ChainedValidator;

    public function nullOrArrayVal(): ChainedValidator;

    public function nullOrBase(
        int $base,
        string $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
    ): ChainedValidator;

    public function nullOrBase64(): ChainedValidator;

    public function nullOrBetween(mixed $minValue, mixed $maxValue): ChainedValidator;

    public function nullOrBetweenExclusive(mixed $minimum, mixed $maximum): ChainedValidator;

    public function nullOrBoolType(): ChainedValidator;

    public function nullOrBoolVal(): ChainedValidator;

    public function nullOrBsn(): ChainedValidator;

    public function nullOrCall(callable $callable, Validatable $rule): ChainedValidator;

    public function nullOrCallableType(): ChainedValidator;

    public function nullOrCallback(callable $callback, mixed ...$arguments): ChainedValidator;

    public function nullOrCharset(string $charset, string ...$charsets): ChainedValidator;

    public function nullOrCnh(): ChainedValidator;

    public function nullOrCnpj(): ChainedValidator;

    public function nullOrConsecutive(Validatable $rule1, Validatable $rule2, Validatable ...$rules): ChainedValidator;

    public function nullOrConsonant(string ...$additionalChars): ChainedValidator;

    public function nullOrContains(mixed $containsValue, bool $identical = false): ChainedValidator;

    /**
     * @param non-empty-array<mixed> $needles
     */
    public function nullOrContainsAny(array $needles, bool $identical = false): ChainedValidator;

    public function nullOrControl(string ...$additionalChars): ChainedValidator;

    public function nullOrCountable(): ChainedValidator;

    /**
     * @param "alpha-2"|"alpha-3"|"numeric" $set
     */
    public function nullOrCountryCode(string $set = 'alpha-2'): ChainedValidator;

    public function nullOrCpf(): ChainedValidator;

    public function nullOrCreditCard(string $brand = 'Any'): ChainedValidator;

    /**
     * @param "alpha-3"|"numeric" $set
     */
    public function nullOrCurrencyCode(string $set = 'alpha-3'): ChainedValidator;

    public function nullOrDate(string $format = 'Y-m-d'): ChainedValidator;

    public function nullOrDateTime(?string $format = null): ChainedValidator;

    /**
     * @param "years"|"months"|"days"|"hours"|"minutes"|"seconds"|"microseconds" $type
     */
    public function nullOrDateTimeDiff(
        string $type,
        Validatable $rule,
        ?string $format = null,
        ?DateTimeImmutable $now = null,
    ): ChainedValidator;

    public function nullOrDecimal(int $decimals): ChainedValidator;

    public function nullOrDigit(string ...$additionalChars): ChainedValidator;

    public function nullOrDirectory(): ChainedValidator;

    public function nullOrDomain(bool $tldCheck = true): ChainedValidator;

    public function nullOrEach(Validatable $rule): ChainedValidator;

    public function nullOrEmail(): ChainedValidator;

    public function nullOrEndsWith(mixed $endValue, bool $identical = false): ChainedValidator;

    public function nullOrEquals(mixed $compareTo): ChainedValidator;

    public function nullOrEquivalent(mixed $compareTo): ChainedValidator;

    public function nullOrEven(): ChainedValidator;

    public function nullOrExecutable(): ChainedValidator;

    public function nullOrExists(): ChainedValidator;

    public function nullOrExtension(string $extension): ChainedValidator;

    public function nullOrFactor(int $dividend): ChainedValidator;

    public function nullOrFalseVal(): ChainedValidator;

    public function nullOrFibonacci(): ChainedValidator;

    public function nullOrFile(): ChainedValidator;

    public function nullOrFilterVar(int $filter, mixed $options = null): ChainedValidator;

    public function nullOrFinite(): ChainedValidator;

    public function nullOrFloatType(): ChainedValidator;

    public function nullOrFloatVal(): ChainedValidator;

    public function nullOrGraph(string ...$additionalChars): ChainedValidator;

    public function nullOrGreaterThan(mixed $compareTo): ChainedValidator;

    public function nullOrGreaterThanOrEqual(mixed $compareTo): ChainedValidator;

    public function nullOrHetu(): ChainedValidator;

    public function nullOrHexRgbColor(): ChainedValidator;

    public function nullOrIban(): ChainedValidator;

    public function nullOrIdentical(mixed $compareTo): ChainedValidator;

    public function nullOrImage(): ChainedValidator;

    public function nullOrImei(): ChainedValidator;

    public function nullOrIn(mixed $haystack, bool $compareIdentical = false): ChainedValidator;

    public function nullOrInfinite(): ChainedValidator;

    /**
     * @param class-string $class
     */
    public function nullOrInstance(string $class): ChainedValidator;

    public function nullOrIntType(): ChainedValidator;

    public function nullOrIntVal(): ChainedValidator;

    public function nullOrIp(string $range = '*', ?int $options = null): ChainedValidator;

    public function nullOrIsbn(): ChainedValidator;

    public function nullOrIterableType(): ChainedValidator;

    public function nullOrIterableVal(): ChainedValidator;

    public function nullOrJson(): ChainedValidator;

    public function nullOrKey(string|int $key, Validatable $rule): ChainedValidator;

    public function nullOrKeyExists(string|int $key): ChainedValidator;

    public function nullOrKeyOptional(string|int $key, Validatable $rule): ChainedValidator;

    public function nullOrKeySet(Validatable $rule, Validatable ...$rules): ChainedValidator;

    /**
     * @param "alpha-2"|"alpha-3" $set
     */
    public function nullOrLanguageCode(string $set = 'alpha-2'): ChainedValidator;

    /**
     * @param callable(mixed): Validatable $ruleCreator
     */
    public function nullOrLazy(callable $ruleCreator): ChainedValidator;

    public function nullOrLeapDate(string $format): ChainedValidator;

    public function nullOrLeapYear(): ChainedValidator;

    public function nullOrLength(Validatable $rule): ChainedValidator;

    public function nullOrLessThan(mixed $compareTo): ChainedValidator;

    public function nullOrLessThanOrEqual(mixed $compareTo): ChainedValidator;

    public function nullOrLowercase(): ChainedValidator;

    public function nullOrLuhn(): ChainedValidator;

    public function nullOrMacAddress(): ChainedValidator;

    public function nullOrMax(Validatable $rule): ChainedValidator;

    public function nullOrMimetype(string $mimetype): ChainedValidator;

    public function nullOrMin(Validatable $rule): ChainedValidator;

    public function nullOrMultiple(int $multipleOf): ChainedValidator;

    public function nullOrNegative(): ChainedValidator;

    public function nullOrNfeAccessKey(): ChainedValidator;

    public function nullOrNif(): ChainedValidator;

    public function nullOrNip(): ChainedValidator;

    public function nullOrNo(bool $useLocale = false): ChainedValidator;

    public function nullOrNoWhitespace(): ChainedValidator;

    public function nullOrNoneOf(Validatable $rule1, Validatable $rule2, Validatable ...$rules): ChainedValidator;

    public function nullOrNot(Validatable $rule): ChainedValidator;

    public function nullOrNotBlank(): ChainedValidator;

    public function nullOrNotEmoji(): ChainedValidator;

    public function nullOrNotEmpty(): ChainedValidator;

    public function nullOrNullType(): ChainedValidator;

    public function nullOrNumber(): ChainedValidator;

    public function nullOrNumericVal(): ChainedValidator;

    public function nullOrObjectType(): ChainedValidator;

    public function nullOrOdd(): ChainedValidator;

    public function nullOrOneOf(Validatable $rule1, Validatable $rule2, Validatable ...$rules): ChainedValidator;

    public function nullOrPerfectSquare(): ChainedValidator;

    public function nullOrPesel(): ChainedValidator;

    public function nullOrPhone(?string $countryCode = null): ChainedValidator;

    public function nullOrPhpLabel(): ChainedValidator;

    public function nullOrPis(): ChainedValidator;

    public function nullOrPolishIdCard(): ChainedValidator;

    public function nullOrPortugueseNif(): ChainedValidator;

    public function nullOrPositive(): ChainedValidator;

    public function nullOrPostalCode(string $countryCode, bool $formatted = false): ChainedValidator;

    public function nullOrPrimeNumber(): ChainedValidator;

    public function nullOrPrintable(string ...$additionalChars): ChainedValidator;

    public function nullOrProperty(string $propertyName, Validatable $rule): ChainedValidator;

    public function nullOrPropertyExists(string $propertyName): ChainedValidator;

    public function nullOrPropertyOptional(string $propertyName, Validatable $rule): ChainedValidator;

    public function nullOrPublicDomainSuffix(): ChainedValidator;

    public function nullOrPunct(string ...$additionalChars): ChainedValidator;

    public function nullOrReadable(): ChainedValidator;

    public function nullOrRegex(string $regex): ChainedValidator;

    public function nullOrResourceType(): ChainedValidator;

    public function nullOrRoman(): ChainedValidator;

    public function nullOrScalarVal(): ChainedValidator;

    public function nullOrSize(string|int|null $minSize = null, string|int|null $maxSize = null): ChainedValidator;

    public function nullOrSlug(): ChainedValidator;

    public function nullOrSorted(string $direction): ChainedValidator;

    public function nullOrSpace(string ...$additionalChars): ChainedValidator;

    public function nullOrStartsWith(mixed $startValue, bool $identical = false): ChainedValidator;

    public function nullOrStringType(): ChainedValidator;

    public function nullOrStringVal(): ChainedValidator;

    public function nullOrSubdivisionCode(string $countryCode): ChainedValidator;

    /**
     * @param mixed[] $superset
     */
    public function nullOrSubset(array $superset): ChainedValidator;

    public function nullOrSymbolicLink(): ChainedValidator;

    public function nullOrTime(string $format = 'H:i:s'): ChainedValidator;

    public function nullOrTld(): ChainedValidator;

    public function nullOrTrueVal(): ChainedValidator;

    public function nullOrUnique(): ChainedValidator;

    public function nullOrUploaded(): ChainedValidator;

    public function nullOrUppercase(): ChainedValidator;

    public function nullOrUrl(): ChainedValidator;

    public function nullOrUuid(?int $version = null): ChainedValidator;

    public function nullOrVersion(): ChainedValidator;

    public function nullOrVideoUrl(?string $service = null): ChainedValidator;

    public function nullOrVowel(string ...$additionalChars): ChainedValidator;

    public function nullOrWhen(Validatable $when, Validatable $then, ?Validatable $else = null): ChainedValidator;

    public function nullOrWritable(): ChainedValidator;

    public function nullOrXdigit(string ...$additionalChars): ChainedValidator;

    public function nullOrYes(bool $useLocale = false): ChainedValidator;
}
