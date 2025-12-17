<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Mixins;

use DateTimeImmutable;
use Respect\Validation\Rule;

interface NullOrBuilder
{
    public static function nullOrAllOf(Rule $rule1, Rule $rule2, Rule ...$rules): Chain;

    public static function nullOrAlnum(string ...$additionalChars): Chain;

    public static function nullOrAlpha(string ...$additionalChars): Chain;

    public static function nullOrAlwaysInvalid(): Chain;

    public static function nullOrAlwaysValid(): Chain;

    public static function nullOrAnyOf(Rule $rule1, Rule $rule2, Rule ...$rules): Chain;

    public static function nullOrArrayType(): Chain;

    public static function nullOrArrayVal(): Chain;

    public static function nullOrAttributes(): Chain;

    public static function nullOrBase(
        int $base,
        string $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
    ): Chain;

    public static function nullOrBase64(): Chain;

    public static function nullOrBetween(mixed $minValue, mixed $maxValue): Chain;

    public static function nullOrBetweenExclusive(mixed $minimum, mixed $maximum): Chain;

    public static function nullOrBoolType(): Chain;

    public static function nullOrBoolVal(): Chain;

    public static function nullOrBsn(): Chain;

    public static function nullOrCall(callable $callable, Rule $rule): Chain;

    public static function nullOrCallableType(): Chain;

    public static function nullOrCallback(callable $callback, mixed ...$arguments): Chain;

    public static function nullOrCharset(string $charset, string ...$charsets): Chain;

    public static function nullOrCircuit(Rule $rule1, Rule $rule2, Rule ...$rules): Chain;

    public static function nullOrCnh(): Chain;

    public static function nullOrCnpj(): Chain;

    public static function nullOrConsonant(string ...$additionalChars): Chain;

    public static function nullOrContains(mixed $containsValue, bool $identical = false): Chain;

    /** @param non-empty-array<mixed> $needles */
    public static function nullOrContainsAny(array $needles, bool $identical = false): Chain;

    public static function nullOrControl(string ...$additionalChars): Chain;

    public static function nullOrCountable(): Chain;

    /** @param "alpha-2"|"alpha-3"|"numeric" $set */
    public static function nullOrCountryCode(string $set = 'alpha-2'): Chain;

    public static function nullOrCpf(): Chain;

    public static function nullOrCreditCard(string $brand = 'Any'): Chain;

    /** @param "alpha-3"|"numeric" $set */
    public static function nullOrCurrencyCode(string $set = 'alpha-3'): Chain;

    public static function nullOrDate(string $format = 'Y-m-d'): Chain;

    public static function nullOrDateTime(string|null $format = null): Chain;

    /** @param "years"|"months"|"days"|"hours"|"minutes"|"seconds"|"microseconds" $type */
    public static function nullOrDateTimeDiff(
        string $type,
        Rule $rule,
        string|null $format = null,
        DateTimeImmutable|null $now = null,
    ): Chain;

    public static function nullOrDecimal(int $decimals): Chain;

    public static function nullOrDigit(string ...$additionalChars): Chain;

    public static function nullOrDirectory(): Chain;

    public static function nullOrDomain(bool $tldCheck = true): Chain;

    public static function nullOrEach(Rule $rule): Chain;

    public static function nullOrEmail(): Chain;

    public static function nullOrEndsWith(mixed $endValue, bool $identical = false): Chain;

    public static function nullOrEquals(mixed $compareTo): Chain;

    public static function nullOrEquivalent(mixed $compareTo): Chain;

    public static function nullOrEven(): Chain;

    public static function nullOrExecutable(): Chain;

    public static function nullOrExists(): Chain;

    public static function nullOrExtension(string $extension): Chain;

    public static function nullOrFactor(int $dividend): Chain;

    public static function nullOrFalseVal(): Chain;

    public static function nullOrFibonacci(): Chain;

    public static function nullOrFile(): Chain;

    public static function nullOrFilterVar(int $filter, mixed $options = null): Chain;

    public static function nullOrFinite(): Chain;

    public static function nullOrFloatType(): Chain;

    public static function nullOrFloatVal(): Chain;

    public static function nullOrGraph(string ...$additionalChars): Chain;

    public static function nullOrGreaterThan(mixed $compareTo): Chain;

    public static function nullOrGreaterThanOrEqual(mixed $compareTo): Chain;

    public static function nullOrHetu(): Chain;

    public static function nullOrHexRgbColor(): Chain;

    public static function nullOrIban(): Chain;

    public static function nullOrIdentical(mixed $compareTo): Chain;

    public static function nullOrImage(): Chain;

    public static function nullOrImei(): Chain;

    public static function nullOrIn(mixed $haystack, bool $compareIdentical = false): Chain;

    public static function nullOrInfinite(): Chain;

    /** @param class-string $class */
    public static function nullOrInstance(string $class): Chain;

    public static function nullOrIntType(): Chain;

    public static function nullOrIntVal(): Chain;

    public static function nullOrIp(string $range = '*', int|null $options = null): Chain;

    public static function nullOrIsbn(): Chain;

    public static function nullOrIterableType(): Chain;

    public static function nullOrIterableVal(): Chain;

