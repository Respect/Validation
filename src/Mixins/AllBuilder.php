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

interface AllBuilder
{
    /** @return Chain<iterable> */
    public static function allAfter(callable $callable, Validator $validator): Chain;

    /** @return Chain<iterable> */
    public static function allAllOf(Validator $validator1, Validator $validator2, Validator ...$validators): Chain;

    /** @return Chain<iterable<scalar>> */
    public static function allAlnum(string ...$additionalChars): Chain;

    /** @return Chain<iterable<scalar>> */
    public static function allAlpha(string ...$additionalChars): Chain;

    /** @return Chain<iterable> */
    public static function allAlwaysInvalid(): Chain;

    /** @return Chain<iterable> */
    public static function allAlwaysValid(): Chain;

    /** @return Chain<iterable> */
    public static function allAnyOf(Validator $validator1, Validator $validator2, Validator ...$validators): Chain;

    /** @return Chain<iterable<array>> */
    public static function allArrayType(): Chain;

    /** @return Chain<iterable<array|\ArrayAccess|\SimpleXMLElement>> */
    public static function allArrayVal(): Chain;

    /** @return Chain<iterable> */
    public static function allBase(int $base, string $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'): Chain;

    /** @return Chain<iterable<string>> */
    public static function allBase64(): Chain;

    /** @return Chain<iterable> */
    public static function allBetween(mixed $minValue, mixed $maxValue): Chain;

    /** @return Chain<iterable> */
    public static function allBetweenExclusive(mixed $minimum, mixed $maximum): Chain;

    /** @return Chain<iterable> */
    public static function allBlank(): Chain;

    /** @return Chain<iterable<bool>> */
    public static function allBoolType(): Chain;

    /** @return Chain<iterable<scalar|null>> */
    public static function allBoolVal(): Chain;

    /** @return Chain<iterable<scalar>> */
    public static function allBsn(): Chain;

    /** @return Chain<iterable<callable>> */
    public static function allCallableType(): Chain;

    /** @return Chain<iterable<string>> */
    public static function allCharset(string $charset, string ...$charsets): Chain;

    /** @return Chain<iterable<scalar>> */
    public static function allCnh(): Chain;

    /** @return Chain<iterable<scalar>> */
    public static function allCnpj(): Chain;

    /** @return Chain<iterable<scalar>> */
    public static function allConsonant(string ...$additionalChars): Chain;

    /** @return Chain<iterable<scalar|array>> */
    public static function allContains(mixed $containsValue): Chain;

    /**
     * @param non-empty-array<mixed> $needles
     * @return Chain<iterable<scalar|array>>
     */
    public static function allContainsAny(array $needles): Chain;

    /** @return Chain<iterable<scalar|array>> */
    public static function allContainsCount(mixed $containsValue, int $count): Chain;

    /** @return Chain<iterable<scalar>> */
    public static function allControl(string ...$additionalChars): Chain;

    /** @return Chain<iterable<array|\Countable>> */
    public static function allCountable(): Chain;

    /**
     * @param "alpha-2"|"alpha-3"|"numeric" $set
     * @return Chain<iterable<string>>
     */
    public static function allCountryCode(string $set = 'alpha-2'): Chain;

    /** @return Chain<iterable<string>> */
    public static function allCpf(): Chain;

    /** @return Chain<iterable<scalar>> */
    public static function allCreditCard(string $brand = 'Any'): Chain;

    /**
     * @param "alpha-3"|"numeric" $set
     * @return Chain<iterable<string>>
     */
    public static function allCurrencyCode(string $set = 'alpha-3'): Chain;

    /** @return Chain<iterable<scalar>> */
    public static function allDate(string $format = 'Y-m-d'): Chain;

    /** @return Chain<iterable<scalar|\DateTimeInterface>> */
    public static function allDateTime(string|null $format = null): Chain;

    /**
     * @param "years"|"months"|"days"|"hours"|"minutes"|"seconds"|"microseconds" $type
     * @return Chain<iterable<string|\DateTimeInterface>>
     */
    public static function allDateTimeDiff(string $type, Validator $validator, string|null $format = null, DateTimeImmutable|null $now = null): Chain;

    /** @return Chain<iterable<int|float|numeric-string>> */
    public static function allDecimal(int $decimals): Chain;

    /** @return Chain<iterable<scalar>> */
    public static function allDigit(string ...$additionalChars): Chain;

    /** @return Chain<iterable<string|\SplFileInfo>> */
    public static function allDirectory(): Chain;

    /** @return Chain<iterable<string>> */
    public static function allDomain(bool $tldCheck = true): Chain;

    /** @return Chain<iterable> */
    public static function allEach(Validator $validator): Chain;

    /** @return Chain<iterable> */
    public static function allEachKey(Validator $validator): Chain;

    /** @return Chain<iterable<string>> */
    public static function allEmail(): Chain;

    /** @return Chain<iterable<string>> */
    public static function allEmoji(): Chain;

    /** @return Chain<iterable<array|string>> */
    public static function allEndsWith(mixed $endValue, mixed ...$endValues): Chain;

    /** @return Chain<iterable> */
    public static function allEquals(mixed $compareTo): Chain;

    /** @return Chain<iterable> */
    public static function allEquivalent(mixed $compareTo): Chain;

    /** @return Chain<iterable<int|float|numeric-string>> */
    public static function allEven(): Chain;

    /** @return Chain<iterable<string|\SplFileInfo>> */
    public static function allExecutable(): Chain;

    /** @return Chain<iterable<string|\SplFileInfo>> */
    public static function allExtension(string $extension): Chain;

    /** @return Chain<iterable> */
    public static function allFactor(int $dividend): Chain;

    /**
     * @param callable(mixed): Validator $factory
     * @return Chain<iterable>
     */
    public static function allFactory(callable $factory): Chain;

    /** @return Chain<iterable<scalar|null>> */
    public static function allFalseVal(): Chain;

    /** @return Chain<iterable> */
    public static function allFalsy(): Chain;

    /** @return Chain<iterable<string|\SplFileInfo>> */
    public static function allFile(): Chain;

    /** @return Chain<iterable<int|float|numeric-string>> */
    public static function allFinite(): Chain;

    /** @return Chain<iterable<float>> */
    public static function allFloatType(): Chain;

    /** @return Chain<iterable<int|float|numeric-string|true>> */
    public static function allFloatVal(): Chain;

    /** @return Chain<iterable<scalar|\Stringable>> */
    public static function allFormat(Formatter $formatter): Chain;

    /** @return Chain<iterable> */
    public static function allGiven(Validator $when, Validator $then): Chain;

    /** @return Chain<iterable<scalar>> */
    public static function allGraph(string ...$additionalChars): Chain;

    /** @return Chain<iterable> */
    public static function allGreaterThan(mixed $compareTo): Chain;

    /** @return Chain<iterable> */
    public static function allGreaterThanOrEqual(mixed $compareTo): Chain;

    /** @return Chain<iterable<string>> */
    public static function allHetu(): Chain;

    /** @return Chain<iterable<scalar>> */
    public static function allHexRgbColor(): Chain;

    /** @return Chain<iterable<string>> */
    public static function allIban(): Chain;

    /** @return Chain<iterable> */
    public static function allIdentical(mixed $compareTo): Chain;

    /** @return Chain<iterable<string|\SplFileInfo>> */
    public static function allImage(): Chain;

    /** @return Chain<iterable<scalar>> */
    public static function allImei(): Chain;

    /** @return Chain<iterable> */
    public static function allIn(mixed $haystack): Chain;

    /** @return Chain<iterable<int|float|numeric-string>> */
    public static function allInfinite(): Chain;

    /**
     * @param class-string $class
     * @return Chain<iterable>
     */
    public static function allInstance(string $class): Chain;

    /** @return Chain<iterable<int>> */
    public static function allIntType(): Chain;

    /** @return Chain<iterable<int|numeric-string>> */
    public static function allIntVal(): Chain;

    /** @return Chain<iterable<string>> */
    public static function allIp(string $range = '*', int|null $options = null): Chain;

    /** @return Chain<iterable<scalar>> */
    public static function allIsbn(): Chain;

    /** @return Chain<iterable<iterable>> */
    public static function allIterableType(): Chain;

    /** @return Chain<iterable<array|\stdClass|\Traversable>> */
    public static function allIterableVal(): Chain;

    /** @return Chain<iterable<string>> */
    public static function allJson(): Chain;

    /**
     * @param "alpha-2"|"alpha-3" $set
     * @return Chain<iterable<string>>
     */
    public static function allLanguageCode(string $set = 'alpha-2'): Chain;

    /** @return Chain<iterable<scalar|\DateTimeInterface>> */
    public static function allLeapDate(string $format): Chain;

    /** @return Chain<iterable<scalar|\DateTimeInterface>> */
    public static function allLeapYear(): Chain;

    /** @return Chain<iterable> */
    public static function allLength(Validator $validator): Chain;

    /** @return Chain<iterable> */
    public static function allLessThan(mixed $compareTo): Chain;

    /** @return Chain<iterable> */
    public static function allLessThanOrEqual(mixed $compareTo): Chain;

    /** @return Chain<iterable<string>> */
    public static function allLowercase(): Chain;

    /** @return Chain<iterable<scalar>> */
    public static function allLuhn(): Chain;

    /** @return Chain<iterable<string>> */
    public static function allMacAddress(): Chain;

    /** @return Chain<iterable> */
    public static function allMax(Validator $validator): Chain;

    /** @return Chain<iterable<string|\SplFileInfo>> */
    public static function allMimetype(string $mimetype): Chain;

    /** @return Chain<iterable> */
    public static function allMin(Validator $validator): Chain;

    /** @return Chain<iterable> */
    public static function allMultiple(int $multipleOf): Chain;

    /** @return Chain<iterable<int|float|numeric-string>> */
    public static function allNegative(): Chain;

    /** @return Chain<iterable<string>> */
    public static function allNfeAccessKey(): Chain;

    /** @return Chain<iterable<string>> */
    public static function allNif(): Chain;

    /** @return Chain<iterable<scalar>> */
    public static function allNip(): Chain;

    /** @return Chain<iterable> */
    public static function allNoneOf(Validator $validator1, Validator $validator2, Validator ...$validators): Chain;

    /** @return Chain<iterable> */
    public static function allNot(Validator $validator): Chain;

    /** @return Chain<iterable<null>> */
    public static function allNullType(): Chain;

    /** @return Chain<iterable<int|float|numeric-string>> */
    public static function allNumber(): Chain;

    /** @return Chain<iterable<int|float|numeric-string>> */
    public static function allNumericVal(): Chain;

    /** @return Chain<iterable<object>> */
    public static function allObjectType(): Chain;

    /** @return Chain<iterable<int|float|numeric-string>> */
    public static function allOdd(): Chain;

    /** @return Chain<iterable> */
    public static function allOneOf(Validator $validator1, Validator $validator2, Validator ...$validators): Chain;

    /** @return Chain<iterable<scalar>> */
    public static function allPesel(): Chain;

    /** @return Chain<iterable<scalar>> */
    public static function allPhone(string|null $countryCode = null): Chain;

    /** @return Chain<iterable<scalar>> */
    public static function allPis(): Chain;

    /** @return Chain<iterable<scalar>> */
    public static function allPolishIdCard(): Chain;

    /** @return Chain<iterable<string>> */
    public static function allPortugueseNif(): Chain;

    /** @return Chain<iterable<int|float|numeric-string>> */
    public static function allPositive(): Chain;

    /** @return Chain<iterable<scalar>> */
    public static function allPostalCode(string $countryCode, bool $formatted = false): Chain;

    /** @return Chain<iterable<scalar>> */
    public static function allPrintable(string ...$additionalChars): Chain;

    /** @return Chain<iterable<scalar>> */
    public static function allPublicDomainSuffix(): Chain;

    /** @return Chain<iterable<scalar>> */
    public static function allPunct(string ...$additionalChars): Chain;

    /** @return Chain<iterable<string|\SplFileInfo|\Psr\Http\Message\StreamInterface>> */
    public static function allReadable(): Chain;

    /** @return Chain<iterable<scalar>> */
    public static function allRegex(string $regex): Chain;

    /** @return Chain<iterable<resource>> */
    public static function allResourceType(): Chain;

    /** @return Chain<iterable<string>> */
    public static function allRoman(): Chain;

    /** @return Chain<iterable> */
    public static function allSatisfies(callable $callback, mixed ...$arguments): Chain;

    /** @return Chain<iterable<int|float|bool|string>> */
    public static function allScalarVal(): Chain;

    /** @return Chain<iterable> */
    public static function allShortCircuit(Validator ...$validators): Chain;

    /**
     * @param "B"|"KB"|"MB"|"GB"|"TB"|"PB"|"EB"|"ZB"|"YB" $unit
     * @return Chain<iterable<string|\SplFileInfo|\Psr\Http\Message\UploadedFileInterface|\Psr\Http\Message\StreamInterface>>
     */
    public static function allSize(string $unit, Validator $validator): Chain;

    /** @return Chain<iterable<string>> */
    public static function allSlug(): Chain;

    /** @return Chain<iterable<array|string>> */
    public static function allSorted(string $direction): Chain;

    /** @return Chain<iterable<scalar>> */
    public static function allSpace(string ...$additionalChars): Chain;

    /** @return Chain<iterable<string>> */
    public static function allSpaced(): Chain;

    /** @return Chain<iterable<array|string>> */
    public static function allStartsWith(mixed $startValue, mixed ...$startValues): Chain;

    /** @return Chain<iterable<string>> */
    public static function allStringType(): Chain;

    /** @return Chain<iterable<scalar|\Stringable>> */
    public static function allStringVal(): Chain;

    /** @return Chain<iterable<scalar|null>> */
    public static function allSubdivisionCode(string $countryCode): Chain;

    /**
     * @param mixed[] $superset
     * @return Chain<iterable<array>>
     */
    public static function allSubset(array $superset): Chain;

    /** @return Chain<iterable<string|\SplFileInfo>> */
    public static function allSymbolicLink(): Chain;

    /** @return Chain<iterable<scalar>> */
    public static function allTime(string $format = 'H:i:s'): Chain;

    /** @return Chain<iterable<string>> */
    public static function allTld(): Chain;

    /** @return Chain<iterable<string>> */
    public static function allTrimmed(string ...$trimValues): Chain;

    /** @return Chain<iterable<scalar>> */
    public static function allTrueVal(): Chain;

    /** @return Chain<iterable<null|''>> */
    public static function allUndef(): Chain;

    /** @return Chain<iterable<array>> */
    public static function allUnique(): Chain;

    /** @return Chain<iterable<string>> */
    public static function allUppercase(): Chain;

    /** @return Chain<iterable<string>> */
    public static function allUrl(): Chain;

    /** @return Chain<iterable<string|\Ramsey\Uuid\UuidInterface>> */
    public static function allUuid(int|null $version = null): Chain;

    /** @return Chain<iterable<string>> */
    public static function allVersion(): Chain;

    /** @return Chain<iterable<scalar>> */
    public static function allVowel(string ...$additionalChars): Chain;

    /** @return Chain<iterable> */
    public static function allWhen(Validator $when, Validator $then, Validator|null $else = null): Chain;

    /** @return Chain<iterable<string|\SplFileInfo|\Psr\Http\Message\StreamInterface>> */
    public static function allWritable(): Chain;

    /** @return Chain<iterable<scalar>> */
    public static function allXdigit(string ...$additionalChars): Chain;
}
