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

interface AllChain
{
    /** @return Chain<mixed> */
    public function allAfter(callable $callable, Validator $validator): Chain;

    /** @return Chain<mixed> */
    public function allAllOf(Validator $validator1, Validator $validator2, Validator ...$validators): Chain;

    /** @return Chain<mixed> */
    public function allAlnum(string ...$additionalChars): Chain;

    /** @return Chain<mixed> */
    public function allAlpha(string ...$additionalChars): Chain;

    /** @return Chain<mixed> */
    public function allAlwaysInvalid(): Chain;

    /** @return Chain<mixed> */
    public function allAlwaysValid(): Chain;

    /** @return Chain<mixed> */
    public function allAnyOf(Validator $validator1, Validator $validator2, Validator ...$validators): Chain;

    /** @return Chain<mixed> */
    public function allArrayType(): Chain;

    /** @return Chain<mixed> */
    public function allArrayVal(): Chain;

    /** @return Chain<mixed> */
    public function allBase(int $base, string $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'): Chain;

    /** @return Chain<mixed> */
    public function allBase64(): Chain;

    /** @return Chain<mixed> */
    public function allBetween(mixed $minValue, mixed $maxValue): Chain;

    /** @return Chain<mixed> */
    public function allBetweenExclusive(mixed $minimum, mixed $maximum): Chain;

    /** @return Chain<mixed> */
    public function allBlank(): Chain;

    /** @return Chain<mixed> */
    public function allBoolType(): Chain;

    /** @return Chain<mixed> */
    public function allBoolVal(): Chain;

    /** @return Chain<mixed> */
    public function allBsn(): Chain;

    /** @return Chain<mixed> */
    public function allCallableType(): Chain;

    /** @return Chain<mixed> */
    public function allCharset(string $charset, string ...$charsets): Chain;

    /** @return Chain<mixed> */
    public function allCnh(): Chain;

    /** @return Chain<mixed> */
    public function allCnpj(): Chain;

    /** @return Chain<mixed> */
    public function allConsonant(string ...$additionalChars): Chain;

    /** @return Chain<mixed> */
    public function allContains(mixed $containsValue): Chain;

    /**
     * @param non-empty-array<mixed> $needles
     * @return Chain<mixed>
     */
    public function allContainsAny(array $needles): Chain;

    /** @return Chain<mixed> */
    public function allContainsCount(mixed $containsValue, int $count): Chain;

    /** @return Chain<mixed> */
    public function allControl(string ...$additionalChars): Chain;

    /** @return Chain<mixed> */
    public function allCountable(): Chain;

    /**
     * @param "alpha-2"|"alpha-3"|"numeric" $set
     * @return Chain<mixed>
     */
    public function allCountryCode(string $set = 'alpha-2'): Chain;

    /** @return Chain<mixed> */
    public function allCpf(): Chain;

    /** @return Chain<mixed> */
    public function allCreditCard(string $brand = 'Any'): Chain;

    /**
     * @param "alpha-3"|"numeric" $set
     * @return Chain<mixed>
     */
    public function allCurrencyCode(string $set = 'alpha-3'): Chain;

    /** @return Chain<mixed> */
    public function allDate(string $format = 'Y-m-d'): Chain;

    /** @return Chain<mixed> */
    public function allDateTime(string|null $format = null): Chain;

    /**
     * @param "years"|"months"|"days"|"hours"|"minutes"|"seconds"|"microseconds" $type
     * @return Chain<mixed>
     */
    public function allDateTimeDiff(string $type, Validator $validator, string|null $format = null, DateTimeImmutable|null $now = null): Chain;

    /** @return Chain<mixed> */
    public function allDecimal(int $decimals): Chain;

    /** @return Chain<mixed> */
    public function allDigit(string ...$additionalChars): Chain;

    /** @return Chain<mixed> */
    public function allDirectory(): Chain;

    /** @return Chain<mixed> */
    public function allDomain(bool $tldCheck = true): Chain;

    /** @return Chain<mixed> */
    public function allEach(Validator $validator): Chain;

    /** @return Chain<mixed> */
    public function allEachKey(Validator $validator): Chain;

    /** @return Chain<mixed> */
    public function allEmail(): Chain;

    /** @return Chain<mixed> */
    public function allEmoji(): Chain;

    /** @return Chain<mixed> */
    public function allEndsWith(mixed $endValue, mixed ...$endValues): Chain;

    /** @return Chain<mixed> */
    public function allEquals(mixed $compareTo): Chain;

    /** @return Chain<mixed> */
    public function allEquivalent(mixed $compareTo): Chain;

    /** @return Chain<mixed> */
    public function allEven(): Chain;

    /** @return Chain<mixed> */
    public function allExecutable(): Chain;

    /** @return Chain<mixed> */
    public function allExtension(string $extension): Chain;

    /** @return Chain<mixed> */
    public function allFactor(int $dividend): Chain;

    /**
     * @param callable(mixed): Validator $factory
     * @return Chain<mixed>
     */
    public function allFactory(callable $factory): Chain;

    /** @return Chain<mixed> */
    public function allFalseVal(): Chain;

    /** @return Chain<mixed> */
    public function allFalsy(): Chain;

    /** @return Chain<mixed> */
    public function allFile(): Chain;

    /** @return Chain<mixed> */
    public function allFinite(): Chain;

    /** @return Chain<mixed> */
    public function allFloatType(): Chain;

    /** @return Chain<mixed> */
    public function allFloatVal(): Chain;

    /** @return Chain<mixed> */
    public function allFormat(Formatter $formatter): Chain;

    /** @return Chain<mixed> */
    public function allGiven(Validator $when, Validator $then): Chain;

    /** @return Chain<mixed> */
    public function allGraph(string ...$additionalChars): Chain;

    /** @return Chain<mixed> */
    public function allGreaterThan(mixed $compareTo): Chain;

    /** @return Chain<mixed> */
    public function allGreaterThanOrEqual(mixed $compareTo): Chain;

    /** @return Chain<mixed> */
    public function allHetu(): Chain;

    /** @return Chain<mixed> */
    public function allHexRgbColor(): Chain;

    /** @return Chain<mixed> */
    public function allIban(): Chain;

    /** @return Chain<mixed> */
    public function allIdentical(mixed $compareTo): Chain;

    /** @return Chain<mixed> */
    public function allImage(): Chain;

    /** @return Chain<mixed> */
    public function allImei(): Chain;

    /** @return Chain<mixed> */
    public function allIn(mixed $haystack): Chain;

    /** @return Chain<mixed> */
    public function allInfinite(): Chain;

    /**
     * @param class-string $class
     * @return Chain<mixed>
     */
    public function allInstance(string $class): Chain;

    /** @return Chain<mixed> */
    public function allIntType(): Chain;

    /** @return Chain<mixed> */
    public function allIntVal(): Chain;

    /** @return Chain<mixed> */
    public function allIp(string $range = '*', int|null $options = null): Chain;

    /** @return Chain<mixed> */
    public function allIsbn(): Chain;

    /** @return Chain<mixed> */
    public function allIterableType(): Chain;

    /** @return Chain<mixed> */
    public function allIterableVal(): Chain;

    /** @return Chain<mixed> */
    public function allJson(): Chain;

    /**
     * @param "alpha-2"|"alpha-3" $set
     * @return Chain<mixed>
     */
    public function allLanguageCode(string $set = 'alpha-2'): Chain;

    /** @return Chain<mixed> */
    public function allLeapDate(string $format): Chain;

    /** @return Chain<mixed> */
    public function allLeapYear(): Chain;

    /** @return Chain<mixed> */
    public function allLength(Validator $validator): Chain;

    /** @return Chain<mixed> */
    public function allLessThan(mixed $compareTo): Chain;

    /** @return Chain<mixed> */
    public function allLessThanOrEqual(mixed $compareTo): Chain;

    /** @return Chain<mixed> */
    public function allLowercase(): Chain;

    /** @return Chain<mixed> */
    public function allLuhn(): Chain;

    /** @return Chain<mixed> */
    public function allMacAddress(): Chain;

    /** @return Chain<mixed> */
    public function allMax(Validator $validator): Chain;

    /** @return Chain<mixed> */
    public function allMimetype(string $mimetype): Chain;

    /** @return Chain<mixed> */
    public function allMin(Validator $validator): Chain;

    /** @return Chain<mixed> */
    public function allMultiple(int $multipleOf): Chain;

    /** @return Chain<mixed> */
    public function allNegative(): Chain;

    /** @return Chain<mixed> */
    public function allNfeAccessKey(): Chain;

    /** @return Chain<mixed> */
    public function allNif(): Chain;

    /** @return Chain<mixed> */
    public function allNip(): Chain;

    /** @return Chain<mixed> */
    public function allNoneOf(Validator $validator1, Validator $validator2, Validator ...$validators): Chain;

    /** @return Chain<mixed> */
    public function allNot(Validator $validator): Chain;

    /** @return Chain<mixed> */
    public function allNullType(): Chain;

    /** @return Chain<mixed> */
    public function allNumber(): Chain;

    /** @return Chain<mixed> */
    public function allNumericVal(): Chain;

    /** @return Chain<mixed> */
    public function allObjectType(): Chain;

    /** @return Chain<mixed> */
    public function allOdd(): Chain;

    /** @return Chain<mixed> */
    public function allOneOf(Validator $validator1, Validator $validator2, Validator ...$validators): Chain;

    /** @return Chain<mixed> */
    public function allPesel(): Chain;

    /** @return Chain<mixed> */
    public function allPhone(string|null $countryCode = null): Chain;

    /** @return Chain<mixed> */
    public function allPis(): Chain;

    /** @return Chain<mixed> */
    public function allPolishIdCard(): Chain;

    /** @return Chain<mixed> */
    public function allPortugueseNif(): Chain;

    /** @return Chain<mixed> */
    public function allPositive(): Chain;

    /** @return Chain<mixed> */
    public function allPostalCode(string $countryCode, bool $formatted = false): Chain;

    /** @return Chain<mixed> */
    public function allPrintable(string ...$additionalChars): Chain;

    /** @return Chain<mixed> */
    public function allPublicDomainSuffix(): Chain;

    /** @return Chain<mixed> */
    public function allPunct(string ...$additionalChars): Chain;

    /** @return Chain<mixed> */
    public function allReadable(): Chain;

    /** @return Chain<mixed> */
    public function allRegex(string $regex): Chain;

    /** @return Chain<mixed> */
    public function allResourceType(): Chain;

    /** @return Chain<mixed> */
    public function allRoman(): Chain;

    /** @return Chain<mixed> */
    public function allSatisfies(callable $callback, mixed ...$arguments): Chain;

    /** @return Chain<mixed> */
    public function allScalarVal(): Chain;

    /** @return Chain<mixed> */
    public function allShortCircuit(Validator ...$validators): Chain;

    /**
     * @param "B"|"KB"|"MB"|"GB"|"TB"|"PB"|"EB"|"ZB"|"YB" $unit
     * @return Chain<mixed>
     */
    public function allSize(string $unit, Validator $validator): Chain;

    /** @return Chain<mixed> */
    public function allSlug(): Chain;

    /** @return Chain<mixed> */
    public function allSorted(string $direction): Chain;

    /** @return Chain<mixed> */
    public function allSpace(string ...$additionalChars): Chain;

    /** @return Chain<mixed> */
    public function allSpaced(): Chain;

    /** @return Chain<mixed> */
    public function allStartsWith(mixed $startValue, mixed ...$startValues): Chain;

    /** @return Chain<mixed> */
    public function allStringType(): Chain;

    /** @return Chain<mixed> */
    public function allStringVal(): Chain;

    /** @return Chain<mixed> */
    public function allSubdivisionCode(string $countryCode): Chain;

    /**
     * @param mixed[] $superset
     * @return Chain<mixed>
     */
    public function allSubset(array $superset): Chain;

    /** @return Chain<mixed> */
    public function allSymbolicLink(): Chain;

    /** @return Chain<mixed> */
    public function allTime(string $format = 'H:i:s'): Chain;

    /** @return Chain<mixed> */
    public function allTld(): Chain;

    /** @return Chain<mixed> */
    public function allTrimmed(string ...$trimValues): Chain;

    /** @return Chain<mixed> */
    public function allTrueVal(): Chain;

    /** @return Chain<mixed> */
    public function allUndef(): Chain;

    /** @return Chain<mixed> */
    public function allUnique(): Chain;

    /** @return Chain<mixed> */
    public function allUppercase(): Chain;

    /** @return Chain<mixed> */
    public function allUrl(): Chain;

    /** @return Chain<mixed> */
    public function allUuid(int|null $version = null): Chain;

    /** @return Chain<mixed> */
    public function allVersion(): Chain;

    /** @return Chain<mixed> */
    public function allVowel(string ...$additionalChars): Chain;

    /** @return Chain<mixed> */
    public function allWhen(Validator $when, Validator $then, Validator|null $else = null): Chain;

    /** @return Chain<mixed> */
    public function allWritable(): Chain;

    /** @return Chain<mixed> */
    public function allXdigit(string ...$additionalChars): Chain;
}
