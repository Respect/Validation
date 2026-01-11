<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Mixins;

use DateTimeImmutable;
use Respect\Validation\Validator;

interface PropertyChain
{
    public function propertyAll(string $propertyName, Validator $validator): Chain;

    public function propertyAlnum(string $propertyName, string ...$additionalChars): Chain;

    public function propertyAlpha(string $propertyName, string ...$additionalChars): Chain;

    public function propertyAlwaysInvalid(string $propertyName): Chain;

    public function propertyAlwaysValid(string $propertyName): Chain;

    public function propertyArrayType(string $propertyName): Chain;

    public function propertyArrayVal(string $propertyName): Chain;

    public function propertyBase(
        string $propertyName,
        int $base,
        string $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
    ): Chain;

    public function propertyBase64(string $propertyName): Chain;

    public function propertyBetween(string $propertyName, mixed $minValue, mixed $maxValue): Chain;

    public function propertyBetweenExclusive(string $propertyName, mixed $minimum, mixed $maximum): Chain;

    public function propertyBlank(string $propertyName): Chain;

    public function propertyBoolType(string $propertyName): Chain;

    public function propertyBoolVal(string $propertyName): Chain;

    public function propertyBsn(string $propertyName): Chain;

    public function propertyCall(string $propertyName, callable $callable, Validator $validator): Chain;

    public function propertyCallableType(string $propertyName): Chain;

    public function propertyCallback(string $propertyName, callable $callback, mixed ...$arguments): Chain;

    public function propertyCharset(string $propertyName, string $charset, string ...$charsets): Chain;

    public function propertyCircuit(
        string $propertyName,
        Validator $validator1,
        Validator $validator2,
        Validator ...$validators,
    ): Chain;

    public function propertyCnh(string $propertyName): Chain;

    public function propertyCnpj(string $propertyName): Chain;

    public function propertyConsonant(string $propertyName, string ...$additionalChars): Chain;

    public function propertyContains(string $propertyName, mixed $containsValue, bool $identical = false): Chain;

    /** @param non-empty-array<mixed> $needles */
    public function propertyContainsAny(string $propertyName, array $needles, bool $identical = false): Chain;

    public function propertyControl(string $propertyName, string ...$additionalChars): Chain;

    public function propertyCountable(string $propertyName): Chain;

    /** @param "alpha-2"|"alpha-3"|"numeric" $set */
    public function propertyCountryCode(string $propertyName, string $set = 'alpha-2'): Chain;

    public function propertyCpf(string $propertyName): Chain;

    public function propertyCreditCard(string $propertyName, string $brand = 'Any'): Chain;

    /** @param "alpha-3"|"numeric" $set */
    public function propertyCurrencyCode(string $propertyName, string $set = 'alpha-3'): Chain;

    public function propertyDate(string $propertyName, string $format = 'Y-m-d'): Chain;

    public function propertyDateTime(string $propertyName, string|null $format = null): Chain;

    /** @param "years"|"months"|"days"|"hours"|"minutes"|"seconds"|"microseconds" $type */
    public function propertyDateTimeDiff(
        string $propertyName,
        string $type,
        Validator $validator,
        string|null $format = null,
        DateTimeImmutable|null $now = null,
    ): Chain;

    public function propertyDecimal(string $propertyName, int $decimals): Chain;

    public function propertyDigit(string $propertyName, string ...$additionalChars): Chain;

    public function propertyDirectory(string $propertyName): Chain;

    public function propertyDomain(string $propertyName, bool $tldCheck = true): Chain;

    public function propertyEach(string $propertyName, Validator $validator): Chain;

    public function propertyEmail(string $propertyName): Chain;

    public function propertyEmoji(string $propertyName): Chain;

    public function propertyEndsWith(string $propertyName, mixed $endValue, bool $identical = false): Chain;

    public function propertyEquals(string $propertyName, mixed $compareTo): Chain;

    public function propertyEquivalent(string $propertyName, mixed $compareTo): Chain;

    public function propertyEven(string $propertyName): Chain;

    public function propertyExecutable(string $propertyName): Chain;

    public function propertyExtension(string $propertyName, string $extension): Chain;

    public function propertyFactor(string $propertyName, int $dividend): Chain;

    public function propertyFalseVal(string $propertyName): Chain;

    public function propertyFalsy(string $propertyName): Chain;

    public function propertyFibonacci(string $propertyName): Chain;

    public function propertyFile(string $propertyName): Chain;

    public function propertyFilterVar(string $propertyName, int $filter, mixed $options = null): Chain;

    public function propertyFinite(string $propertyName): Chain;

    public function propertyFloatType(string $propertyName): Chain;

    public function propertyFloatVal(string $propertyName): Chain;

    public function propertyGraph(string $propertyName, string ...$additionalChars): Chain;

    public function propertyGreaterThan(string $propertyName, mixed $compareTo): Chain;

    public function propertyGreaterThanOrEqual(string $propertyName, mixed $compareTo): Chain;

    public function propertyHetu(string $propertyName): Chain;

    public function propertyHexRgbColor(string $propertyName): Chain;

    public function propertyIban(string $propertyName): Chain;

    public function propertyIdentical(string $propertyName, mixed $compareTo): Chain;

    public function propertyImage(string $propertyName): Chain;

    public function propertyImei(string $propertyName): Chain;

    public function propertyIn(string $propertyName, mixed $haystack, bool $compareIdentical = false): Chain;

    public function propertyInfinite(string $propertyName): Chain;

    /** @param class-string $class */
    public function propertyInstance(string $propertyName, string $class): Chain;

    public function propertyIntType(string $propertyName): Chain;

    public function propertyIntVal(string $propertyName): Chain;

    public function propertyIp(string $propertyName, string $range = '*', int|null $options = null): Chain;

