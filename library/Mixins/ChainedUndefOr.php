<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Mixins;

use DateTimeImmutable;
use Respect\Validation\Rule;

interface ChainedUndefOr
{
    public function undefOrAllOf(Rule $rule1, Rule $rule2, Rule ...$rules): ChainedValidator;

    public function undefOrAlnum(string ...$additionalChars): ChainedValidator;

    public function undefOrAlpha(string ...$additionalChars): ChainedValidator;

    public function undefOrAlwaysInvalid(): ChainedValidator;

    public function undefOrAlwaysValid(): ChainedValidator;

    public function undefOrAnyOf(Rule $rule1, Rule $rule2, Rule ...$rules): ChainedValidator;

    public function undefOrArrayType(): ChainedValidator;

    public function undefOrArrayVal(): ChainedValidator;

    public function undefOrBase(
        int $base,
        string $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
    ): ChainedValidator;

    public function undefOrBase64(): ChainedValidator;

    public function undefOrBetween(mixed $minValue, mixed $maxValue): ChainedValidator;

    public function undefOrBetweenExclusive(mixed $minimum, mixed $maximum): ChainedValidator;

    public function undefOrBoolType(): ChainedValidator;

    public function undefOrBoolVal(): ChainedValidator;

    public function undefOrBsn(): ChainedValidator;

    public function undefOrCall(callable $callable, Rule $rule): ChainedValidator;

    public function undefOrCallableType(): ChainedValidator;

    public function undefOrCallback(callable $callback, mixed ...$arguments): ChainedValidator;

    public function undefOrCharset(string $charset, string ...$charsets): ChainedValidator;

    public function undefOrCnh(): ChainedValidator;

    public function undefOrCnpj(): ChainedValidator;

    public function undefOrConsecutive(Rule $rule1, Rule $rule2, Rule ...$rules): ChainedValidator;

    public function undefOrConsonant(string ...$additionalChars): ChainedValidator;

    public function undefOrContains(mixed $containsValue, bool $identical = false): ChainedValidator;

    /**
     * @param non-empty-array<mixed> $needles
     */
    public function undefOrContainsAny(array $needles, bool $identical = false): ChainedValidator;

    public function undefOrControl(string ...$additionalChars): ChainedValidator;

    public function undefOrCountable(): ChainedValidator;

    /**
     * @param "alpha-2"|"alpha-3"|"numeric" $set
     */
    public function undefOrCountryCode(string $set = 'alpha-2'): ChainedValidator;

    public function undefOrCpf(): ChainedValidator;

    public function undefOrCreditCard(string $brand = 'Any'): ChainedValidator;

    /**
     * @param "alpha-3"|"numeric" $set
     */
    public function undefOrCurrencyCode(string $set = 'alpha-3'): ChainedValidator;

    public function undefOrDate(string $format = 'Y-m-d'): ChainedValidator;

    public function undefOrDateTime(?string $format = null): ChainedValidator;

    /**
     * @param "years"|"months"|"days"|"hours"|"minutes"|"seconds"|"microseconds" $type
     */
    public function undefOrDateTimeDiff(
        string $type,
        Rule $rule,
        ?string $format = null,
        ?DateTimeImmutable $now = null,
    ): ChainedValidator;

    public function undefOrDecimal(int $decimals): ChainedValidator;

    public function undefOrDigit(string ...$additionalChars): ChainedValidator;

    public function undefOrDirectory(): ChainedValidator;

    public function undefOrDomain(bool $tldCheck = true): ChainedValidator;

    public function undefOrEach(Rule $rule): ChainedValidator;

    public function undefOrEmail(): ChainedValidator;

    public function undefOrEndsWith(mixed $endValue, bool $identical = false): ChainedValidator;

    public function undefOrEquals(mixed $compareTo): ChainedValidator;

    public function undefOrEquivalent(mixed $compareTo): ChainedValidator;

