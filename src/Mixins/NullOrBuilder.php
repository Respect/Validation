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

interface NullOrBuilder
{
    /** @return Chain<mixed> */
    public static function nullOrAfter(callable $callable, Validator $validator): Chain;

    /** @return Chain<mixed> */
    public static function nullOrAll(Validator $validator): Chain;

    /** @return Chain<mixed> */
    public static function nullOrAllOf(Validator $validator1, Validator $validator2, Validator ...$validators): Chain;

    /** @return Chain<scalar|null> */
    public static function nullOrAlnum(string ...$additionalChars): Chain;

    /** @return Chain<scalar|null> */
    public static function nullOrAlpha(string ...$additionalChars): Chain;

    /** @return Chain<mixed> */
    public static function nullOrAlwaysInvalid(): Chain;

    /** @return Chain<mixed> */
    public static function nullOrAlwaysValid(): Chain;

    /** @return Chain<mixed> */
    public static function nullOrAnyOf(Validator $validator1, Validator $validator2, Validator ...$validators): Chain;

    /** @return Chain<array|null> */
    public static function nullOrArrayType(): Chain;

    /** @return Chain<array|\ArrayAccess|\SimpleXMLElement|null> */
    public static function nullOrArrayVal(): Chain;

    /** @return Chain<object|null> */
    public static function nullOrAttributes(): Chain;

