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

interface UndefOrChain
{
    /** @return Chain<mixed> */
    public function undefOrAfter(callable $callable, Validator $validator): Chain;

    /** @return Chain<mixed> */
    public function undefOrAll(Validator $validator): Chain;

    /** @return Chain<mixed> */
    public function undefOrAllOf(Validator $validator1, Validator $validator2, Validator ...$validators): Chain;

    /** @return Chain<mixed> */
    public function undefOrAlnum(string ...$additionalChars): Chain;

    /** @return Chain<mixed> */
    public function undefOrAlpha(string ...$additionalChars): Chain;

    /** @return Chain<mixed> */
    public function undefOrAlwaysInvalid(): Chain;

    /** @return Chain<mixed> */
    public function undefOrAlwaysValid(): Chain;

    /** @return Chain<mixed> */
    public function undefOrAnyOf(Validator $validator1, Validator $validator2, Validator ...$validators): Chain;

    /** @return Chain<mixed> */
    public function undefOrArrayType(): Chain;

    /** @return Chain<mixed> */
    public function undefOrArrayVal(): Chain;

    /** @return Chain<mixed> */
    public function undefOrBase(int $base, string $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'): Chain;

    /** @return Chain<mixed> */
    public function undefOrBase64(): Chain;

    /** @return Chain<mixed> */
    public function undefOrBetween(mixed $minValue, mixed $maxValue): Chain;

    /** @return Chain<mixed> */
    public function undefOrBetweenExclusive(mixed $minimum, mixed $maximum): Chain;

    /** @return Chain<mixed> */
    public function undefOrBoolType(): Chain;

    /** @return Chain<mixed> */
    public function undefOrBoolVal(): Chain;

    /** @return Chain<mixed> */
    public function undefOrBsn(): Chain;

    /** @return Chain<mixed> */
    public function undefOrCallableType(): Chain;

    /** @return Chain<mixed> */
    public function undefOrCharset(string $charset, string ...$charsets): Chain;

    /** @return Chain<mixed> */
    public function undefOrCnh(): Chain;

    /** @return Chain<mixed> */
    public function undefOrCnpj(): Chain;

    /** @return Chain<mixed> */
    public function undefOrConsonant(string ...$additionalChars): Chain;

    /** @return Chain<mixed> */
    public function undefOrContains(mixed $containsValue): Chain;

    /**
     * @param non-empty-array<mixed> $needles
     * @return Chain<mixed>
     */
    public function undefOrContainsAny(array $needles): Chain;

    /** @return Chain<mixed> */
    public function undefOrContainsCount(mixed $containsValue, int $count): Chain;

    /** @return Chain<mixed> */
    public function undefOrControl(string ...$additionalChars): Chain;

    /** @return Chain<mixed> */
    public function undefOrCountable(): Chain;

    /**
     * @param "alpha-2"|"alpha-3"|"numeric" $set
     * @return Chain<mixed>
     */
    public function undefOrCountryCode(string $set = 'alpha-2'): Chain;

    /** @return Chain<mixed> */
    public function undefOrCpf(): Chain;

    /** @return Chain<mixed> */
    public function undefOrCreditCard(string $brand = 'Any'): Chain;

    /**
     * @param "alpha-3"|"numeric" $set
     * @return Chain<mixed>
     */
    public function undefOrCurrencyCode(string $set = 'alpha-3'): Chain;

    /** @return Chain<mixed> */
    public function undefOrDate(string $format = 'Y-m-d'): Chain;

    /** @return Chain<mixed> */
    public function undefOrDateTime(string|null $format = null): Chain;

    /**
     * @param "years"|"months"|"days"|"hours"|"minutes"|"seconds"|"microseconds" $type
     * @return Chain<mixed>
     */
    public function undefOrDateTimeDiff(string $type, Validator $validator, string|null $format = null, DateTimeImmutable|null $now = null): Chain;

    /** @return Chain<mixed> */
    public function undefOrDecimal(int $decimals): Chain;

    /** @return Chain<mixed> */
    public function undefOrDigit(string ...$additionalChars): Chain;

    /** @return Chain<mixed> */
    public function undefOrDirectory(): Chain;

    /** @return Chain<mixed> */
    public function undefOrDomain(bool $tldCheck = true): Chain;

    /** @return Chain<mixed> */
    public function undefOrEach(Validator $validator): Chain;

    /** @return Chain<mixed> */
    public function undefOrEachKey(Validator $validator): Chain;

    /** @return Chain<mixed> */
    public function undefOrEmail(): Chain;

    /** @return Chain<mixed> */
    public function undefOrEmoji(): Chain;

    /** @return Chain<mixed> */
    public function undefOrEndsWith(mixed $endValue, mixed ...$endValues): Chain;

    /** @return Chain<mixed> */
    public function undefOrEquals(mixed $compareTo): Chain;

    /** @return Chain<mixed> */
    public function undefOrEquivalent(mixed $compareTo): Chain;

    /** @return Chain<mixed> */
    public function undefOrEven(): Chain;

    /** @return Chain<mixed> */
    public function undefOrExecutable(): Chain;

    /** @return Chain<mixed> */
    public function undefOrExists(): Chain;

    /** @return Chain<mixed> */
    public function undefOrExtension(string $extension): Chain;

    /** @return Chain<mixed> */
    public function undefOrFactor(int $dividend): Chain;

    /**
     * @param callable(mixed): Validator $factory
     * @return Chain<mixed>
     */
    public function undefOrFactory(callable $factory): Chain;

    /** @return Chain<mixed> */
    public function undefOrFalseVal(): Chain;

    /** @return Chain<mixed> */
    public function undefOrFalsy(): Chain;

    /** @return Chain<mixed> */
    public function undefOrFile(): Chain;

    /** @return Chain<mixed> */
    public function undefOrFinite(): Chain;

    /** @return Chain<mixed> */
    public function undefOrFloatType(): Chain;

    /** @return Chain<mixed> */
    public function undefOrFloatVal(): Chain;

    /** @return Chain<mixed> */
    public function undefOrFormat(Formatter $formatter): Chain;

    /** @return Chain<mixed> */
    public function undefOrFormatted(Formatter $formatter, Validator $validator): Chain;

    /** @return Chain<mixed> */
    public function undefOrGiven(Validator $when, Validator $then): Chain;

    /** @return Chain<mixed> */
    public function undefOrGraph(string ...$additionalChars): Chain;

    /** @return Chain<mixed> */
    public function undefOrGreaterThan(mixed $compareTo): Chain;

    /** @return Chain<mixed> */
    public function undefOrGreaterThanOrEqual(mixed $compareTo): Chain;

    /** @return Chain<mixed> */
    public function undefOrHetu(): Chain;

    /** @return Chain<mixed> */
    public function undefOrHexRgbColor(): Chain;

    /** @return Chain<mixed> */
    public function undefOrIban(): Chain;

    /** @return Chain<mixed> */
    public function undefOrIdentical(mixed $compareTo): Chain;

    /** @return Chain<mixed> */
    public function undefOrImage(): Chain;

    /** @return Chain<mixed> */
    public function undefOrImei(): Chain;

    /** @return Chain<mixed> */
    public function undefOrIn(mixed $haystack): Chain;

    /** @return Chain<mixed> */
    public function undefOrInfinite(): Chain;

    /**
     * @param class-string $class
     * @return Chain<mixed>
     */
    public function undefOrInstance(string $class): Chain;

    /** @return Chain<mixed> */
    public function undefOrIntType(): Chain;

    /** @return Chain<mixed> */
    public function undefOrIntVal(): Chain;

    /** @return Chain<mixed> */
    public function undefOrIp(string $range = '*', int|null $options = null): Chain;

    /** @return Chain<mixed> */
    public function undefOrIsbn(): Chain;

    /** @return Chain<mixed> */
    public function undefOrIterableType(): Chain;

    /** @return Chain<mixed> */
    public function undefOrIterableVal(): Chain;

    /** @return Chain<mixed> */
    public function undefOrJson(): Chain;

    /** @return Chain<mixed> */
    public function undefOrKey(int|string $key, Validator $validator): Chain;

    /** @return Chain<mixed> */
    public function undefOrKeyExists(int|string $key): Chain;

    /** @return Chain<mixed> */
    public function undefOrKeyOptional(int|string $key, Validator $validator): Chain;

    /** @return Chain<mixed> */
    public function undefOrKeySet(Validator $validator, Validator ...$validators): Chain;

    /**
     * @param "alpha-2"|"alpha-3" $set
     * @return Chain<mixed>
     */
    public function undefOrLanguageCode(string $set = 'alpha-2'): Chain;

    /** @return Chain<mixed> */
    public function undefOrLeapDate(string $format): Chain;

    /** @return Chain<mixed> */
    public function undefOrLeapYear(): Chain;

    /** @return Chain<mixed> */
    public function undefOrLength(Validator $validator): Chain;

    /** @return Chain<mixed> */
    public function undefOrLessThan(mixed $compareTo): Chain;

    /** @return Chain<mixed> */
    public function undefOrLessThanOrEqual(mixed $compareTo): Chain;

    /** @return Chain<mixed> */
    public function undefOrLowercase(): Chain;

    /** @return Chain<mixed> */
    public function undefOrLuhn(): Chain;

    /** @return Chain<mixed> */
    public function undefOrMacAddress(): Chain;

    /** @return Chain<mixed> */
    public function undefOrMax(Validator $validator): Chain;

    /** @return Chain<mixed> */
    public function undefOrMimetype(string $mimetype): Chain;

    /** @return Chain<mixed> */
    public function undefOrMin(Validator $validator): Chain;

    /** @return Chain<mixed> */
    public function undefOrMultiple(int $multipleOf): Chain;

    /** @return Chain<mixed> */
    public function undefOrNegative(): Chain;

    /** @return Chain<mixed> */
    public function undefOrNfeAccessKey(): Chain;

    /** @return Chain<mixed> */
    public function undefOrNif(): Chain;

    /** @return Chain<mixed> */
    public function undefOrNip(): Chain;

    /** @return Chain<mixed> */
    public function undefOrNoneOf(Validator $validator1, Validator $validator2, Validator ...$validators): Chain;

    /** @return Chain<mixed> */
    public function undefOrNot(Validator $validator): Chain;

    /** @return Chain<mixed> */
    public function undefOrNullType(): Chain;

    /** @return Chain<mixed> */
    public function undefOrNumber(): Chain;

    /** @return Chain<mixed> */
    public function undefOrNumericVal(): Chain;

    /** @return Chain<mixed> */
    public function undefOrObjectType(): Chain;

    /** @return Chain<mixed> */
    public function undefOrOdd(): Chain;

    /** @return Chain<mixed> */
    public function undefOrOneOf(Validator $validator1, Validator $validator2, Validator ...$validators): Chain;

    /** @return Chain<mixed> */
    public function undefOrPesel(): Chain;

    /** @return Chain<mixed> */
    public function undefOrPhone(string|null $countryCode = null): Chain;

    /** @return Chain<mixed> */
    public function undefOrPis(): Chain;

    /** @return Chain<mixed> */
    public function undefOrPolishIdCard(): Chain;

    /** @return Chain<mixed> */
    public function undefOrPortugueseNif(): Chain;

    /** @return Chain<mixed> */
    public function undefOrPositive(): Chain;

    /** @return Chain<mixed> */
    public function undefOrPostalCode(string $countryCode, bool $formatted = false): Chain;

    /** @return Chain<mixed> */
    public function undefOrPrintable(string ...$additionalChars): Chain;

    /** @return Chain<mixed> */
    public function undefOrProperty(string $propertyName, Validator $validator): Chain;

    /** @return Chain<mixed> */
    public function undefOrPropertyExists(string $propertyName): Chain;

    /** @return Chain<mixed> */
    public function undefOrPropertyOptional(string $propertyName, Validator $validator): Chain;

    /** @return Chain<mixed> */
    public function undefOrPublicDomainSuffix(): Chain;

    /** @return Chain<mixed> */
    public function undefOrPunct(string ...$additionalChars): Chain;

    /** @return Chain<mixed> */
    public function undefOrReadable(): Chain;

    /** @return Chain<mixed> */
    public function undefOrRegex(string $regex): Chain;

    /** @return Chain<mixed> */
    public function undefOrResourceType(): Chain;

    /** @return Chain<mixed> */
    public function undefOrRoman(): Chain;

    /** @return Chain<mixed> */
    public function undefOrSatisfies(callable $callback, mixed ...$arguments): Chain;

    /** @return Chain<mixed> */
    public function undefOrScalarVal(): Chain;

    /** @return Chain<mixed> */
    public function undefOrShortCircuit(Validator ...$validators): Chain;

    /**
     * @param "B"|"KB"|"MB"|"GB"|"TB"|"PB"|"EB"|"ZB"|"YB" $unit
     * @return Chain<mixed>
     */
    public function undefOrSize(string $unit, Validator $validator): Chain;

    /** @return Chain<mixed> */
    public function undefOrSlug(): Chain;

    /** @return Chain<mixed> */
    public function undefOrSorted(string $direction): Chain;

    /** @return Chain<mixed> */
    public function undefOrSpace(string ...$additionalChars): Chain;

    /** @return Chain<mixed> */
    public function undefOrSpaced(): Chain;

    /** @return Chain<mixed> */
    public function undefOrStartsWith(mixed $startValue, mixed ...$startValues): Chain;

    /** @return Chain<mixed> */
    public function undefOrStringType(): Chain;

    /** @return Chain<mixed> */
    public function undefOrStringVal(): Chain;

    /** @return Chain<mixed> */
    public function undefOrSubdivisionCode(string $countryCode): Chain;

    /**
     * @param mixed[] $superset
     * @return Chain<mixed>
     */
    public function undefOrSubset(array $superset): Chain;

    /** @return Chain<mixed> */
    public function undefOrSymbolicLink(): Chain;

    /** @return Chain<mixed> */
    public function undefOrTime(string $format = 'H:i:s'): Chain;

    /** @return Chain<mixed> */
    public function undefOrTld(): Chain;

    /** @return Chain<mixed> */
    public function undefOrTrimmed(string ...$trimValues): Chain;

    /** @return Chain<mixed> */
    public function undefOrTrueVal(): Chain;

    /** @return Chain<mixed> */
    public function undefOrUnique(): Chain;

    /** @return Chain<mixed> */
    public function undefOrUppercase(): Chain;

    /** @return Chain<mixed> */
    public function undefOrUrl(): Chain;

    /** @return Chain<mixed> */
    public function undefOrUuid(int|null $version = null): Chain;

    /** @return Chain<mixed> */
    public function undefOrVersion(): Chain;

    /** @return Chain<mixed> */
    public function undefOrVowel(string ...$additionalChars): Chain;

    /** @return Chain<mixed> */
    public function undefOrWhen(Validator $when, Validator $then, Validator|null $else = null): Chain;

    /** @return Chain<mixed> */
    public function undefOrWritable(): Chain;

    /** @return Chain<mixed> */
    public function undefOrXdigit(string ...$additionalChars): Chain;
}
