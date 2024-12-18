<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Mixins;

use DateTimeImmutable;
use Respect\Validation\Rule;

interface UndefOrBuilder
{
    public static function undefOrAllOf(Rule $rule1, Rule $rule2, Rule ...$rules): Chain;

    public static function undefOrAlnum(string ...$additionalChars): Chain;

    public static function undefOrAlpha(string ...$additionalChars): Chain;

    public static function undefOrAlwaysInvalid(): Chain;

    public static function undefOrAlwaysValid(): Chain;

    public static function undefOrAnyOf(Rule $rule1, Rule $rule2, Rule ...$rules): Chain;

    public static function undefOrArrayType(): Chain;

    public static function undefOrArrayVal(): Chain;

    public static function undefOrBase(
        int $base,
        string $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
    ): Chain;

    public static function undefOrBase64(): Chain;

    public static function undefOrBetween(mixed $minValue, mixed $maxValue): Chain;

    public static function undefOrBetweenExclusive(mixed $minimum, mixed $maximum): Chain;

    public static function undefOrBoolType(): Chain;

    public static function undefOrBoolVal(): Chain;

    public static function undefOrBsn(): Chain;

    public static function undefOrCall(callable $callable, Rule $rule): Chain;

    public static function undefOrCallableType(): Chain;

    public static function undefOrCallback(callable $callback, mixed ...$arguments): Chain;

    public static function undefOrCharset(string $charset, string ...$charsets): Chain;

    public static function undefOrCnh(): Chain;

    public static function undefOrCnpj(): Chain;

    public static function undefOrConsecutive(Rule $rule1, Rule $rule2, Rule ...$rules): Chain;

    public static function undefOrConsonant(string ...$additionalChars): Chain;

    public static function undefOrContains(mixed $containsValue, bool $identical = false): Chain;

    /**
     * @param non-empty-array<mixed> $needles
     */
    public static function undefOrContainsAny(array $needles, bool $identical = false): Chain;

    public static function undefOrControl(string ...$additionalChars): Chain;

    public static function undefOrCountable(): Chain;

    /**
     * @param "alpha-2"|"alpha-3"|"numeric" $set
     */
    public static function undefOrCountryCode(string $set = 'alpha-2'): Chain;

    public static function undefOrCpf(): Chain;

    public static function undefOrCreditCard(string $brand = 'Any'): Chain;

    /**
     * @param "alpha-3"|"numeric" $set
     */
    public static function undefOrCurrencyCode(string $set = 'alpha-3'): Chain;

    public static function undefOrDate(string $format = 'Y-m-d'): Chain;

    public static function undefOrDateTime(?string $format = null): Chain;

    /**
     * @param "years"|"months"|"days"|"hours"|"minutes"|"seconds"|"microseconds" $type
     */
    public static function undefOrDateTimeDiff(
        string $type,
        Rule $rule,
        ?string $format = null,
        ?DateTimeImmutable $now = null,
    ): Chain;

    public static function undefOrDecimal(int $decimals): Chain;

    public static function undefOrDigit(string ...$additionalChars): Chain;

    public static function undefOrDirectory(): Chain;

    public static function undefOrDomain(bool $tldCheck = true): Chain;

    public static function undefOrEach(Rule $rule): Chain;

    public static function undefOrEmail(): Chain;

    public static function undefOrEndsWith(mixed $endValue, bool $identical = false): Chain;

    public static function undefOrEquals(mixed $compareTo): Chain;

    public static function undefOrEquivalent(mixed $compareTo): Chain;

    public static function undefOrEven(): Chain;

    public static function undefOrExecutable(): Chain;

    public static function undefOrExists(): Chain;

    public static function undefOrExtension(string $extension): Chain;

    public static function undefOrFactor(int $dividend): Chain;

    public static function undefOrFalseVal(): Chain;

    public static function undefOrFibonacci(): Chain;

    public static function undefOrFile(): Chain;

    public static function undefOrFilterVar(int $filter, mixed $options = null): Chain;

    public static function undefOrFinite(): Chain;

    public static function undefOrFloatType(): Chain;

    public static function undefOrFloatVal(): Chain;

    public static function undefOrGraph(string ...$additionalChars): Chain;

    public static function undefOrGreaterThan(mixed $compareTo): Chain;

    public static function undefOrGreaterThanOrEqual(mixed $compareTo): Chain;

    public static function undefOrHetu(): Chain;

    public static function undefOrHexRgbColor(): Chain;

    public static function undefOrIban(): Chain;

    public static function undefOrIdentical(mixed $compareTo): Chain;

    public static function undefOrImage(): Chain;

    public static function undefOrImei(): Chain;

    public static function undefOrIn(mixed $haystack, bool $compareIdentical = false): Chain;

    public static function undefOrInfinite(): Chain;

    /**
     * @param class-string $class
     */
    public static function undefOrInstance(string $class): Chain;

    public static function undefOrIntType(): Chain;

    public static function undefOrIntVal(): Chain;

    public static function undefOrIp(string $range = '*', ?int $options = null): Chain;

    public static function undefOrIsbn(): Chain;

    public static function undefOrIterableType(): Chain;

    public static function undefOrIterableVal(): Chain;

    public static function undefOrJson(): Chain;

