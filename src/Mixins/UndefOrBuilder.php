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
use Respect\StringFormatter\Formatter;
use Respect\Validation\Validator;

interface UndefOrBuilder
{
    public static function undefOrAfter(callable $callable, Validator $validator): Chain;

    public static function undefOrAll(Validator $validator): Chain;

    public static function undefOrAllOf(Validator $validator1, Validator $validator2, Validator ...$validators): Chain;

    public static function undefOrAlnum(string ...$additionalChars): Chain;

    public static function undefOrAlpha(string ...$additionalChars): Chain;

    public static function undefOrAlwaysInvalid(): Chain;

    public static function undefOrAlwaysValid(): Chain;

    public static function undefOrAnyOf(Validator $validator1, Validator $validator2, Validator ...$validators): Chain;

    public static function undefOrArrayType(): Chain;

    public static function undefOrArrayVal(): Chain;

    public static function undefOrBase(int $base, string $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'): Chain;

    public static function undefOrBase64(): Chain;

    public static function undefOrBetween(mixed $minValue, mixed $maxValue): Chain;

    public static function undefOrBetweenExclusive(mixed $minimum, mixed $maximum): Chain;

    public static function undefOrBoolType(): Chain;

    public static function undefOrBoolVal(): Chain;

    public static function undefOrBsn(): Chain;

    public static function undefOrCallableType(): Chain;

    public static function undefOrCharset(string $charset, string ...$charsets): Chain;

    public static function undefOrCnh(): Chain;

    public static function undefOrCnpj(): Chain;

    public static function undefOrConsonant(string ...$additionalChars): Chain;

    public static function undefOrContains(mixed $containsValue): Chain;

    /** @param non-empty-array<mixed> $needles */
    public static function undefOrContainsAny(array $needles): Chain;

    public static function undefOrContainsCount(mixed $containsValue, int $count): Chain;

    public static function undefOrControl(string ...$additionalChars): Chain;

    public static function undefOrCountable(): Chain;

    /** @param "alpha-2"|"alpha-3"|"numeric" $set */
    public static function undefOrCountryCode(string $set = 'alpha-2'): Chain;

    public static function undefOrCpf(): Chain;

    public static function undefOrCreditCard(string $brand = 'Any'): Chain;

    /** @param "alpha-3"|"numeric" $set */
    public static function undefOrCurrencyCode(string $set = 'alpha-3'): Chain;

    public static function undefOrDate(string $format = 'Y-m-d'): Chain;

    public static function undefOrDateTime(string|null $format = null): Chain;

    /** @param "years"|"months"|"days"|"hours"|"minutes"|"seconds"|"microseconds" $type */
    public static function undefOrDateTimeDiff(string $type, Validator $validator, string|null $format = null, DateTimeImmutable|null $now = null): Chain;

    public static function undefOrDecimal(int $decimals): Chain;

    public static function undefOrDigit(string ...$additionalChars): Chain;

    public static function undefOrDirectory(): Chain;

    public static function undefOrDomain(bool $tldCheck = true): Chain;

    public static function undefOrEach(Validator $validator): Chain;

    public static function undefOrEmail(): Chain;

    public static function undefOrEmoji(): Chain;

    public static function undefOrEndsWith(mixed $endValue): Chain;

    public static function undefOrEquals(mixed $compareTo): Chain;

    public static function undefOrEquivalent(mixed $compareTo): Chain;

    public static function undefOrEven(): Chain;

    public static function undefOrExecutable(): Chain;

    public static function undefOrExists(): Chain;

    public static function undefOrExtension(string $extension): Chain;

    public static function undefOrFactor(int $dividend): Chain;

    /** @param callable(mixed): Validator $factory */
    public static function undefOrFactory(callable $factory): Chain;

    public static function undefOrFalseVal(): Chain;

    public static function undefOrFalsy(): Chain;

    public static function undefOrFile(): Chain;

    public static function undefOrFinite(): Chain;

    public static function undefOrFloatType(): Chain;

    public static function undefOrFloatVal(): Chain;

    public static function undefOrFormat(Formatter $formatter): Chain;

    public static function undefOrGraph(string ...$additionalChars): Chain;

    public static function undefOrGreaterThan(mixed $compareTo): Chain;

    public static function undefOrGreaterThanOrEqual(mixed $compareTo): Chain;

    public static function undefOrHetu(): Chain;

    public static function undefOrHexRgbColor(): Chain;

    public static function undefOrIban(): Chain;

    public static function undefOrIdentical(mixed $compareTo): Chain;

    public static function undefOrImage(): Chain;

    public static function undefOrImei(): Chain;

    public static function undefOrIn(mixed $haystack): Chain;

    public static function undefOrInfinite(): Chain;

    /** @param class-string $class */
    public static function undefOrInstance(string $class): Chain;

    public static function undefOrIntType(): Chain;

    public static function undefOrIntVal(): Chain;

    public static function undefOrIp(string $range = '*', int|null $options = null): Chain;

    public static function undefOrIsbn(): Chain;

    public static function undefOrIterableType(): Chain;

    public static function undefOrIterableVal(): Chain;

    public static function undefOrJson(): Chain;

    public static function undefOrKey(string|int $key, Validator $validator): Chain;

    public static function undefOrKeyExists(string|int $key): Chain;

    public static function undefOrKeyOptional(string|int $key, Validator $validator): Chain;

    public static function undefOrKeySet(Validator $validator, Validator ...$validators): Chain;

    /** @param "alpha-2"|"alpha-3" $set */
    public static function undefOrLanguageCode(string $set = 'alpha-2'): Chain;

    public static function undefOrLeapDate(string $format): Chain;

    public static function undefOrLeapYear(): Chain;

    public static function undefOrLength(Validator $validator): Chain;

    public static function undefOrLessThan(mixed $compareTo): Chain;

    public static function undefOrLessThanOrEqual(mixed $compareTo): Chain;

    public static function undefOrLowercase(): Chain;

    public static function undefOrLuhn(): Chain;

    public static function undefOrMacAddress(): Chain;

    public static function undefOrMasked(string $range, Validator $validator, string $replacement = '*'): Chain;

    public static function undefOrMax(Validator $validator): Chain;

    public static function undefOrMimetype(string $mimetype): Chain;

    public static function undefOrMin(Validator $validator): Chain;

    public static function undefOrMultiple(int $multipleOf): Chain;

    public static function undefOrNegative(): Chain;

    public static function undefOrNfeAccessKey(): Chain;

    public static function undefOrNif(): Chain;

    public static function undefOrNip(): Chain;

    public static function undefOrNoneOf(Validator $validator1, Validator $validator2, Validator ...$validators): Chain;

    public static function undefOrNot(Validator $validator): Chain;

    public static function undefOrNullType(): Chain;

    public static function undefOrNumber(): Chain;

    public static function undefOrNumericVal(): Chain;

    public static function undefOrObjectType(): Chain;

    public static function undefOrOdd(): Chain;

    public static function undefOrOneOf(Validator $validator1, Validator $validator2, Validator ...$validators): Chain;

    public static function undefOrPesel(): Chain;

    public static function undefOrPhone(string|null $countryCode = null): Chain;

    public static function undefOrPis(): Chain;

    public static function undefOrPolishIdCard(): Chain;

    public static function undefOrPortugueseNif(): Chain;

    public static function undefOrPositive(): Chain;

    public static function undefOrPostalCode(string $countryCode, bool $formatted = false): Chain;

    public static function undefOrPrintable(string ...$additionalChars): Chain;

    public static function undefOrProperty(string $propertyName, Validator $validator): Chain;

    public static function undefOrPropertyExists(string $propertyName): Chain;

    public static function undefOrPropertyOptional(string $propertyName, Validator $validator): Chain;

    public static function undefOrPublicDomainSuffix(): Chain;

    public static function undefOrPunct(string ...$additionalChars): Chain;

    public static function undefOrReadable(): Chain;

    public static function undefOrRegex(string $regex): Chain;

    public static function undefOrResourceType(): Chain;

    public static function undefOrRoman(): Chain;

    public static function undefOrSatisfies(callable $callback, mixed ...$arguments): Chain;

    public static function undefOrScalarVal(): Chain;

    public static function undefOrShortCircuit(Validator ...$validators): Chain;

    /** @param "B"|"KB"|"MB"|"GB"|"TB"|"PB"|"EB"|"ZB"|"YB" $unit */
    public static function undefOrSize(string $unit, Validator $validator): Chain;

    public static function undefOrSlug(): Chain;

    public static function undefOrSorted(string $direction): Chain;

    public static function undefOrSpace(string ...$additionalChars): Chain;

    public static function undefOrSpaced(): Chain;

    public static function undefOrStartsWith(mixed $startValue): Chain;

    public static function undefOrStringType(): Chain;

    public static function undefOrStringVal(): Chain;

    public static function undefOrSubdivisionCode(string $countryCode): Chain;

    /** @param mixed[] $superset */
    public static function undefOrSubset(array $superset): Chain;

    public static function undefOrSymbolicLink(): Chain;

    public static function undefOrTime(string $format = 'H:i:s'): Chain;

    public static function undefOrTld(): Chain;

    public static function undefOrTrueVal(): Chain;

    public static function undefOrUnique(): Chain;

    public static function undefOrUppercase(): Chain;

    public static function undefOrUrl(): Chain;

    public static function undefOrUuid(int|null $version = null): Chain;

    public static function undefOrVersion(): Chain;

    public static function undefOrVowel(string ...$additionalChars): Chain;

    public static function undefOrWhen(Validator $when, Validator $then, Validator|null $else = null): Chain;

    public static function undefOrWritable(): Chain;

    public static function undefOrXdigit(string ...$additionalChars): Chain;
}
