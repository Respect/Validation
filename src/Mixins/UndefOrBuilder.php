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
    /** @return Chain<mixed> */
    public static function undefOrAfter(callable $callable, Validator $validator): Chain;

    /** @return Chain<mixed> */
    public static function undefOrAll(Validator $validator): Chain;

    /** @return Chain<mixed> */
    public static function undefOrAllOf(Validator $validator1, Validator $validator2, Validator ...$validators): Chain;

    /** @return Chain<scalar|null|''> */
    public static function undefOrAlnum(string ...$additionalChars): Chain;

    /** @return Chain<scalar|null|''> */
    public static function undefOrAlpha(string ...$additionalChars): Chain;

    /** @return Chain<mixed> */
    public static function undefOrAlwaysInvalid(): Chain;

    /** @return Chain<mixed> */
    public static function undefOrAlwaysValid(): Chain;

    /** @return Chain<mixed> */
    public static function undefOrAnyOf(Validator $validator1, Validator $validator2, Validator ...$validators): Chain;

    /** @return Chain<array|null|''> */
    public static function undefOrArrayType(): Chain;

    /** @return Chain<array|\ArrayAccess|\SimpleXMLElement|null|''> */
    public static function undefOrArrayVal(): Chain;

    /** @return Chain<mixed> */
    public static function undefOrBase(int $base, string $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'): Chain;

    /** @return Chain<string|null|''> */
    public static function undefOrBase64(): Chain;

    /** @return Chain<mixed> */
    public static function undefOrBetween(mixed $minValue, mixed $maxValue): Chain;

    /** @return Chain<mixed> */
    public static function undefOrBetweenExclusive(mixed $minimum, mixed $maximum): Chain;

    /** @return Chain<bool|null|''> */
    public static function undefOrBoolType(): Chain;

    /** @return Chain<scalar|null|''> */
    public static function undefOrBoolVal(): Chain;

    /** @return Chain<scalar|null|''> */
    public static function undefOrBsn(): Chain;

    /** @return Chain<callable|null|''> */
    public static function undefOrCallableType(): Chain;

    /** @return Chain<string|null|''> */
    public static function undefOrCharset(string $charset, string ...$charsets): Chain;

    /** @return Chain<scalar|null|''> */
    public static function undefOrCnh(): Chain;

    /** @return Chain<scalar|null|''> */
    public static function undefOrCnpj(): Chain;

    /** @return Chain<scalar|null|''> */
    public static function undefOrConsonant(string ...$additionalChars): Chain;

    /** @return Chain<scalar|array|null|''> */
    public static function undefOrContains(mixed $containsValue): Chain;

    /**
     * @param non-empty-array<mixed> $needles
     * @return Chain<scalar|array|null|''>
     */
    public static function undefOrContainsAny(array $needles): Chain;

    /** @return Chain<scalar|array|null|''> */
    public static function undefOrContainsCount(mixed $containsValue, int $count): Chain;

    /** @return Chain<scalar|null|''> */
    public static function undefOrControl(string ...$additionalChars): Chain;

    /** @return Chain<array|\Countable|null|''> */
    public static function undefOrCountable(): Chain;

    /**
     * @param "alpha-2"|"alpha-3"|"numeric" $set
     * @return Chain<string|null|''>
     */
    public static function undefOrCountryCode(string $set = 'alpha-2'): Chain;

    /** @return Chain<string|null|''> */
    public static function undefOrCpf(): Chain;

    /** @return Chain<scalar|null|''> */
    public static function undefOrCreditCard(string $brand = 'Any'): Chain;

    /**
     * @param "alpha-3"|"numeric" $set
     * @return Chain<string|null|''>
     */
    public static function undefOrCurrencyCode(string $set = 'alpha-3'): Chain;

    /** @return Chain<scalar|null|''> */
    public static function undefOrDate(string $format = 'Y-m-d'): Chain;

    /** @return Chain<scalar|\DateTimeInterface|null|''> */
    public static function undefOrDateTime(string|null $format = null): Chain;

    /**
     * @param "years"|"months"|"days"|"hours"|"minutes"|"seconds"|"microseconds" $type
     * @return Chain<string|\DateTimeInterface|null|''>
     */
    public static function undefOrDateTimeDiff(string $type, Validator $validator, string|null $format = null, DateTimeImmutable|null $now = null): Chain;

    /** @return Chain<int|float|numeric-string|null|''> */
    public static function undefOrDecimal(int $decimals): Chain;

    /** @return Chain<scalar|null|''> */
    public static function undefOrDigit(string ...$additionalChars): Chain;

    /** @return Chain<string|\SplFileInfo|null|''> */
    public static function undefOrDirectory(): Chain;

    /** @return Chain<string|null|''> */
    public static function undefOrDomain(bool $tldCheck = true): Chain;

    /** @return Chain<mixed> */
    public static function undefOrEach(Validator $validator): Chain;

    /** @return Chain<mixed> */
    public static function undefOrEachKey(Validator $validator): Chain;

    /** @return Chain<string|null|''> */
    public static function undefOrEmail(): Chain;

    /** @return Chain<string|null|''> */
    public static function undefOrEmoji(): Chain;

    /** @return Chain<array|string|null|''> */
    public static function undefOrEndsWith(mixed $endValue, mixed ...$endValues): Chain;

    /** @return Chain<mixed> */
    public static function undefOrEquals(mixed $compareTo): Chain;

    /** @return Chain<mixed> */
    public static function undefOrEquivalent(mixed $compareTo): Chain;

    /** @return Chain<int|float|numeric-string|null|''> */
    public static function undefOrEven(): Chain;

    /** @return Chain<string|\SplFileInfo|null|''> */
    public static function undefOrExecutable(): Chain;

    /** @return Chain<string|\SplFileInfo|null|''> */
    public static function undefOrExists(): Chain;

    /** @return Chain<string|\SplFileInfo|null|''> */
    public static function undefOrExtension(string $extension): Chain;

    /** @return Chain<mixed> */
    public static function undefOrFactor(int $dividend): Chain;

    /**
     * @param callable(mixed): Validator $factory
     * @return Chain<mixed>
     */
    public static function undefOrFactory(callable $factory): Chain;

    /** @return Chain<scalar|null|''> */
    public static function undefOrFalseVal(): Chain;

    /** @return Chain<mixed> */
    public static function undefOrFalsy(): Chain;

    /** @return Chain<string|\SplFileInfo|null|''> */
    public static function undefOrFile(): Chain;

    /** @return Chain<int|float|numeric-string|null|''> */
    public static function undefOrFinite(): Chain;

    /** @return Chain<float|null|''> */
    public static function undefOrFloatType(): Chain;

    /** @return Chain<int|float|numeric-string|true|null|''> */
    public static function undefOrFloatVal(): Chain;

    /** @return Chain<scalar|\Stringable|null|''> */
    public static function undefOrFormat(Formatter $formatter): Chain;

    /** @return Chain<scalar|\Stringable|null|''> */
    public static function undefOrFormatted(Formatter $formatter, Validator $validator): Chain;

    /** @return Chain<mixed> */
    public static function undefOrGiven(Validator $when, Validator $then): Chain;

    /** @return Chain<scalar|null|''> */
    public static function undefOrGraph(string ...$additionalChars): Chain;

    /** @return Chain<mixed> */
    public static function undefOrGreaterThan(mixed $compareTo): Chain;

    /** @return Chain<mixed> */
    public static function undefOrGreaterThanOrEqual(mixed $compareTo): Chain;

    /** @return Chain<string|null|''> */
    public static function undefOrHetu(): Chain;

    /** @return Chain<scalar|null|''> */
    public static function undefOrHexRgbColor(): Chain;

    /** @return Chain<string|null|''> */
    public static function undefOrIban(): Chain;

    /** @return Chain<mixed> */
    public static function undefOrIdentical(mixed $compareTo): Chain;

    /** @return Chain<string|\SplFileInfo|null|''> */
    public static function undefOrImage(): Chain;

    /** @return Chain<scalar|null|''> */
    public static function undefOrImei(): Chain;

    /** @return Chain<mixed> */
    public static function undefOrIn(mixed $haystack): Chain;

    /** @return Chain<int|float|numeric-string|null|''> */
    public static function undefOrInfinite(): Chain;

    /**
     * @param class-string $class
     * @return Chain<mixed>
     */
    public static function undefOrInstance(string $class): Chain;

    /** @return Chain<int|null|''> */
    public static function undefOrIntType(): Chain;

    /** @return Chain<int|numeric-string|null|''> */
    public static function undefOrIntVal(): Chain;

    /** @return Chain<string|null|''> */
    public static function undefOrIp(string $range = '*', int|null $options = null): Chain;

    /** @return Chain<scalar|null|''> */
    public static function undefOrIsbn(): Chain;

    /** @return Chain<iterable|null|''> */
    public static function undefOrIterableType(): Chain;

    /** @return Chain<array|\stdClass|\Traversable|null|''> */
    public static function undefOrIterableVal(): Chain;

    /** @return Chain<string|null|''> */
    public static function undefOrJson(): Chain;

    /** @return Chain<mixed> */
    public static function undefOrKey(int|string $key, Validator $validator): Chain;

    /** @return Chain<array|\ArrayAccess|null|''> */
    public static function undefOrKeyExists(int|string $key): Chain;

    /** @return Chain<mixed> */
    public static function undefOrKeyOptional(int|string $key, Validator $validator): Chain;

    /** @return Chain<array|null|''> */
    public static function undefOrKeySet(Validator $validator, Validator ...$validators): Chain;

    /**
     * @param "alpha-2"|"alpha-3" $set
     * @return Chain<string|null|''>
     */
    public static function undefOrLanguageCode(string $set = 'alpha-2'): Chain;

    /** @return Chain<scalar|\DateTimeInterface|null|''> */
    public static function undefOrLeapDate(string $format): Chain;

    /** @return Chain<scalar|\DateTimeInterface|null|''> */
    public static function undefOrLeapYear(): Chain;

    /** @return Chain<mixed> */
    public static function undefOrLength(Validator $validator): Chain;

    /** @return Chain<mixed> */
    public static function undefOrLessThan(mixed $compareTo): Chain;

    /** @return Chain<mixed> */
    public static function undefOrLessThanOrEqual(mixed $compareTo): Chain;

    /** @return Chain<string|null|''> */
    public static function undefOrLowercase(): Chain;

    /** @return Chain<scalar|null|''> */
    public static function undefOrLuhn(): Chain;

    /** @return Chain<string|null|''> */
    public static function undefOrMacAddress(): Chain;

    /** @return Chain<mixed> */
    public static function undefOrMax(Validator $validator): Chain;

    /** @return Chain<string|\SplFileInfo|null|''> */
    public static function undefOrMimetype(string $mimetype): Chain;

    /** @return Chain<mixed> */
    public static function undefOrMin(Validator $validator): Chain;

    /** @return Chain<mixed> */
    public static function undefOrMultiple(int $multipleOf): Chain;

    /** @return Chain<int|float|numeric-string|null|''> */
    public static function undefOrNegative(): Chain;

    /** @return Chain<string|null|''> */
    public static function undefOrNfeAccessKey(): Chain;

    /** @return Chain<string|null|''> */
    public static function undefOrNif(): Chain;

    /** @return Chain<scalar|null|''> */
    public static function undefOrNip(): Chain;

    /** @return Chain<mixed> */
    public static function undefOrNoneOf(Validator $validator1, Validator $validator2, Validator ...$validators): Chain;

    /** @return Chain<mixed> */
    public static function undefOrNot(Validator $validator): Chain;

    /** @return Chain<null|''> */
    public static function undefOrNullType(): Chain;

    /** @return Chain<int|float|numeric-string|null|''> */
    public static function undefOrNumber(): Chain;

    /** @return Chain<int|float|numeric-string|null|''> */
    public static function undefOrNumericVal(): Chain;

    /** @return Chain<object|null|''> */
    public static function undefOrObjectType(): Chain;

    /** @return Chain<int|float|numeric-string|null|''> */
    public static function undefOrOdd(): Chain;

    /** @return Chain<mixed> */
    public static function undefOrOneOf(Validator $validator1, Validator $validator2, Validator ...$validators): Chain;

    /** @return Chain<scalar|null|''> */
    public static function undefOrPesel(): Chain;

    /** @return Chain<scalar|null|''> */
    public static function undefOrPhone(string|null $countryCode = null): Chain;

    /** @return Chain<scalar|null|''> */
    public static function undefOrPis(): Chain;

    /** @return Chain<scalar|null|''> */
    public static function undefOrPolishIdCard(): Chain;

    /** @return Chain<string|null|''> */
    public static function undefOrPortugueseNif(): Chain;

    /** @return Chain<int|float|numeric-string|null|''> */
    public static function undefOrPositive(): Chain;

    /** @return Chain<scalar|null|''> */
    public static function undefOrPostalCode(string $countryCode, bool $formatted = false): Chain;

    /** @return Chain<scalar|null|''> */
    public static function undefOrPrintable(string ...$additionalChars): Chain;

    /** @return Chain<mixed> */
    public static function undefOrProperty(string $propertyName, Validator $validator): Chain;

    /** @return Chain<object|null|''> */
    public static function undefOrPropertyExists(string $propertyName): Chain;

    /** @return Chain<mixed> */
    public static function undefOrPropertyOptional(string $propertyName, Validator $validator): Chain;

    /** @return Chain<scalar|null|''> */
    public static function undefOrPublicDomainSuffix(): Chain;

    /** @return Chain<scalar|null|''> */
    public static function undefOrPunct(string ...$additionalChars): Chain;

    /** @return Chain<string|\SplFileInfo|\Psr\Http\Message\StreamInterface|null|''> */
    public static function undefOrReadable(): Chain;

    /** @return Chain<scalar|null|''> */
    public static function undefOrRegex(string $regex): Chain;

    /** @return Chain<resource|null|''> */
    public static function undefOrResourceType(): Chain;

    /** @return Chain<string|null|''> */
    public static function undefOrRoman(): Chain;

    /** @return Chain<mixed> */
    public static function undefOrSatisfies(callable $callback, mixed ...$arguments): Chain;

    /** @return Chain<int|float|bool|string|null|''> */
    public static function undefOrScalarVal(): Chain;

    /** @return Chain<mixed> */
    public static function undefOrShortCircuit(Validator ...$validators): Chain;

    /**
     * @param "B"|"KB"|"MB"|"GB"|"TB"|"PB"|"EB"|"ZB"|"YB" $unit
     * @return Chain<string|\SplFileInfo|\Psr\Http\Message\UploadedFileInterface|\Psr\Http\Message\StreamInterface|null|''>
     */
    public static function undefOrSize(string $unit, Validator $validator): Chain;

    /** @return Chain<string|null|''> */
    public static function undefOrSlug(): Chain;

    /** @return Chain<array|string|null|''> */
    public static function undefOrSorted(string $direction): Chain;

    /** @return Chain<scalar|null|''> */
    public static function undefOrSpace(string ...$additionalChars): Chain;

    /** @return Chain<string|null|''> */
    public static function undefOrSpaced(): Chain;

    /** @return Chain<array|string|null|''> */
    public static function undefOrStartsWith(mixed $startValue, mixed ...$startValues): Chain;

    /** @return Chain<string|null|''> */
    public static function undefOrStringType(): Chain;

    /** @return Chain<scalar|\Stringable|null|''> */
    public static function undefOrStringVal(): Chain;

    /** @return Chain<scalar|null|''> */
    public static function undefOrSubdivisionCode(string $countryCode): Chain;

    /**
     * @param mixed[] $superset
     * @return Chain<array|null|''>
     */
    public static function undefOrSubset(array $superset): Chain;

    /** @return Chain<string|\SplFileInfo|null|''> */
    public static function undefOrSymbolicLink(): Chain;

    /** @return Chain<scalar|null|''> */
    public static function undefOrTime(string $format = 'H:i:s'): Chain;

    /** @return Chain<string|null|''> */
    public static function undefOrTld(): Chain;

    /** @return Chain<string|null|''> */
    public static function undefOrTrimmed(string ...$trimValues): Chain;

    /** @return Chain<scalar|null|''> */
    public static function undefOrTrueVal(): Chain;

    /** @return Chain<array|null|''> */
    public static function undefOrUnique(): Chain;

    /** @return Chain<string|null|''> */
    public static function undefOrUppercase(): Chain;

    /** @return Chain<string|null|''> */
    public static function undefOrUrl(): Chain;

    /** @return Chain<string|\Ramsey\Uuid\UuidInterface|null|''> */
    public static function undefOrUuid(int|null $version = null): Chain;

    /** @return Chain<string|null|''> */
    public static function undefOrVersion(): Chain;

    /** @return Chain<scalar|null|''> */
    public static function undefOrVowel(string ...$additionalChars): Chain;

    /** @return Chain<mixed> */
    public static function undefOrWhen(Validator $when, Validator $then, Validator|null $else = null): Chain;

    /** @return Chain<string|\SplFileInfo|\Psr\Http\Message\StreamInterface|null|''> */
    public static function undefOrWritable(): Chain;

    /** @return Chain<scalar|null|''> */
    public static function undefOrXdigit(string ...$additionalChars): Chain;
}
