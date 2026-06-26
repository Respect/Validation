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

interface NullOrChain
{
    /** @return Chain<mixed> */
    public function nullOrAfter(callable $callable, Validator $validator): Chain;

    /** @return Chain<mixed> */
    public function nullOrAll(Validator $validator): Chain;

    /** @return Chain<mixed> */
    public function nullOrAllOf(Validator $validator1, Validator $validator2, Validator ...$validators): Chain;

    /** @return Chain<mixed> */
    public function nullOrAlnum(string ...$additionalChars): Chain;

    /** @return Chain<mixed> */
    public function nullOrAlpha(string ...$additionalChars): Chain;

    /** @return Chain<mixed> */
    public function nullOrAlwaysInvalid(): Chain;

    /** @return Chain<mixed> */
    public function nullOrAlwaysValid(): Chain;

    /** @return Chain<mixed> */
    public function nullOrAnyOf(Validator $validator1, Validator $validator2, Validator ...$validators): Chain;

    /** @return Chain<mixed> */
    public function nullOrArrayType(): Chain;

    /** @return Chain<mixed> */
    public function nullOrArrayVal(): Chain;

    /** @return Chain<mixed> */
    public function nullOrAttributes(): Chain;

    /** @return Chain<mixed> */
    public function nullOrBase(int $base, string $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'): Chain;

    /** @return Chain<mixed> */
    public function nullOrBase64(): Chain;

    /** @return Chain<mixed> */
    public function nullOrBetween(mixed $minValue, mixed $maxValue): Chain;

    /** @return Chain<mixed> */
    public function nullOrBetweenExclusive(mixed $minimum, mixed $maximum): Chain;

    /** @return Chain<mixed> */
    public function nullOrBoolType(): Chain;

    /** @return Chain<mixed> */
    public function nullOrBoolVal(): Chain;

    /** @return Chain<mixed> */
    public function nullOrBsn(): Chain;

    /** @return Chain<mixed> */
    public function nullOrCallableType(): Chain;

    /** @return Chain<mixed> */
    public function nullOrCharset(string $charset, string ...$charsets): Chain;

    /** @return Chain<mixed> */
    public function nullOrCnh(): Chain;

    /** @return Chain<mixed> */
    public function nullOrCnpj(): Chain;

    /** @return Chain<mixed> */
    public function nullOrConsonant(string ...$additionalChars): Chain;

    /** @return Chain<mixed> */
    public function nullOrContains(mixed $containsValue): Chain;

    /**
     * @param non-empty-array<mixed> $needles
     * @return Chain<mixed>
     */
    public function nullOrContainsAny(array $needles): Chain;

    /** @return Chain<mixed> */
    public function nullOrContainsCount(mixed $containsValue, int $count): Chain;

    /** @return Chain<mixed> */
    public function nullOrControl(string ...$additionalChars): Chain;

    /** @return Chain<mixed> */
    public function nullOrCountable(): Chain;

    /**
     * @param "alpha-2"|"alpha-3"|"numeric" $set
     * @return Chain<mixed>
     */
    public function nullOrCountryCode(string $set = 'alpha-2'): Chain;

    /** @return Chain<mixed> */
    public function nullOrCpf(): Chain;

    /** @return Chain<mixed> */
    public function nullOrCreditCard(string $brand = 'Any'): Chain;

    /**
     * @param "alpha-3"|"numeric" $set
     * @return Chain<mixed>
     */
    public function nullOrCurrencyCode(string $set = 'alpha-3'): Chain;

    /** @return Chain<mixed> */
    public function nullOrDate(string $format = 'Y-m-d'): Chain;

    /** @return Chain<mixed> */
    public function nullOrDateTime(string|null $format = null): Chain;

    /**
     * @param "years"|"months"|"days"|"hours"|"minutes"|"seconds"|"microseconds" $type
     * @return Chain<mixed>
     */
    public function nullOrDateTimeDiff(string $type, Validator $validator, string|null $format = null, DateTimeImmutable|null $now = null): Chain;

    /** @return Chain<mixed> */
    public function nullOrDecimal(int $decimals): Chain;

    /** @return Chain<mixed> */
    public function nullOrDigit(string ...$additionalChars): Chain;

    /** @return Chain<mixed> */
    public function nullOrDirectory(): Chain;

    /** @return Chain<mixed> */
    public function nullOrDomain(bool $tldCheck = true): Chain;

    /** @return Chain<mixed> */
    public function nullOrEach(Validator $validator): Chain;

    /** @return Chain<mixed> */
    public function nullOrEachKey(Validator $validator): Chain;

    /** @return Chain<mixed> */
    public function nullOrEmail(): Chain;

    /** @return Chain<mixed> */
    public function nullOrEmoji(): Chain;

    /** @return Chain<mixed> */
    public function nullOrEndsWith(mixed $endValue, mixed ...$endValues): Chain;

    /** @return Chain<mixed> */
    public function nullOrEquals(mixed $compareTo): Chain;

    /** @return Chain<mixed> */
    public function nullOrEquivalent(mixed $compareTo): Chain;

    /** @return Chain<mixed> */
    public function nullOrEven(): Chain;

    /** @return Chain<mixed> */
    public function nullOrExecutable(): Chain;

    /** @return Chain<mixed> */
    public function nullOrExists(): Chain;

    /** @return Chain<mixed> */
    public function nullOrExtension(string $extension): Chain;

    /** @return Chain<mixed> */
    public function nullOrFactor(int $dividend): Chain;

    /**
     * @param callable(mixed): Validator $factory
     * @return Chain<mixed>
     */
    public function nullOrFactory(callable $factory): Chain;

    /** @return Chain<mixed> */
    public function nullOrFalseVal(): Chain;

    /** @return Chain<mixed> */
    public function nullOrFalsy(): Chain;

    /** @return Chain<mixed> */
    public function nullOrFile(): Chain;

    /** @return Chain<mixed> */
    public function nullOrFinite(): Chain;

    /** @return Chain<mixed> */
    public function nullOrFloatType(): Chain;

    /** @return Chain<mixed> */
    public function nullOrFloatVal(): Chain;

    /** @return Chain<mixed> */
    public function nullOrFormat(Formatter $formatter): Chain;

    /** @return Chain<mixed> */
    public function nullOrFormatted(Formatter $formatter, Validator $validator): Chain;

    /** @return Chain<mixed> */
    public function nullOrGiven(Validator $when, Validator $then): Chain;

    /** @return Chain<mixed> */
    public function nullOrGraph(string ...$additionalChars): Chain;

    /** @return Chain<mixed> */
    public function nullOrGreaterThan(mixed $compareTo): Chain;

    /** @return Chain<mixed> */
    public function nullOrGreaterThanOrEqual(mixed $compareTo): Chain;

    /** @return Chain<mixed> */
    public function nullOrHetu(): Chain;

    /** @return Chain<mixed> */
    public function nullOrHexRgbColor(): Chain;

    /** @return Chain<mixed> */
    public function nullOrIban(): Chain;

    /** @return Chain<mixed> */
    public function nullOrIdentical(mixed $compareTo): Chain;

    /** @return Chain<mixed> */
    public function nullOrImage(): Chain;

    /** @return Chain<mixed> */
    public function nullOrImei(): Chain;

    /** @return Chain<mixed> */
    public function nullOrIn(mixed $haystack): Chain;

    /** @return Chain<mixed> */
    public function nullOrInfinite(): Chain;

    /**
     * @param class-string $class
     * @return Chain<mixed>
     */
    public function nullOrInstance(string $class): Chain;

    /** @return Chain<mixed> */
    public function nullOrIntType(): Chain;

    /** @return Chain<mixed> */
    public function nullOrIntVal(): Chain;

    /** @return Chain<mixed> */
    public function nullOrIp(string $range = '*', int|null $options = null): Chain;

    /** @return Chain<mixed> */
    public function nullOrIsbn(): Chain;

    /** @return Chain<mixed> */
    public function nullOrIterableType(): Chain;

    /** @return Chain<mixed> */
    public function nullOrIterableVal(): Chain;

    /** @return Chain<mixed> */
    public function nullOrJson(): Chain;

    /** @return Chain<mixed> */
    public function nullOrKey(int|string $key, Validator $validator): Chain;

    /** @return Chain<mixed> */
    public function nullOrKeyExists(int|string $key): Chain;

    /** @return Chain<mixed> */
    public function nullOrKeyOptional(int|string $key, Validator $validator): Chain;

    /** @return Chain<mixed> */
    public function nullOrKeySet(Validator $validator, Validator ...$validators): Chain;

    /**
     * @param "alpha-2"|"alpha-3" $set
     * @return Chain<mixed>
     */
    public function nullOrLanguageCode(string $set = 'alpha-2'): Chain;

    /** @return Chain<mixed> */
    public function nullOrLeapDate(string $format): Chain;

    /** @return Chain<mixed> */
    public function nullOrLeapYear(): Chain;

    /** @return Chain<mixed> */
    public function nullOrLength(Validator $validator): Chain;

    /** @return Chain<mixed> */
    public function nullOrLessThan(mixed $compareTo): Chain;

    /** @return Chain<mixed> */
    public function nullOrLessThanOrEqual(mixed $compareTo): Chain;

    /** @return Chain<mixed> */
    public function nullOrLowercase(): Chain;

    /** @return Chain<mixed> */
    public function nullOrLuhn(): Chain;

    /** @return Chain<mixed> */
    public function nullOrMacAddress(): Chain;

    /** @return Chain<mixed> */
    public function nullOrMax(Validator $validator): Chain;

    /** @return Chain<mixed> */
    public function nullOrMimetype(string $mimetype): Chain;

    /** @return Chain<mixed> */
    public function nullOrMin(Validator $validator): Chain;

    /** @return Chain<mixed> */
    public function nullOrMultiple(int $multipleOf): Chain;

    /** @return Chain<mixed> */
    public function nullOrNegative(): Chain;

    /** @return Chain<mixed> */
    public function nullOrNfeAccessKey(): Chain;

    /** @return Chain<mixed> */
    public function nullOrNif(): Chain;

    /** @return Chain<mixed> */
    public function nullOrNip(): Chain;

    /** @return Chain<mixed> */
    public function nullOrNoneOf(Validator $validator1, Validator $validator2, Validator ...$validators): Chain;

    /** @return Chain<mixed> */
    public function nullOrNot(Validator $validator): Chain;

    /** @return Chain<mixed> */
    public function nullOrNullType(): Chain;

    /** @return Chain<mixed> */
    public function nullOrNumber(): Chain;

    /** @return Chain<mixed> */
    public function nullOrNumericVal(): Chain;

    /** @return Chain<mixed> */
    public function nullOrObjectType(): Chain;

    /** @return Chain<mixed> */
    public function nullOrOdd(): Chain;

    /** @return Chain<mixed> */
    public function nullOrOneOf(Validator $validator1, Validator $validator2, Validator ...$validators): Chain;

    /** @return Chain<mixed> */
    public function nullOrPesel(): Chain;

    /** @return Chain<mixed> */
    public function nullOrPhone(string|null $countryCode = null): Chain;

    /** @return Chain<mixed> */
    public function nullOrPis(): Chain;

    /** @return Chain<mixed> */
    public function nullOrPolishIdCard(): Chain;

    /** @return Chain<mixed> */
    public function nullOrPortugueseNif(): Chain;

    /** @return Chain<mixed> */
    public function nullOrPositive(): Chain;

    /** @return Chain<mixed> */
    public function nullOrPostalCode(string $countryCode, bool $formatted = false): Chain;

    /** @return Chain<mixed> */
    public function nullOrPrintable(string ...$additionalChars): Chain;

    /** @return Chain<mixed> */
    public function nullOrProperty(string $propertyName, Validator $validator): Chain;

    /** @return Chain<mixed> */
    public function nullOrPropertyExists(string $propertyName): Chain;

    /** @return Chain<mixed> */
    public function nullOrPropertyOptional(string $propertyName, Validator $validator): Chain;

    /** @return Chain<mixed> */
    public function nullOrPublicDomainSuffix(): Chain;

    /** @return Chain<mixed> */
    public function nullOrPunct(string ...$additionalChars): Chain;

    /** @return Chain<mixed> */
    public function nullOrReadable(): Chain;

    /** @return Chain<mixed> */
    public function nullOrRegex(string $regex): Chain;

    /** @return Chain<mixed> */
    public function nullOrResourceType(): Chain;

    /** @return Chain<mixed> */
    public function nullOrRoman(): Chain;

    /** @return Chain<mixed> */
    public function nullOrSatisfies(callable $callback, mixed ...$arguments): Chain;

    /** @return Chain<mixed> */
    public function nullOrScalarVal(): Chain;

    /** @return Chain<mixed> */
    public function nullOrShortCircuit(Validator ...$validators): Chain;

    /**
     * @param "B"|"KB"|"MB"|"GB"|"TB"|"PB"|"EB"|"ZB"|"YB" $unit
     * @return Chain<mixed>
     */
    public function nullOrSize(string $unit, Validator $validator): Chain;

    /** @return Chain<mixed> */
    public function nullOrSlug(): Chain;

    /** @return Chain<mixed> */
    public function nullOrSorted(string $direction): Chain;

    /** @return Chain<mixed> */
    public function nullOrSpace(string ...$additionalChars): Chain;

    /** @return Chain<mixed> */
    public function nullOrSpaced(): Chain;

    /** @return Chain<mixed> */
    public function nullOrStartsWith(mixed $startValue, mixed ...$startValues): Chain;

    /** @return Chain<mixed> */
    public function nullOrStringType(): Chain;

    /** @return Chain<mixed> */
    public function nullOrStringVal(): Chain;

    /** @return Chain<mixed> */
    public function nullOrSubdivisionCode(string $countryCode): Chain;

    /**
     * @param mixed[] $superset
     * @return Chain<mixed>
     */
    public function nullOrSubset(array $superset): Chain;

    /** @return Chain<mixed> */
    public function nullOrSymbolicLink(): Chain;

    /** @return Chain<mixed> */
    public function nullOrTime(string $format = 'H:i:s'): Chain;

    /** @return Chain<mixed> */
    public function nullOrTld(): Chain;

    /** @return Chain<mixed> */
    public function nullOrTrimmed(string ...$trimValues): Chain;

    /** @return Chain<mixed> */
    public function nullOrTrueVal(): Chain;

    /** @return Chain<mixed> */
    public function nullOrUnique(): Chain;

    /** @return Chain<mixed> */
    public function nullOrUppercase(): Chain;

    /** @return Chain<mixed> */
    public function nullOrUrl(): Chain;

    /** @return Chain<mixed> */
    public function nullOrUuid(int|null $version = null): Chain;

    /** @return Chain<mixed> */
    public function nullOrVersion(): Chain;

    /** @return Chain<mixed> */
    public function nullOrVowel(string ...$additionalChars): Chain;

    /** @return Chain<mixed> */
    public function nullOrWhen(Validator $when, Validator $then, Validator|null $else = null): Chain;

    /** @return Chain<mixed> */
    public function nullOrWritable(): Chain;

    /** @return Chain<mixed> */
    public function nullOrXdigit(string ...$additionalChars): Chain;
}