    public function propertyIsbn(string $propertyName): Chain;

    public function propertyIterableType(string $propertyName): Chain;

    public function propertyIterableVal(string $propertyName): Chain;

    public function propertyJson(string $propertyName): Chain;

    /** @param "alpha-2"|"alpha-3" $set */
    public function propertyLanguageCode(string $propertyName, string $set = 'alpha-2'): Chain;

    /** @param callable(mixed): Validator $validatorCreator */
    public function propertyLazy(string $propertyName, callable $validatorCreator): Chain;

    public function propertyLeapDate(string $propertyName, string $format): Chain;

    public function propertyLeapYear(string $propertyName): Chain;

    public function propertyLength(string $propertyName, Validator $validator): Chain;

    public function propertyLessThan(string $propertyName, mixed $compareTo): Chain;

    public function propertyLessThanOrEqual(string $propertyName, mixed $compareTo): Chain;

    public function propertyLogicAnd(
        string $propertyName,
        Validator $validator1,
        Validator $validator2,
        Validator ...$validators,
    ): Chain;

    public function propertyLogicCond(
        string $propertyName,
        Validator $logicCond,
        Validator $then,
        Validator|null $else = null,
    ): Chain;

    public function propertyLogicNor(
        string $propertyName,
        Validator $validator1,
        Validator $validator2,
        Validator ...$validators,
    ): Chain;

    public function propertyLogicOr(
        string $propertyName,
        Validator $validator1,
        Validator $validator2,
        Validator ...$validators,
    ): Chain;

    public function propertyLogicXor(
        string $propertyName,
        Validator $validator1,
        Validator $validator2,
        Validator ...$validators,
    ): Chain;

    public function propertyLowercase(string $propertyName): Chain;

    public function propertyLuhn(string $propertyName): Chain;

    public function propertyMacAddress(string $propertyName): Chain;

    public function propertyMax(string $propertyName, Validator $validator): Chain;

    public function propertyMimetype(string $propertyName, string $mimetype): Chain;

    public function propertyMin(string $propertyName, Validator $validator): Chain;

    public function propertyMultiple(string $propertyName, int $multipleOf): Chain;

    public function propertyNegative(string $propertyName): Chain;

    public function propertyNfeAccessKey(string $propertyName): Chain;

    public function propertyNif(string $propertyName): Chain;

    public function propertyNip(string $propertyName): Chain;

    public function propertyNot(string $propertyName, Validator $validator): Chain;

    public function propertyNullType(string $propertyName): Chain;

    public function propertyNumber(string $propertyName): Chain;

    public function propertyNumericVal(string $propertyName): Chain;

    public function propertyObjectType(string $propertyName): Chain;

    public function propertyOdd(string $propertyName): Chain;

    public function propertyPerfectSquare(string $propertyName): Chain;

    public function propertyPesel(string $propertyName): Chain;

    public function propertyPhone(string $propertyName, string|null $countryCode = null): Chain;

    public function propertyPhpLabel(string $propertyName): Chain;

    public function propertyPis(string $propertyName): Chain;

    public function propertyPolishIdCard(string $propertyName): Chain;

    public function propertyPortugueseNif(string $propertyName): Chain;

    public function propertyPositive(string $propertyName): Chain;

    public function propertyPostalCode(string $propertyName, string $countryCode, bool $formatted = false): Chain;

    public function propertyPrimeNumber(string $propertyName): Chain;

    public function propertyPrintable(string $propertyName, string ...$additionalChars): Chain;

    public function propertyPublicDomainSuffix(string $propertyName): Chain;

    public function propertyPunct(string $propertyName, string ...$additionalChars): Chain;

    public function propertyReadable(string $propertyName): Chain;

    public function propertyRegex(string $propertyName, string $regex): Chain;

    public function propertyResourceType(string $propertyName): Chain;

    public function propertyRoman(string $propertyName): Chain;

    public function propertyScalarVal(string $propertyName): Chain;

    /** @param "B"|"KB"|"MB"|"GB"|"TB"|"PB"|"EB"|"ZB"|"YB" $unit */
    public function propertySize(string $propertyName, string $unit, Validator $validator): Chain;

    public function propertySlug(string $propertyName): Chain;

    public function propertySorted(string $propertyName, string $direction): Chain;

    public function propertySpace(string $propertyName, string ...$additionalChars): Chain;

    public function propertySpaced(string $propertyName): Chain;

    public function propertyStartsWith(string $propertyName, mixed $startValue, bool $identical = false): Chain;

    public function propertyStringType(string $propertyName): Chain;

    public function propertyStringVal(string $propertyName): Chain;

    public function propertySubdivisionCode(string $propertyName, string $countryCode): Chain;

    /** @param mixed[] $superset */
    public function propertySubset(string $propertyName, array $superset): Chain;

    public function propertySymbolicLink(string $propertyName): Chain;

    public function propertyTime(string $propertyName, string $format = 'H:i:s'): Chain;

    public function propertyTld(string $propertyName): Chain;

    public function propertyTrueVal(string $propertyName): Chain;

    public function propertyUndef(string $propertyName): Chain;

    public function propertyUnique(string $propertyName): Chain;

    public function propertyUploaded(string $propertyName): Chain;

    public function propertyUppercase(string $propertyName): Chain;

    public function propertyUrl(string $propertyName): Chain;

    public function propertyUuid(string $propertyName, int|null $version = null): Chain;

    public function propertyVersion(string $propertyName): Chain;

    public function propertyVideoUrl(string $propertyName, string|null $service = null): Chain;

    public function propertyVowel(string $propertyName, string ...$additionalChars): Chain;

    public function propertyWritable(string $propertyName): Chain;

    public function propertyXdigit(string $propertyName, string ...$additionalChars): Chain;
}