    public function undefOrEven(): ChainedValidator;

    public function undefOrExecutable(): ChainedValidator;

    public function undefOrExists(): ChainedValidator;

    public function undefOrExtension(string $extension): ChainedValidator;

    public function undefOrFactor(int $dividend): ChainedValidator;

    public function undefOrFalseVal(): ChainedValidator;

    public function undefOrFibonacci(): ChainedValidator;

    public function undefOrFile(): ChainedValidator;

    public function undefOrFilterVar(int $filter, mixed $options = null): ChainedValidator;

    public function undefOrFinite(): ChainedValidator;

    public function undefOrFloatType(): ChainedValidator;

    public function undefOrFloatVal(): ChainedValidator;

    public function undefOrGraph(string ...$additionalChars): ChainedValidator;

    public function undefOrGreaterThan(mixed $compareTo): ChainedValidator;

    public function undefOrGreaterThanOrEqual(mixed $compareTo): ChainedValidator;

    public function undefOrHetu(): ChainedValidator;

    public function undefOrHexRgbColor(): ChainedValidator;

    public function undefOrIban(): ChainedValidator;

    public function undefOrIdentical(mixed $compareTo): ChainedValidator;

    public function undefOrImage(): ChainedValidator;

    public function undefOrImei(): ChainedValidator;

    public function undefOrIn(mixed $haystack, bool $compareIdentical = false): ChainedValidator;

    public function undefOrInfinite(): ChainedValidator;

    /**
     * @param class-string $class
     */
    public function undefOrInstance(string $class): ChainedValidator;

    public function undefOrIntType(): ChainedValidator;

    public function undefOrIntVal(): ChainedValidator;

    public function undefOrIp(string $range = '*', ?int $options = null): ChainedValidator;

    public function undefOrIsbn(): ChainedValidator;

    public function undefOrIterableType(): ChainedValidator;

    public function undefOrIterableVal(): ChainedValidator;

    public function undefOrJson(): ChainedValidator;

    public function undefOrKey(string|int $key, Rule $rule): ChainedValidator;

    public function undefOrKeyExists(string|int $key): ChainedValidator;

    public function undefOrKeyOptional(string|int $key, Rule $rule): ChainedValidator;

    public function undefOrKeySet(Rule $rule, Rule ...$rules): ChainedValidator;

    /**
     * @param "alpha-2"|"alpha-3" $set
     */
    public function undefOrLanguageCode(string $set = 'alpha-2'): ChainedValidator;

    /**
     * @param callable(mixed): Rule $ruleCreator
     */
    public function undefOrLazy(callable $ruleCreator): ChainedValidator;

    public function undefOrLeapDate(string $format): ChainedValidator;

    public function undefOrLeapYear(): ChainedValidator;

    public function undefOrLength(Rule $rule): ChainedValidator;

    public function undefOrLessThan(mixed $compareTo): ChainedValidator;

    public function undefOrLessThanOrEqual(mixed $compareTo): ChainedValidator;

    public function undefOrLowercase(): ChainedValidator;

    public function undefOrLuhn(): ChainedValidator;

    public function undefOrMacAddress(): ChainedValidator;

    public function undefOrMax(Rule $rule): ChainedValidator;

    public function undefOrMimetype(string $mimetype): ChainedValidator;

    public function undefOrMin(Rule $rule): ChainedValidator;

    public function undefOrMultiple(int $multipleOf): ChainedValidator;

    public function undefOrNegative(): ChainedValidator;

    public function undefOrNfeAccessKey(): ChainedValidator;

    public function undefOrNif(): ChainedValidator;

    public function undefOrNip(): ChainedValidator;

    public function undefOrNo(bool $useLocale = false): ChainedValidator;

    public function undefOrNoWhitespace(): ChainedValidator;

    public function undefOrNoneOf(Rule $rule1, Rule $rule2, Rule ...$rules): ChainedValidator;