    public static function undefOrKey(string|int $key, Rule $rule): Chain;

    public static function undefOrKeyExists(string|int $key): Chain;

    public static function undefOrKeyOptional(string|int $key, Rule $rule): Chain;

    public static function undefOrKeySet(Rule $rule, Rule ...$rules): Chain;

    /**
     * @param "alpha-2"|"alpha-3" $set
     */
    public static function undefOrLanguageCode(string $set = 'alpha-2'): Chain;

    /**
     * @param callable(mixed): Rule $ruleCreator
     */
    public static function undefOrLazy(callable $ruleCreator): Chain;

    public static function undefOrLeapDate(string $format): Chain;

    public static function undefOrLeapYear(): Chain;

    public static function undefOrLength(Rule $rule): Chain;

    public static function undefOrLessThan(mixed $compareTo): Chain;

    public static function undefOrLessThanOrEqual(mixed $compareTo): Chain;

    public static function undefOrLowercase(): Chain;

    public static function undefOrLuhn(): Chain;

    public static function undefOrMacAddress(): Chain;

    public static function undefOrMax(Rule $rule): Chain;

    public static function undefOrMimetype(string $mimetype): Chain;

    public static function undefOrMin(Rule $rule): Chain;

    public static function undefOrMultiple(int $multipleOf): Chain;

    public static function undefOrNegative(): Chain;

    public static function undefOrNfeAccessKey(): Chain;

    public static function undefOrNif(): Chain;

    public static function undefOrNip(): Chain;

    public static function undefOrNo(bool $useLocale = false): Chain;

    public static function undefOrNoWhitespace(): Chain;

    public static function undefOrNoneOf(Rule $rule1, Rule $rule2, Rule ...$rules): Chain;

    public static function undefOrNot(Rule $rule): Chain;

    public static function undefOrNotBlank(): Chain;

    public static function undefOrNotEmoji(): Chain;

    public static function undefOrNotEmpty(): Chain;

    public static function undefOrNullType(): Chain;

    public static function undefOrNumber(): Chain;

    public static function undefOrNumericVal(): Chain;

    public static function undefOrObjectType(): Chain;

    public static function undefOrOdd(): Chain;

    public static function undefOrOneOf(Rule $rule1, Rule $rule2, Rule ...$rules): Chain;

    public static function undefOrPerfectSquare(): Chain;

    public static function undefOrPesel(): Chain;

    public static function undefOrPhone(?string $countryCode = null): Chain;

    public static function undefOrPhpLabel(): Chain;

    public static function undefOrPis(): Chain;

    public static function undefOrPolishIdCard(): Chain;

    public static function undefOrPortugueseNif(): Chain;

    public static function undefOrPositive(): Chain;

    public static function undefOrPostalCode(string $countryCode, bool $formatted = false): Chain;

    public static function undefOrPrimeNumber(): Chain;

    public static function undefOrPrintable(string ...$additionalChars): Chain;

    public static function undefOrProperty(string $propertyName, Rule $rule): Chain;

    public static function undefOrPropertyExists(string $propertyName): Chain;

    public static function undefOrPropertyOptional(string $propertyName, Rule $rule): Chain;

    public static function undefOrPublicDomainSuffix(): Chain;

    public static function undefOrPunct(string ...$additionalChars): Chain;

    public static function undefOrReadable(): Chain;

    public static function undefOrRegex(string $regex): Chain;

    public static function undefOrResourceType(): Chain;

    public static function undefOrRoman(): Chain;

    public static function undefOrScalarVal(): Chain;

    /**
     * @param "B"|"KB"|"MB"|"GB"|"TB"|"PB"|"EB"|"ZB"|"YB" $unit
     */
    public static function undefOrSize(string $unit, Rule $rule): Chain;

    public static function undefOrSlug(): Chain;

    public static function undefOrSorted(string $direction): Chain;

    public static function undefOrSpace(string ...$additionalChars): Chain;

    public static function undefOrStartsWith(mixed $startValue, bool $identical = false): Chain;

    public static function undefOrStringType(): Chain;

    public static function undefOrStringVal(): Chain;

    public static function undefOrSubdivisionCode(string $countryCode): Chain;

    /**
     * @param mixed[] $superset
     */
    public static function undefOrSubset(array $superset): Chain;

    public static function undefOrSymbolicLink(): Chain;

    public static function undefOrTime(string $format = 'H:i:s'): Chain;

    public static function undefOrTld(): Chain;

    public static function undefOrTrueVal(): Chain;

    public static function undefOrUnique(): Chain;

    public static function undefOrUploaded(): Chain;

    public static function undefOrUppercase(): Chain;

    public static function undefOrUrl(): Chain;

    public static function undefOrUuid(?int $version = null): Chain;

    public static function undefOrVersion(): Chain;

    public static function undefOrVideoUrl(?string $service = null): Chain;

    public static function undefOrVowel(string ...$additionalChars): Chain;

    public static function undefOrWhen(Rule $when, Rule $then, ?Rule $else = null): Chain;

    public static function undefOrWritable(): Chain;

    public static function undefOrXdigit(string ...$additionalChars): Chain;

    public static function undefOrYes(bool $useLocale = false): Chain;
}