    /** @return Chain<mixed> */
    public static function nullOrBase(int $base, string $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'): Chain;

    /** @return Chain<string|null> */
    public static function nullOrBase64(): Chain;

    /** @return Chain<mixed> */
    public static function nullOrBetween(mixed $minValue, mixed $maxValue): Chain;

    /** @return Chain<mixed> */
    public static function nullOrBetweenExclusive(mixed $minimum, mixed $maximum): Chain;

    /** @return Chain<bool|null> */
    public static function nullOrBoolType(): Chain;

    /** @return Chain<scalar|null> */
    public static function nullOrBoolVal(): Chain;

    /** @return Chain<scalar|null> */
    public static function nullOrBsn(): Chain;

    /** @return Chain<callable|null> */
    public static function nullOrCallableType(): Chain;

    /** @return Chain<string|null> */
    public static function nullOrCharset(string $charset, string ...$charsets): Chain;

    /** @return Chain<scalar|null> */
    public static function nullOrCnh(): Chain;

    /** @return Chain<scalar|null> */
    public static function nullOrCnpj(): Chain;

    /** @return Chain<scalar|null> */
    public static function nullOrConsonant(string ...$additionalChars): Chain;

    /** @return Chain<scalar|array|null> */
    public static function nullOrContains(mixed $containsValue): Chain;

    /**
     * @param non-empty-array<mixed> $needles
     * @return Chain<scalar|array|null>
     */
    public static function nullOrContainsAny(array $needles): Chain;

    /** @return Chain<scalar|array|null> */
    public static function nullOrContainsCount(mixed $containsValue, int $count): Chain;

    /** @return Chain<scalar|null> */
    public static function nullOrControl(string ...$additionalChars): Chain;

    /** @return Chain<array|\Countable|null> */
    public static function nullOrCountable(): Chain;

    /**
     * @param "alpha-2"|"alpha-3"|"numeric" $set
     * @return Chain<string|null>
     */
    public static function nullOrCountryCode(string $set = 'alpha-2'): Chain;

    /** @return Chain<string|null> */
    public static function nullOrCpf(): Chain;

    /** @return Chain<scalar|null> */
    public static function nullOrCreditCard(string $brand = 'Any'): Chain;

    /**
     * @param "alpha-3"|"numeric" $set
     * @return Chain<string|null>
     */
    public static function nullOrCurrencyCode(string $set = 'alpha-3'): Chain;

    /** @return Chain<scalar|null> */
    public static function nullOrDate(string $format = 'Y-m-d'): Chain;

    /** @return Chain<scalar|\DateTimeInterface|null> */
    public static function nullOrDateTime(string|null $format = null): Chain;

    /**
     * @param "years"|"months"|"days"|"hours"|"minutes"|"seconds"|"microseconds" $type
     * @return Chain<string|\DateTimeInterface|null>
     */
    public static function nullOrDateTimeDiff(string $type, Validator $validator, string|null $format = null, DateTimeImmutable|null $now = null): Chain;

    /** @return Chain<int|float|numeric-string|null> */
    public static function nullOrDecimal(int $decimals): Chain;

    /** @return Chain<scalar|null> */
    public static function nullOrDigit(string ...$additionalChars): Chain;

    /** @return Chain<string|\SplFileInfo|null> */
    public static function nullOrDirectory(): Chain;

    /** @return Chain<string|null> */
    public static function nullOrDomain(bool $tldCheck = true): Chain;

    /** @return Chain<mixed> */
    public static function nullOrEach(Validator $validator): Chain;

    /** @return Chain<mixed> */
    public static function nullOrEachKey(Validator $validator): Chain;

    /** @return Chain<string|null> */
    public static function nullOrEmail(): Chain;

    /** @return Chain<string|null> */
    public static function nullOrEmoji(): Chain;

    /** @return Chain<array|string|null> */
    public static function nullOrEndsWith(mixed $endValue, mixed ...$endValues): Chain;

    /** @return Chain<mixed> */
    public static function nullOrEquals(mixed $compareTo): Chain;

    /** @return Chain<mixed> */
    public static function nullOrEquivalent(mixed $compareTo): Chain;

    /** @return Chain<int|float|numeric-string|null> */
    public static function nullOrEven(): Chain;

    /** @return Chain<string|\SplFileInfo|null> */
    public static function nullOrExecutable(): Chain;

    /** @return Chain<string|\SplFileInfo|null> */
    public static function nullOrExists(): Chain;

    /** @return Chain<string|\SplFileInfo|null> */
    public static function nullOrExtension(string $extension): Chain;

    /** @return Chain<mixed> */
    public static function nullOrFactor(int $dividend): Chain;

    /**
     * @param callable(mixed): Validator $factory
     * @return Chain<mixed>
     */
    public static function nullOrFactory(callable $factory): Chain;

    /** @return Chain<scalar|null> */
    public static function nullOrFalseVal(): Chain;

    /** @return Chain<mixed> */
    public static function nullOrFalsy(): Chain;

    /** @return Chain<string|\SplFileInfo|null> */
    public static function nullOrFile(): Chain;

    /** @return Chain<int|float|numeric-string|null> */
    public static function nullOrFinite(): Chain;

    /** @return Chain<float|null> */
    public static function nullOrFloatType(): Chain;

    /** @return Chain<int|float|numeric-string|true|null> */
    public static function nullOrFloatVal(): Chain;

    /** @return Chain<scalar|\Stringable|null> */
    public static function nullOrFormat(Formatter $formatter): Chain;

    /** @return Chain<scalar|\Stringable|null> */
    public static function nullOrFormatted(Formatter $formatter, Validator $validator): Chain;

    /** @return Chain<mixed> */
    public static function nullOrGiven(Validator $when, Validator $then): Chain;

    /** @return Chain<scalar|null> */
    public static function nullOrGraph(string ...$additionalChars): Chain;

    /** @return Chain<mixed> */
    public static function nullOrGreaterThan(mixed $compareTo): Chain;

    /** @return Chain<mixed> */
    public static function nullOrGreaterThanOrEqual(mixed $compareTo): Chain;

    /** @return Chain<string|null> */
    public static function nullOrHetu(): Chain;

    /** @return Chain<scalar|null> */
    public static function nullOrHexRgbColor(): Chain;

    /** @return Chain<string|null> */
    public static function nullOrIban(): Chain;

    /** @return Chain<mixed> */
    public static function nullOrIdentical(mixed $compareTo): Chain;

    /** @return Chain<string|\SplFileInfo|null> */
    public static function nullOrImage(): Chain;

    /** @return Chain<scalar|null> */
    public static function nullOrImei(): Chain;

    /** @return Chain<mixed> */
    public static function nullOrIn(mixed $haystack): Chain;

    /** @return Chain<int|float|numeric-string|null> */
    public static function nullOrInfinite(): Chain;

    /**
     * @param class-string $class
     * @return Chain<mixed>
     */
    public static function nullOrInstance(string $class): Chain;

    /** @return Chain<int|null> */
    public static function nullOrIntType(): Chain;

    /** @return Chain<int|numeric-string|null> */
    public static function nullOrIntVal(): Chain;

    /** @return Chain<string|null> */
    public static function nullOrIp(string $range = '*', int|null $options = null): Chain;

    /** @return Chain<scalar|null> */
    public static function nullOrIsbn(): Chain;

    /** @return Chain<iterable|null> */
    public static function nullOrIterableType(): Chain;

    /** @return Chain<array|\stdClass|\Traversable|null> */
    public static function nullOrIterableVal(): Chain;

    /** @return Chain<string|null> */
    public static function nullOrJson(): Chain;

    /** @return Chain<mixed> */
    public static function nullOrKey(int|string $key, Validator $validator): Chain;

    /** @return Chain<array|\ArrayAccess|null> */
    public static function nullOrKeyExists(int|string $key): Chain;

    /** @return Chain<mixed> */
    public static function nullOrKeyOptional(int|string $key, Validator $validator): Chain;

    /** @return Chain<array|null> */
    public static function nullOrKeySet(Validator $validator, Validator ...$validators): Chain;

    /**
     * @param "alpha-2"|"alpha-3" $set
     * @return Chain<string|null>
     */
    public static function nullOrLanguageCode(string $set = 'alpha-2'): Chain;

    /** @return Chain<scalar|\DateTimeInterface|null> */
    public static function nullOrLeapDate(string $format): Chain;

    /** @return Chain<scalar|\DateTimeInterface|null> */
    public static function nullOrLeapYear(): Chain;

    /** @return Chain<mixed> */
    public static function nullOrLength(Validator $validator): Chain;

    /** @return Chain<mixed> */
    public static function nullOrLessThan(mixed $compareTo): Chain;

    /** @return Chain<mixed> */
    public static function nullOrLessThanOrEqual(mixed $compareTo): Chain;

    /** @return Chain<string|null> */
    public static function nullOrLowercase(): Chain;

    /** @return Chain<scalar|null> */
    public static function nullOrLuhn(): Chain;

    /** @return Chain<string|null> */
    public static function nullOrMacAddress(): Chain;

    /** @return Chain<mixed> */
    public static function nullOrMax(Validator $validator): Chain;

    /** @return Chain<string|\SplFileInfo|null> */
    public static function nullOrMimetype(string $mimetype): Chain;

    /** @return Chain<mixed> */
    public static function nullOrMin(Validator $validator): Chain;

    /** @return Chain<mixed> */
    public static function nullOrMultiple(int $multipleOf): Chain;

    /** @return Chain<int|float|numeric-string|null> */
    public static function nullOrNegative(): Chain;

    /** @return Chain<string|null> */
    public static function nullOrNfeAccessKey(): Chain;

    /** @return Chain<string|null> */
    public static function nullOrNif(): Chain;

    /** @return Chain<scalar|null> */
    public static function nullOrNip(): Chain;

    /** @return Chain<mixed> */
    public static function nullOrNoneOf(Validator $validator1, Validator $validator2, Validator ...$validators): Chain;

    /** @return Chain<mixed> */
    public static function nullOrNot(Validator $validator): Chain;

    /** @return Chain<null> */
    public static function nullOrNullType(): Chain;

    /** @return Chain<int|float|numeric-string|null> */
    public static function nullOrNumber(): Chain;

    /** @return Chain<int|float|numeric-string|null> */
    public static function nullOrNumericVal(): Chain;

    /** @return Chain<object|null> */
    public static function nullOrObjectType(): Chain;

    /** @return Chain<int|float|numeric-string|null> */
    public static function nullOrOdd(): Chain;

    /** @return Chain<mixed> */
    public static function nullOrOneOf(Validator $validator1, Validator $validator2, Validator ...$validators): Chain;

    /** @return Chain<scalar|null> */
    public static function nullOrPesel(): Chain;

    /** @return Chain<scalar|null> */
    public static function nullOrPhone(string|null $countryCode = null): Chain;

    /** @return Chain<scalar|null> */
    public static function nullOrPis(): Chain;

    /** @return Chain<scalar|null> */
    public static function nullOrPolishIdCard(): Chain;

    /** @return Chain<string|null> */
    public static function nullOrPortugueseNif(): Chain;

    /** @return Chain<int|float|numeric-string|null> */
    public static function nullOrPositive(): Chain;

    /** @return Chain<scalar|null> */
    public static function nullOrPostalCode(string $countryCode, bool $formatted = false): Chain;

    /** @return Chain<scalar|null> */
    public static function nullOrPrintable(string ...$additionalChars): Chain;

    /** @return Chain<mixed> */
    public static function nullOrProperty(string $propertyName, Validator $validator): Chain;

    /** @return Chain<object|null> */
    public static function nullOrPropertyExists(string $propertyName): Chain;

    /** @return Chain<mixed> */
    public static function nullOrPropertyOptional(string $propertyName, Validator $validator): Chain;

    /** @return Chain<scalar|null> */
    public static function nullOrPublicDomainSuffix(): Chain;

    /** @return Chain<scalar|null> */
    public static function nullOrPunct(string ...$additionalChars): Chain;

    /** @return Chain<string|\SplFileInfo|\Psr\Http\Message\StreamInterface|null> */
    public static function nullOrReadable(): Chain;

    /** @return Chain<scalar|null> */
    public static function nullOrRegex(string $regex): Chain;

    /** @return Chain<resource|null> */
    public static function nullOrResourceType(): Chain;

    /** @return Chain<string|null> */
    public static function nullOrRoman(): Chain;

    /** @return Chain<mixed> */
    public static function nullOrSatisfies(callable $callback, mixed ...$arguments): Chain;

    /** @return Chain<int|float|bool|string|null> */
    public static function nullOrScalarVal(): Chain;

    /** @return Chain<mixed> */
    public static function nullOrShortCircuit(Validator ...$validators): Chain;

    /**
     * @param "B"|"KB"|"MB"|"GB"|"TB"|"PB"|"EB"|"ZB"|"YB" $unit
     * @return Chain<string|\SplFileInfo|\Psr\Http\Message\UploadedFileInterface|\Psr\Http\Message\StreamInterface|null>
     */
    public static function nullOrSize(string $unit, Validator $validator): Chain;

    /** @return Chain<string|null> */
    public static function nullOrSlug(): Chain;

    /** @return Chain<array|string|null> */
    public static function nullOrSorted(string $direction): Chain;

    /** @return Chain<scalar|null> */
    public static function nullOrSpace(string ...$additionalChars): Chain;

    /** @return Chain<string|null> */
    public static function nullOrSpaced(): Chain;

    /** @return Chain<array|string|null> */
    public static function nullOrStartsWith(mixed $startValue, mixed ...$startValues): Chain;

    /** @return Chain<string|null> */
    public static function nullOrStringType(): Chain;

    /** @return Chain<scalar|\Stringable|null> */
    public static function nullOrStringVal(): Chain;

    /** @return Chain<scalar|null> */
    public static function nullOrSubdivisionCode(string $countryCode): Chain;

    /**
     * @param mixed[] $superset
     * @return Chain<array|null>
     */
    public static function nullOrSubset(array $superset): Chain;

    /** @return Chain<string|\SplFileInfo|null> */
    public static function nullOrSymbolicLink(): Chain;

    /** @return Chain<scalar|null> */
    public static function nullOrTime(string $format = 'H:i:s'): Chain;

    /** @return Chain<string|null> */
    public static function nullOrTld(): Chain;

    /** @return Chain<string|null> */
    public static function nullOrTrimmed(string ...$trimValues): Chain;

    /** @return Chain<scalar|null> */
    public static function nullOrTrueVal(): Chain;

    /** @return Chain<array|null> */
    public static function nullOrUnique(): Chain;

    /** @return Chain<string|null> */
    public static function nullOrUppercase(): Chain;

    /** @return Chain<string|null> */
    public static function nullOrUrl(): Chain;

    /** @return Chain<string|\Ramsey\Uuid\UuidInterface|null> */
    public static function nullOrUuid(int|null $version = null): Chain;

    /** @return Chain<string|null> */
    public static function nullOrVersion(): Chain;

    /** @return Chain<scalar|null> */
    public static function nullOrVowel(string ...$additionalChars): Chain;

    /** @return Chain<mixed> */
    public static function nullOrWhen(Validator $when, Validator $then, Validator|null $else = null): Chain;

    /** @return Chain<string|\SplFileInfo|\Psr\Http\Message\StreamInterface|null> */
    public static function nullOrWritable(): Chain;

    /** @return Chain<scalar|null> */
    public static function nullOrXdigit(string ...$additionalChars): Chain;
}
