<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Mixins;

use DateTimeImmutable;
use Respect\Validation\Rule;

interface AllChain
{
    public function allAllOf(Rule $rule1, Rule $rule2, Rule ...$rules): Chain;

    public function allAlnum(string ...$additionalChars): Chain;

    public function allAlpha(string ...$additionalChars): Chain;

    public function allAlwaysInvalid(): Chain;

    public function allAlwaysValid(): Chain;

    public function allAnyOf(Rule $rule1, Rule $rule2, Rule ...$rules): Chain;

    public function allArrayType(): Chain;

    public function allArrayVal(): Chain;

    public function allBase(
        int $base,
        string $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
    ): Chain;

    public function allBase64(): Chain;

    public function allBetween(mixed $minValue, mixed $maxValue): Chain;

    public function allBetweenExclusive(mixed $minimum, mixed $maximum): Chain;

    public function allBlank(): Chain;

    public function allBoolType(): Chain;

    public function allBoolVal(): Chain;

    public function allBsn(): Chain;

    public function allCall(callable $callable, Rule $rule): Chain;

    public function allCallableType(): Chain;

    public function allCallback(callable $callback, mixed ...$arguments): Chain;

    public function allCharset(string $charset, string ...$charsets): Chain;

    public function allCircuit(Rule $rule1, Rule $rule2, Rule ...$rules): Chain;

    public function allCnh(): Chain;

    public function allCnpj(): Chain;

    public function allConsonant(string ...$additionalChars): Chain;

    public function allContains(mixed $containsValue, bool $identical = false): Chain;

    /** @param non-empty-array<mixed> $needles */
    public function allContainsAny(array $needles, bool $identical = false): Chain;

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
    public function allDateTimeDiff(
        string $type,
        Rule $rule,
        string|null $format = null,
        DateTimeImmutable|null $now = null,
    ): Chain;

    public function allDecimal(int $decimals): Chain;

    public function allDigit(string ...$additionalChars): Chain;

    public function allDirectory(): Chain;

    public function allDomain(bool $tldCheck = true): Chain;

    public function allEach(Rule $rule): Chain;

    public function allEmail(): Chain;

    public function allEmoji(): Chain;

    public function allEndsWith(mixed $endValue, bool $identical = false): Chain;

    public function allEquals(mixed $compareTo): Chain;

    public function allEquivalent(mixed $compareTo): Chain;

    public function allEven(): Chain;

    public function allExecutable(): Chain;

    public function allExtension(string $extension): Chain;

    public function allFactor(int $dividend): Chain;

    public function allFalseVal(): Chain;

    public function allFalsy(): Chain;

    public function allFibonacci(): Chain;

    public function allFile(): Chain;

    public function allFilterVar(int $filter, mixed $options = null): Chain;

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

    public function allIn(mixed $haystack, bool $compareIdentical = false): Chain;

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

    /** @param callable(mixed): Rule $ruleCreator */
    public function allLazy(callable $ruleCreator): Chain;

    public function allLeapDate(string $format): Chain;

    public function allLeapYear(): Chain;

    public function allLength(Rule $rule): Chain;

    public function allLessThan(mixed $compareTo): Chain;

    public function allLessThanOrEqual(mixed $compareTo): Chain;

    public function allLowercase(): Chain;

    public function allLuhn(): Chain;

    public function allMacAddress(): Chain;

    public function allMax(Rule $rule): Chain;

    public function allMimetype(string $mimetype): Chain;

    public function allMin(Rule $rule): Chain;

    public function allMultiple(int $multipleOf): Chain;

    public function allNegative(): Chain;

    public function allNfeAccessKey(): Chain;

    public function allNif(): Chain;

    public function allNip(): Chain;

    public function allNo(bool $useLocale = false): Chain;

    public function allNoneOf(Rule $rule1, Rule $rule2, Rule ...$rules): Chain;

    public function allNot(Rule $rule): Chain;

    public function allNullType(): Chain;

    public function allNumber(): Chain;

    public function allNumericVal(): Chain;

    public function allObjectType(): Chain;

    public function allOdd(): Chain;

    public function allOneOf(Rule $rule1, Rule $rule2, Rule ...$rules): Chain;

    public function allPerfectSquare(): Chain;

    public function allPesel(): Chain;

    public function allPhone(string|null $countryCode = null): Chain;

    public function allPhpLabel(): Chain;

    public function allPis(): Chain;

    public function allPolishIdCard(): Chain;

    public function allPortugueseNif(): Chain;

    public function allPositive(): Chain;

    public function allPostalCode(string $countryCode, bool $formatted = false): Chain;

    public function allPrimeNumber(): Chain;

    public function allPrintable(string ...$additionalChars): Chain;

    public function allPublicDomainSuffix(): Chain;

    public function allPunct(string ...$additionalChars): Chain;

    public function allReadable(): Chain;

    public function allRegex(string $regex): Chain;

    public function allResourceType(): Chain;

    public function allRoman(): Chain;

    public function allScalarVal(): Chain;

    /** @param "B"|"KB"|"MB"|"GB"|"TB"|"PB"|"EB"|"ZB"|"YB" $unit */
    public function allSize(string $unit, Rule $rule): Chain;

    public function allSlug(): Chain;

    public function allSorted(string $direction): Chain;

    public function allSpace(string ...$additionalChars): Chain;

    public function allSpaced(): Chain;

    public function allStartsWith(mixed $startValue, bool $identical = false): Chain;

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

    public function allUploaded(): Chain;

    public function allUppercase(): Chain;

    public function allUrl(): Chain;

    public function allUuid(int|null $version = null): Chain;

    public function allVersion(): Chain;

    public function allVideoUrl(string|null $service = null): Chain;

    public function allVowel(string ...$additionalChars): Chain;

    public function allWhen(Rule $when, Rule $then, Rule|null $else = null): Chain;

    public function allWritable(): Chain;

    public function allXdigit(string ...$additionalChars): Chain;

    public function allYes(bool $useLocale = false): Chain;
}
