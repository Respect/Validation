<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Mixins;

use DateTimeImmutable;
use Respect\Validation\Rule;

interface NullOrChain
{
    public function nullOrAllOf(Rule $rule1, Rule $rule2, Rule ...$rules): Chain;

    public function nullOrAlnum(string ...$additionalChars): Chain;

    public function nullOrAlpha(string ...$additionalChars): Chain;

    public function nullOrAlwaysInvalid(): Chain;

    public function nullOrAlwaysValid(): Chain;

    public function nullOrAnyOf(Rule $rule1, Rule $rule2, Rule ...$rules): Chain;

    public function nullOrArrayType(): Chain;

    public function nullOrArrayVal(): Chain;

    public function nullOrAttributes(): Chain;

    public function nullOrBase(
        int $base,
        string $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
    ): Chain;

    public function nullOrBase64(): Chain;

    public function nullOrBetween(mixed $minValue, mixed $maxValue): Chain;

    public function nullOrBetweenExclusive(mixed $minimum, mixed $maximum): Chain;

    public function nullOrBoolType(): Chain;

    public function nullOrBoolVal(): Chain;

    public function nullOrBsn(): Chain;

    public function nullOrCall(callable $callable, Rule $rule): Chain;

    public function nullOrCallableType(): Chain;

    public function nullOrCallback(callable $callback, mixed ...$arguments): Chain;

    public function nullOrCharset(string $charset, string ...$charsets): Chain;

    public function nullOrCircuit(Rule $rule1, Rule $rule2, Rule ...$rules): Chain;

    public function nullOrCnh(): Chain;

    public function nullOrCnpj(): Chain;

    public function nullOrConsonant(string ...$additionalChars): Chain;

    public function nullOrContains(mixed $containsValue, bool $identical = false): Chain;

    /** @param non-empty-array<mixed> $needles */
    public function nullOrContainsAny(array $needles, bool $identical = false): Chain;

    public function nullOrControl(string ...$additionalChars): Chain;

    public function nullOrCountable(): Chain;

    /** @param "alpha-2"|"alpha-3"|"numeric" $set */
    public function nullOrCountryCode(string $set = 'alpha-2'): Chain;

    public function nullOrCpf(): Chain;

    public function nullOrCreditCard(string $brand = 'Any'): Chain;

    /** @param "alpha-3"|"numeric" $set */
    public function nullOrCurrencyCode(string $set = 'alpha-3'): Chain;

    public function nullOrDate(string $format = 'Y-m-d'): Chain;

    public function nullOrDateTime(string|null $format = null): Chain;

    /** @param "years"|"months"|"days"|"hours"|"minutes"|"seconds"|"microseconds" $type */
    public function nullOrDateTimeDiff(
        string $type,
        Rule $rule,
        string|null $format = null,
        DateTimeImmutable|null $now = null,
    ): Chain;

    public function nullOrDecimal(int $decimals): Chain;

    public function nullOrDigit(string ...$additionalChars): Chain;

    public function nullOrDirectory(): Chain;

    public function nullOrDomain(bool $tldCheck = true): Chain;

    public function nullOrEach(Rule $rule): Chain;

    public function nullOrEmail(): Chain;

    public function nullOrEndsWith(mixed $endValue, bool $identical = false): Chain;

    public function nullOrEquals(mixed $compareTo): Chain;

    public function nullOrEquivalent(mixed $compareTo): Chain;

    public function nullOrEven(): Chain;

    public function nullOrExecutable(): Chain;

    public function nullOrExists(): Chain;

    public function nullOrExtension(string $extension): Chain;

    public function nullOrFactor(int $dividend): Chain;

    public function nullOrFalseVal(): Chain;

    public function nullOrFibonacci(): Chain;

    public function nullOrFile(): Chain;

    public function nullOrFilterVar(int $filter, mixed $options = null): Chain;

    public function nullOrFinite(): Chain;

    public function nullOrFloatType(): Chain;

    public function nullOrFloatVal(): Chain;

    public function nullOrGraph(string ...$additionalChars): Chain;

    public function nullOrGreaterThan(mixed $compareTo): Chain;

    public function nullOrGreaterThanOrEqual(mixed $compareTo): Chain;

    public function nullOrHetu(): Chain;

    public function nullOrHexRgbColor(): Chain;

    public function nullOrIban(): Chain;

    public function nullOrIdentical(mixed $compareTo): Chain;

    public function nullOrImage(): Chain;

    public function nullOrImei(): Chain;

    public function nullOrIn(mixed $haystack, bool $compareIdentical = false): Chain;

    public function nullOrInfinite(): Chain;

    /** @param class-string $class */
    public function nullOrInstance(string $class): Chain;

    public function nullOrIntType(): Chain;

    public function nullOrIntVal(): Chain;

    public function nullOrIp(string $range = '*', int|null $options = null): Chain;

    public function nullOrIsbn(): Chain;

    public function nullOrIterableType(): Chain;

