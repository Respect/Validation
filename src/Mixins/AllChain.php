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
use Respect\Validation\Validator;

interface AllChain
{
    public function allAllOf(Validator $validator1, Validator $validator2, Validator ...$validators): Chain;

    public function allAlnum(string ...$additionalChars): Chain;

    public function allAlpha(string ...$additionalChars): Chain;

    public function allAlwaysInvalid(): Chain;

    public function allAlwaysValid(): Chain;

    public function allAnyOf(Validator $validator1, Validator $validator2, Validator ...$validators): Chain;

    public function allArrayType(): Chain;

    public function allArrayVal(): Chain;

    public function allBase(int $base, string $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'): Chain;

    public function allBase64(): Chain;

    public function allBetween(mixed $minValue, mixed $maxValue): Chain;

    public function allBetweenExclusive(mixed $minimum, mixed $maximum): Chain;

    public function allBlank(): Chain;

    public function allBoolType(): Chain;

    public function allBoolVal(): Chain;

    public function allBsn(): Chain;

    public function allCall(callable $callable, Validator $validator): Chain;

    public function allCallableType(): Chain;

    public function allCharset(string $charset, string ...$charsets): Chain;

    public function allCircuit(Validator $validator1, Validator $validator2, Validator ...$validators): Chain;

    public function allCnh(): Chain;

    public function allCnpj(): Chain;

    public function allConsonant(string ...$additionalChars): Chain;

    public function allContains(mixed $containsValue): Chain;

    /** @param non-empty-array<mixed> $needles */
    public function allContainsAny(array $needles): Chain;

    public function allContainsCount(mixed $containsValue, int $count): Chain;

    public function allControl(string ...$additionalChars): Chain;

    public function allCountable(): Chain;

    /** @param "alpha-2"|"alpha-3"|"numeric" $set */
    public function allCountryCode(string $set = 'alpha-2'): Chain;

    public function allCpf(): Chain;

    public function allCreditCard(string $brand = 'Any'): Chain;

    /** @param "alpha-3"|"numeric" $set */
    public function allCurrencyCode(string $set = 'alpha-3'): Chain;

    public function allDate(string $format = 'Y-m-d'): Chain;

    public function allDateTime(string|null $format = null): Chain;

    /** @param "years"|"months"|"days"|"hours"|"minutes"|"seconds"|"microseconds" $type */
    public function allDateTimeDiff(string $type, Validator $validator, string|null $format = null, DateTimeImmutable|null $now = null): Chain;

    public function allDecimal(int $decimals): Chain;

    public function allDigit(string ...$additionalChars): Chain;

    public function allDirectory(): Chain;

    public function allDomain(bool $tldCheck = true): Chain;

    public function allEach(Validator $validator): Chain;

    public function allEmail(): Chain;

    public function allEmoji(): Chain;

    public function allEndsWith(mixed $endValue): Chain;

    public function allEquals(mixed $compareTo): Chain;

    public function allEquivalent(mixed $compareTo): Chain;

    public function allEven(): Chain;

    public function allExecutable(): Chain;

    public function allExtension(string $extension): Chain;

    public function allFactor(int $dividend): Chain;

    /** @param callable(mixed): Validator $factory */
    public function allFactory(callable $factory): Chain;

    public function allFalseVal(): Chain;

    public function allFalsy(): Chain;

    public function allFile(): Chain;

    public function allFinite(): Chain;

    public function allFloatType(): Chain;

    public function allFloatVal(): Chain;

    public function allGraph(string ...$additionalChars): Chain;

    public function allGreaterThan(mixed $compareTo): Chain;

    public function allGreaterThanOrEqual(mixed $compareTo): Chain;

    public function allHetu(): Chain;

    public function allHexRgbColor(): Chain;

    public function allIban(): Chain;

    public function allIdentical(mixed $compareTo): Chain;

    public function allImage(): Chain;

    public function allImei(): Chain;

    public function allIn(mixed $haystack): Chain;

    public function allInfinite(): Chain;

    /** @param class-string $class */
    public function allInstance(string $class): Chain;

    public function allIntType(): Chain;

    public function allIntVal(): Chain;

    public function allIp(string $range = '*', int|null $options = null): Chain;

    public function allIsbn(): Chain;

    public function allIterableType(): Chain;

    public function allIterableVal(): Chain;

    public function allJson(): Chain;

    /** @param "alpha-2"|"alpha-3" $set */
    public function allLanguageCode(string $set = 'alpha-2'): Chain;

    public function allLeapDate(string $format): Chain;

    public function allLeapYear(): Chain;

    public function allLength(Validator $validator): Chain;

    public function allLessThan(mixed $compareTo): Chain;

    public function allLessThanOrEqual(mixed $compareTo): Chain;

    public function allLowercase(): Chain;

    public function allLuhn(): Chain;

    public function allMacAddress(): Chain;

    public function allMasked(string $range, Validator $validator, string $replacement = '*'): Chain;

    public function allMax(Validator $validator): Chain;

    public function allMimetype(string $mimetype): Chain;

    public function allMin(Validator $validator): Chain;

    public function allMultiple(int $multipleOf): Chain;

    public function allNegative(): Chain;

    public function allNfeAccessKey(): Chain;

    public function allNif(): Chain;

    public function allNip(): Chain;

    public function allNoneOf(Validator $validator1, Validator $validator2, Validator ...$validators): Chain;

    public function allNot(Validator $validator): Chain;

    public function allNullType(): Chain;

    public function allNumber(): Chain;

    public function allNumericVal(): Chain;

    public function allObjectType(): Chain;

    public function allOdd(): Chain;

    public function allOneOf(Validator $validator1, Validator $validator2, Validator ...$validators): Chain;

    public function allPesel(): Chain;

    public function allPhone(string|null $countryCode = null): Chain;

    public function allPis(): Chain;

    public function allPolishIdCard(): Chain;

    public function allPortugueseNif(): Chain;

    public function allPositive(): Chain;

    public function allPostalCode(string $countryCode, bool $formatted = false): Chain;

    public function allPrintable(string ...$additionalChars): Chain;

    public function allPublicDomainSuffix(): Chain;

    public function allPunct(string ...$additionalChars): Chain;

    public function allReadable(): Chain;

    public function allRegex(string $regex): Chain;

    public function allResourceType(): Chain;

    public function allRoman(): Chain;

    public function allSatisfies(callable $callback, mixed ...$arguments): Chain;

    public function allScalarVal(): Chain;

    /** @param "B"|"KB"|"MB"|"GB"|"TB"|"PB"|"EB"|"ZB"|"YB" $unit */
    public function allSize(string $unit, Validator $validator): Chain;

    public function allSlug(): Chain;

    public function allSorted(string $direction): Chain;

    public function allSpace(string ...$additionalChars): Chain;

    public function allSpaced(): Chain;

    public function allStartsWith(mixed $startValue): Chain;

    public function allStringType(): Chain;

    public function allStringVal(): Chain;

    public function allSubdivisionCode(string $countryCode): Chain;

    /** @param mixed[] $superset */
    public function allSubset(array $superset): Chain;

    public function allSymbolicLink(): Chain;

    public function allTime(string $format = 'H:i:s'): Chain;

    public function allTld(): Chain;

    public function allTrueVal(): Chain;

    public function allUndef(): Chain;

    public function allUnique(): Chain;

    public function allUppercase(): Chain;

    public function allUrl(): Chain;

    public function allUuid(int|null $version = null): Chain;

    public function allVersion(): Chain;

    public function allVowel(string ...$additionalChars): Chain;

    public function allWhen(Validator $when, Validator $then, Validator|null $else = null): Chain;

    public function allWritable(): Chain;

    public function allXdigit(string ...$additionalChars): Chain;
}
