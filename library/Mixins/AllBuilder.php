<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Mixins;

use DateTimeImmutable;
use Respect\Validation\Validator;

interface AllBuilder
{
    public static function allAlnum(string ...$additionalChars): Chain;

    public static function allAlpha(string ...$additionalChars): Chain;

    public static function allAlwaysInvalid(): Chain;

    public static function allAlwaysValid(): Chain;

    public static function allArrayType(): Chain;

    public static function allArrayVal(): Chain;

    public static function allBase(
        int $base,
        string $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
    ): Chain;

    public static function allBase64(): Chain;

    public static function allBetween(mixed $minValue, mixed $maxValue): Chain;

    public static function allBetweenExclusive(mixed $minimum, mixed $maximum): Chain;

    public static function allBlank(): Chain;

    public static function allBoolType(): Chain;

    public static function allBoolVal(): Chain;

    public static function allBsn(): Chain;

    public static function allCall(callable $callable, Validator $validator): Chain;

    public static function allCallableType(): Chain;

    public static function allCallback(callable $callback, mixed ...$arguments): Chain;

    public static function allCharset(string $charset, string ...$charsets): Chain;

    public static function allCircuit(Validator $validator1, Validator $validator2, Validator ...$validators): Chain;

    public static function allCnh(): Chain;

    public static function allCnpj(): Chain;

    public static function allConsonant(string ...$additionalChars): Chain;

    public static function allContains(mixed $containsValue, bool $identical = false): Chain;

    /** @param non-empty-array<mixed> $needles */
    public static function allContainsAny(array $needles, bool $identical = false): Chain;

    public static function allControl(string ...$additionalChars): Chain;

    public static function allCountable(): Chain;

    /** @param "alpha-2"|"alpha-3"|"numeric" $set */
    public static function allCountryCode(string $set = 'alpha-2'): Chain;

    public static function allCpf(): Chain;

    public static function allCreditCard(string $brand = 'Any'): Chain;

    /** @param "alpha-3"|"numeric" $set */
    public static function allCurrencyCode(string $set = 'alpha-3'): Chain;

    public static function allDate(string $format = 'Y-m-d'): Chain;

    public static function allDateTime(string|null $format = null): Chain;

    /** @param "years"|"months"|"days"|"hours"|"minutes"|"seconds"|"microseconds" $type */
    public static function allDateTimeDiff(
        string $type,
        Validator $validator,
        string|null $format = null,
        DateTimeImmutable|null $now = null,
    ): Chain;

    public static function allDecimal(int $decimals): Chain;

    public static function allDigit(string ...$additionalChars): Chain;

    public static function allDirectory(): Chain;

    public static function allDomain(bool $tldCheck = true): Chain;

    public static function allEach(Validator $validator): Chain;

    public static function allEmail(): Chain;

    public static function allEmoji(): Chain;

    public static function allEndsWith(mixed $endValue, bool $identical = false): Chain;

    public static function allEquals(mixed $compareTo): Chain;

    public static function allEquivalent(mixed $compareTo): Chain;

    public static function allEven(): Chain;

    public static function allExecutable(): Chain;

    public static function allExtension(string $extension): Chain;

    public static function allFactor(int $dividend): Chain;

    public static function allFalseVal(): Chain;

    public static function allFalsy(): Chain;

    public static function allFibonacci(): Chain;

    public static function allFile(): Chain;

    public static function allFilterVar(int $filter, mixed $options = null): Chain;

    public static function allFinite(): Chain;

    public static function allFloatType(): Chain;

    public static function allFloatVal(): Chain;

    public static function allGraph(string ...$additionalChars): Chain;

    public static function allGreaterThan(mixed $compareTo): Chain;

    public static function allGreaterThanOrEqual(mixed $compareTo): Chain;

    public static function allHetu(): Chain;

    public static function allHexRgbColor(): Chain;

    public static function allIban(): Chain;

    public static function allIdentical(mixed $compareTo): Chain;

    public static function allImage(): Chain;

    public static function allImei(): Chain;

    public static function allIn(mixed $haystack, bool $compareIdentical = false): Chain;

    public static function allInfinite(): Chain;

    /** @param class-string $class */
    public static function allInstance(string $class): Chain;

    public static function allIntType(): Chain;

    public static function allIntVal(): Chain;