    public function nullOrIterableVal(): Chain;

    public function nullOrJson(): Chain;

    public function nullOrKey(string|int $key, Rule $rule): Chain;

    public function nullOrKeyExists(string|int $key): Chain;

    public function nullOrKeyOptional(string|int $key, Rule $rule): Chain;

    public function nullOrKeySet(Rule $rule, Rule ...$rules): Chain;

    /** @param "alpha-2"|"alpha-3" $set */
    public function nullOrLanguageCode(string $set = 'alpha-2'): Chain;

    /** @param callable(mixed): Rule $ruleCreator */
    public function nullOrLazy(callable $ruleCreator): Chain;

    public function nullOrLeapDate(string $format): Chain;

    public function nullOrLeapYear(): Chain;

    public function nullOrLength(Rule $rule): Chain;

    public function nullOrLessThan(mixed $compareTo): Chain;

    public function nullOrLessThanOrEqual(mixed $compareTo): Chain;

    public function nullOrLowercase(): Chain;

    public function nullOrLuhn(): Chain;

    public function nullOrMacAddress(): Chain;

    public function nullOrMax(Rule $rule): Chain;

    public function nullOrMimetype(string $mimetype): Chain;

    public function nullOrMin(Rule $rule): Chain;

    public function nullOrMultiple(int $multipleOf): Chain;

    public function nullOrNegative(): Chain;

    public function nullOrNfeAccessKey(): Chain;

    public function nullOrNif(): Chain;

    public function nullOrNip(): Chain;

    public function nullOrNo(bool $useLocale = false): Chain;

    public function nullOrNoneOf(Rule $rule1, Rule $rule2, Rule ...$rules): Chain;

    public function nullOrNot(Rule $rule): Chain;

    public function nullOrNotEmoji(): Chain;

    public function nullOrNotEmpty(): Chain;

    public function nullOrNullType(): Chain;

    public function nullOrNumber(): Chain;

    public function nullOrNumericVal(): Chain;

    public function nullOrObjectType(): Chain;

    public function nullOrOdd(): Chain;

    public function nullOrOneOf(Rule $rule1, Rule $rule2, Rule ...$rules): Chain;

    public function nullOrPerfectSquare(): Chain;

    public function nullOrPesel(): Chain;

    public function nullOrPhone(string|null $countryCode = null): Chain;

    public function nullOrPhpLabel(): Chain;

    public function nullOrPis(): Chain;

    public function nullOrPolishIdCard(): Chain;

    public function nullOrPortugueseNif(): Chain;

    public function nullOrPositive(): Chain;

    public function nullOrPostalCode(string $countryCode, bool $formatted = false): Chain;

    public function nullOrPrimeNumber(): Chain;

    public function nullOrPrintable(string ...$additionalChars): Chain;

    public function nullOrProperty(string $propertyName, Rule $rule): Chain;

    public function nullOrPropertyExists(string $propertyName): Chain;

    public function nullOrPropertyOptional(string $propertyName, Rule $rule): Chain;

    public function nullOrPublicDomainSuffix(): Chain;

    public function nullOrPunct(string ...$additionalChars): Chain;

    public function nullOrReadable(): Chain;

    public function nullOrRegex(string $regex): Chain;

    public function nullOrResourceType(): Chain;

    public function nullOrRoman(): Chain;

    public function nullOrScalarVal(): Chain;

    /** @param "B"|"KB"|"MB"|"GB"|"TB"|"PB"|"EB"|"ZB"|"YB" $unit */
    public function nullOrSize(string $unit, Rule $rule): Chain;

    public function nullOrSlug(): Chain;

    public function nullOrSorted(string $direction): Chain;

    public function nullOrSpace(string ...$additionalChars): Chain;

    public function nullOrSpaced(): Chain;

    public function nullOrStartsWith(mixed $startValue, bool $identical = false): Chain;

    public function nullOrStringType(): Chain;

    public function nullOrStringVal(): Chain;

    public function nullOrSubdivisionCode(string $countryCode): Chain;

    /** @param mixed[] $superset */
    public function nullOrSubset(array $superset): Chain;

    public function nullOrSymbolicLink(): Chain;

    public function nullOrTime(string $format = 'H:i:s'): Chain;

    public function nullOrTld(): Chain;

    public function nullOrTrueVal(): Chain;

    public function nullOrUnique(): Chain;

    public function nullOrUploaded(): Chain;

    public function nullOrUppercase(): Chain;

    public function nullOrUrl(): Chain;

    public function nullOrUuid(int|null $version = null): Chain;

    public function nullOrVersion(): Chain;

    public function nullOrVideoUrl(string|null $service = null): Chain;

    public function nullOrVowel(string ...$additionalChars): Chain;

    public function nullOrWhen(Rule $when, Rule $then, Rule|null $else = null): Chain;

    public function nullOrWritable(): Chain;

    public function nullOrXdigit(string ...$additionalChars): Chain;

    public function nullOrYes(bool $useLocale = false): Chain;
}