    public function undefOrNot(Rule $rule): ChainedValidator;

    public function undefOrNotBlank(): ChainedValidator;

    public function undefOrNotEmoji(): ChainedValidator;

    public function undefOrNotEmpty(): ChainedValidator;

    public function undefOrNullType(): ChainedValidator;

    public function undefOrNumber(): ChainedValidator;

    public function undefOrNumericVal(): ChainedValidator;

    public function undefOrObjectType(): ChainedValidator;

    public function undefOrOdd(): ChainedValidator;

    public function undefOrOneOf(Rule $rule1, Rule $rule2, Rule ...$rules): ChainedValidator;

    public function undefOrPerfectSquare(): ChainedValidator;

    public function undefOrPesel(): ChainedValidator;

    public function undefOrPhone(?string $countryCode = null): ChainedValidator;

    public function undefOrPhpLabel(): ChainedValidator;

    public function undefOrPis(): ChainedValidator;

    public function undefOrPolishIdCard(): ChainedValidator;

    public function undefOrPortugueseNif(): ChainedValidator;

    public function undefOrPositive(): ChainedValidator;

    public function undefOrPostalCode(string $countryCode, bool $formatted = false): ChainedValidator;

    public function undefOrPrimeNumber(): ChainedValidator;

    public function undefOrPrintable(string ...$additionalChars): ChainedValidator;

    public function undefOrProperty(string $propertyName, Rule $rule): ChainedValidator;

    public function undefOrPropertyExists(string $propertyName): ChainedValidator;

    public function undefOrPropertyOptional(string $propertyName, Rule $rule): ChainedValidator;

    public function undefOrPublicDomainSuffix(): ChainedValidator;

    public function undefOrPunct(string ...$additionalChars): ChainedValidator;

    public function undefOrReadable(): ChainedValidator;

    public function undefOrRegex(string $regex): ChainedValidator;

    public function undefOrResourceType(): ChainedValidator;

    public function undefOrRoman(): ChainedValidator;

    public function undefOrScalarVal(): ChainedValidator;

    /**
     * @param "B"|"KB"|"MB"|"GB"|"TB"|"PB"|"EB"|"ZB"|"YB" $unit
     */
    public function undefOrSize(string $unit, Rule $rule): ChainedValidator;

    public function undefOrSlug(): ChainedValidator;

    public function undefOrSorted(string $direction): ChainedValidator;

    public function undefOrSpace(string ...$additionalChars): ChainedValidator;

    public function undefOrStartsWith(mixed $startValue, bool $identical = false): ChainedValidator;

    public function undefOrStringType(): ChainedValidator;

    public function undefOrStringVal(): ChainedValidator;

    public function undefOrSubdivisionCode(string $countryCode): ChainedValidator;

    /**
     * @param mixed[] $superset
     */
    public function undefOrSubset(array $superset): ChainedValidator;

    public function undefOrSymbolicLink(): ChainedValidator;

    public function undefOrTime(string $format = 'H:i:s'): ChainedValidator;

    public function undefOrTld(): ChainedValidator;

    public function undefOrTrueVal(): ChainedValidator;

    public function undefOrUnique(): ChainedValidator;

    public function undefOrUploaded(): ChainedValidator;

    public function undefOrUppercase(): ChainedValidator;

    public function undefOrUrl(): ChainedValidator;

    public function undefOrUuid(?int $version = null): ChainedValidator;

    public function undefOrVersion(): ChainedValidator;

    public function undefOrVideoUrl(?string $service = null): ChainedValidator;

    public function undefOrVowel(string ...$additionalChars): ChainedValidator;

    public function undefOrWhen(Rule $when, Rule $then, ?Rule $else = null): ChainedValidator;

    public function undefOrWritable(): ChainedValidator;

    public function undefOrXdigit(string ...$additionalChars): ChainedValidator;

    public function undefOrYes(bool $useLocale = false): ChainedValidator;
}