    public static function nullOrJson(): Chain;

    public static function nullOrKey(string|int $key, Rule $rule): Chain;

    public static function nullOrKeyExists(string|int $key): Chain;

    public static function nullOrKeyOptional(string|int $key, Rule $rule): Chain;

    public static function nullOrKeySet(Rule $rule, Rule ...$rules): Chain;

    /** @param "alpha-2"|"alpha-3" $set */
    public static function nullOrLanguageCode(string $set = 'alpha-2'): Chain;

    /** @param callable(mixed): Rule $ruleCreator */
    public static function nullOrLazy(callable $ruleCreator): Chain;

    public static function nullOrLeapDate(string $format): Chain;

    public static function nullOrLeapYear(): Chain;

    public static function nullOrLength(Rule $rule): Chain;

    public static function nullOrLessThan(mixed $compareTo): Chain;

    public static function nullOrLessThanOrEqual(mixed $compareTo): Chain;

    public static function nullOrLowercase(): Chain;

    public static function nullOrLuhn(): Chain;

    public static function nullOrMacAddress(): Chain;

    public static function nullOrMax(Rule $rule): Chain;

    public static function nullOrMimetype(string $mimetype): Chain;

    public static function nullOrMin(Rule $rule): Chain;

    public static function nullOrMultiple(int $multipleOf): Chain;

    public static function nullOrNegative(): Chain;

    public static function nullOrNfeAccessKey(): Chain;

    public static function nullOrNif(): Chain;

    public static function nullOrNip(): Chain;

    public static function nullOrNo(bool $useLocale = false): Chain;

    public static function nullOrNoWhitespace(): Chain;

    public static function nullOrNoneOf(Rule $rule1, Rule $rule2, Rule ...$rules): Chain;

    public static function nullOrNot(Rule $rule): Chain;

    public static function nullOrNotBlank(): Chain;

    public static function nullOrNotEmoji(): Chain;

    public static function nullOrNotEmpty(): Chain;

    public static function nullOrNullType(): Chain;

    public static function nullOrNumber(): Chain;

    public static function nullOrNumericVal(): Chain;

    public static function nullOrObjectType(): Chain;

    public static function nullOrOdd(): Chain;

    public static function nullOrOneOf(Rule $rule1, Rule $rule2, Rule ...$rules): Chain;

    public static function nullOrPerfectSquare(): Chain;

    public static function nullOrPesel(): Chain;

    public static function nullOrPhone(string|null $countryCode = null): Chain;

    public static function nullOrPhpLabel(): Chain;

    public static function nullOrPis(): Chain;

    public static function nullOrPolishIdCard(): Chain;

    public static function nullOrPortugueseNif(): Chain;

    public static function nullOrPositive(): Chain;

    public static function nullOrPostalCode(string $countryCode, bool $formatted = false): Chain;

    public static function nullOrPrimeNumber(): Chain;

    public static function nullOrPrintable(string ...$additionalChars): Chain;

    public static function nullOrProperty(string $propertyName, Rule $rule): Chain;

    public static function nullOrPropertyExists(string $propertyName): Chain;

    public static function nullOrPropertyOptional(string $propertyName, Rule $rule): Chain;

    public static function nullOrPublicDomainSuffix(): Chain;

    public static function nullOrPunct(string ...$additionalChars): Chain;

    public static function nullOrReadable(): Chain;

    public static function nullOrRegex(string $regex): Chain;

    public static function nullOrResourceType(): Chain;

    public static function nullOrRoman(): Chain;

    public static function nullOrScalarVal(): Chain;

    /** @param "B"|"KB"|"MB"|"GB"|"TB"|"PB"|"EB"|"ZB"|"YB" $unit */
    public static function nullOrSize(string $unit, Rule $rule): Chain;

    public static function nullOrSlug(): Chain;

    public static function nullOrSorted(string $direction): Chain;

    public static function nullOrSpace(string ...$additionalChars): Chain;

    public static function nullOrStartsWith(mixed $startValue, bool $identical = false): Chain;

    public static function nullOrStringType(): Chain;

    public static function nullOrStringVal(): Chain;

    public static function nullOrSubdivisionCode(string $countryCode): Chain;

    /** @param mixed[] $superset */
    public static function nullOrSubset(array $superset): Chain;

    public static function nullOrSymbolicLink(): Chain;

    public static function nullOrTime(string $format = 'H:i:s'): Chain;

    public static function nullOrTld(): Chain;

    public static function nullOrTrueVal(): Chain;

    public static function nullOrUnique(): Chain;

    public static function nullOrUploaded(): Chain;

    public static function nullOrUppercase(): Chain;

    public static function nullOrUrl(): Chain;

    public static function nullOrUuid(int|null $version = null): Chain;

    public static function nullOrVersion(): Chain;

    public static function nullOrVideoUrl(string|null $service = null): Chain;

    public static function nullOrVowel(string ...$additionalChars): Chain;

    public static function nullOrWhen(Rule $when, Rule $then, Rule|null $else = null): Chain;

    public static function nullOrWritable(): Chain;

    public static function nullOrXdigit(string ...$additionalChars): Chain;

    public static function nullOrYes(bool $useLocale = false): Chain;
}