    public static function allIp(string $range = '*', int|null $options = null): Chain;

    public static function allIsbn(): Chain;

    public static function allIterableType(): Chain;

    public static function allIterableVal(): Chain;

    public static function allJson(): Chain;

    /** @param "alpha-2"|"alpha-3" $set */
    public static function allLanguageCode(string $set = 'alpha-2'): Chain;

    /** @param callable(mixed): Validator $validatorCreator */
    public static function allLazy(callable $validatorCreator): Chain;

    public static function allLeapDate(string $format): Chain;

    public static function allLeapYear(): Chain;

    public static function allLength(Validator $validator): Chain;

    public static function allLessThan(mixed $compareTo): Chain;

    public static function allLessThanOrEqual(mixed $compareTo): Chain;

    public static function allLogicAnd(
        Validator $validator1,
        Validator $validator2,
        Validator ...$validators,
    ): Chain;

    public static function allLogicNor(
        Validator $validator1,
        Validator $validator2,
        Validator ...$validators,
    ): Chain;

    public static function allLogicOr(Validator $validator1, Validator $validator2, Validator ...$validators): Chain;

    public static function allLowercase(): Chain;

    public static function allLuhn(): Chain;

    public static function allMacAddress(): Chain;

    public static function allMax(Validator $validator): Chain;

    public static function allMimetype(string $mimetype): Chain;

    public static function allMin(Validator $validator): Chain;

    public static function allMultiple(int $multipleOf): Chain;

    public static function allNegative(): Chain;

    public static function allNfeAccessKey(): Chain;

    public static function allNif(): Chain;

    public static function allNip(): Chain;

    public static function allNot(Validator $validator): Chain;

    public static function allNullType(): Chain;

    public static function allNumber(): Chain;

    public static function allNumericVal(): Chain;

    public static function allObjectType(): Chain;

    public static function allOdd(): Chain;

    public static function allOneOf(Validator $validator1, Validator $validator2, Validator ...$validators): Chain;

    public static function allPerfectSquare(): Chain;

    public static function allPesel(): Chain;

    public static function allPhone(string|null $countryCode = null): Chain;

    public static function allPhpLabel(): Chain;

    public static function allPis(): Chain;

    public static function allPolishIdCard(): Chain;

    public static function allPortugueseNif(): Chain;

    public static function allPositive(): Chain;

    public static function allPostalCode(string $countryCode, bool $formatted = false): Chain;

    public static function allPrimeNumber(): Chain;

    public static function allPrintable(string ...$additionalChars): Chain;

    public static function allPublicDomainSuffix(): Chain;

    public static function allPunct(string ...$additionalChars): Chain;

    public static function allReadable(): Chain;

    public static function allRegex(string $regex): Chain;

    public static function allResourceType(): Chain;

    public static function allRoman(): Chain;

    public static function allScalarVal(): Chain;

    /** @param "B"|"KB"|"MB"|"GB"|"TB"|"PB"|"EB"|"ZB"|"YB" $unit */
    public static function allSize(string $unit, Validator $validator): Chain;

    public static function allSlug(): Chain;

    public static function allSorted(string $direction): Chain;

    public static function allSpace(string ...$additionalChars): Chain;

    public static function allSpaced(): Chain;

    public static function allStartsWith(mixed $startValue, bool $identical = false): Chain;

    public static function allStringType(): Chain;

    public static function allStringVal(): Chain;

    public static function allSubdivisionCode(string $countryCode): Chain;

    /** @param mixed[] $superset */
    public static function allSubset(array $superset): Chain;

    public static function allSymbolicLink(): Chain;

    public static function allTime(string $format = 'H:i:s'): Chain;

    public static function allTld(): Chain;

    public static function allTrueVal(): Chain;

    public static function allUndef(): Chain;

    public static function allUnique(): Chain;

    public static function allUploaded(): Chain;

    public static function allUppercase(): Chain;

    public static function allUrl(): Chain;

    public static function allUuid(int|null $version = null): Chain;

    public static function allVersion(): Chain;

    public static function allVideoUrl(string|null $service = null): Chain;

    public static function allVowel(string ...$additionalChars): Chain;

    public static function allWhen(Validator $when, Validator $then, Validator|null $else = null): Chain;

    public static function allWritable(): Chain;

    public static function allXdigit(string ...$additionalChars): Chain;
}
