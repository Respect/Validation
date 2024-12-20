<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Mixins;

use DateTimeImmutable;
use Respect\Validation\Rule;

interface KeyBuilder
{
    public static function keyAllOf(int|string $key, Rule $rule1, Rule $rule2, Rule ...$rules): Chain;

    public static function keyAlnum(int|string $key, string ...$additionalChars): Chain;

    public static function keyAlpha(int|string $key, string ...$additionalChars): Chain;

    public static function keyAlwaysInvalid(int|string $key): Chain;

    public static function keyAlwaysValid(int|string $key): Chain;

    public static function keyAnyOf(int|string $key, Rule $rule1, Rule $rule2, Rule ...$rules): Chain;

    public static function keyArrayType(int|string $key): Chain;

    public static function keyArrayVal(int|string $key): Chain;

    public static function keyBase(
        int|string $key,
        int $base,
        string $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
    ): Chain;

    public static function keyBase64(int|string $key): Chain;

    public static function keyBetween(int|string $key, mixed $minValue, mixed $maxValue): Chain;

    public static function keyBetweenExclusive(int|string $key, mixed $minimum, mixed $maximum): Chain;

    public static function keyBoolType(int|string $key): Chain;

    public static function keyBoolVal(int|string $key): Chain;

    public static function keyBsn(int|string $key): Chain;

    public static function keyCall(int|string $key, callable $callable, Rule $rule): Chain;

    public static function keyCallableType(int|string $key): Chain;

    public static function keyCallback(int|string $key, callable $callback, mixed ...$arguments): Chain;

    public static function keyCharset(int|string $key, string $charset, string ...$charsets): Chain;

    public static function keyCircuit(int|string $key, Rule $rule1, Rule $rule2, Rule ...$rules): Chain;

    public static function keyCnh(int|string $key): Chain;

    public static function keyCnpj(int|string $key): Chain;

    public static function keyConsonant(int|string $key, string ...$additionalChars): Chain;

    public static function keyContains(int|string $key, mixed $containsValue, bool $identical = false): Chain;

    /**
     * @param non-empty-array<mixed> $needles
     */
    public static function keyContainsAny(int|string $key, array $needles, bool $identical = false): Chain;

    public static function keyControl(int|string $key, string ...$additionalChars): Chain;

    public static function keyCountable(int|string $key): Chain;

    /**
     * @param "alpha-2"|"alpha-3"|"numeric" $set
     */
    public static function keyCountryCode(int|string $key, string $set = 'alpha-2'): Chain;

    public static function keyCpf(int|string $key): Chain;

    public static function keyCreditCard(int|string $key, string $brand = 'Any'): Chain;

    /**
     * @param "alpha-3"|"numeric" $set
     */
    public static function keyCurrencyCode(int|string $key, string $set = 'alpha-3'): Chain;

    public static function keyDate(int|string $key, string $format = 'Y-m-d'): Chain;

    public static function keyDateTime(int|string $key, ?string $format = null): Chain;

    /**
     * @param "years"|"months"|"days"|"hours"|"minutes"|"seconds"|"microseconds" $type
     */
    public static function keyDateTimeDiff(
        int|string $key,
        string $type,
        Rule $rule,
        ?string $format = null,
        ?DateTimeImmutable $now = null,
    ): Chain;

    public static function keyDecimal(int|string $key, int $decimals): Chain;

    public static function keyDigit(int|string $key, string ...$additionalChars): Chain;

    public static function keyDirectory(int|string $key): Chain;

    public static function keyDomain(int|string $key, bool $tldCheck = true): Chain;

    public static function keyEach(int|string $key, Rule $rule): Chain;

    public static function keyEmail(int|string $key): Chain;

    public static function keyEndsWith(int|string $key, mixed $endValue, bool $identical = false): Chain;

    public static function keyEquals(int|string $key, mixed $compareTo): Chain;

    public static function keyEquivalent(int|string $key, mixed $compareTo): Chain;

    public static function keyEven(int|string $key): Chain;

    public static function keyExecutable(int|string $key): Chain;

    public static function keyExtension(int|string $key, string $extension): Chain;

    public static function keyFactor(int|string $key, int $dividend): Chain;

    public static function keyFalseVal(int|string $key): Chain;

    public static function keyFibonacci(int|string $key): Chain;

    public static function keyFile(int|string $key): Chain;

    public static function keyFilterVar(int|string $key, int $filter, mixed $options = null): Chain;

    public static function keyFinite(int|string $key): Chain;

    public static function keyFloatType(int|string $key): Chain;

    public static function keyFloatVal(int|string $key): Chain;

    public static function keyGraph(int|string $key, string ...$additionalChars): Chain;

    public static function keyGreaterThan(int|string $key, mixed $compareTo): Chain;

    public static function keyGreaterThanOrEqual(int|string $key, mixed $compareTo): Chain;

    public static function keyHetu(int|string $key): Chain;

    public static function keyHexRgbColor(int|string $key): Chain;

    public static function keyIban(int|string $key): Chain;

    public static function keyIdentical(int|string $key, mixed $compareTo): Chain;

    public static function keyImage(int|string $key): Chain;

    public static function keyImei(int|string $key): Chain;

    public static function keyIn(int|string $key, mixed $haystack, bool $compareIdentical = false): Chain;

    public static function keyInfinite(int|string $key): Chain;

    /**
     * @param class-string $class
     */
    public static function keyInstance(int|string $key, string $class): Chain;

    public static function keyIntType(int|string $key): Chain;

    public static function keyIntVal(int|string $key): Chain;

    public static function keyIp(int|string $key, string $range = '*', ?int $options = null): Chain;

    public static function keyIsbn(int|string $key): Chain;

    public static function keyIterableType(int|string $key): Chain;

    public static function keyIterableVal(int|string $key): Chain;

    public static function keyJson(int|string $key): Chain;

    /**
     * @param "alpha-2"|"alpha-3" $set
     */
    public static function keyLanguageCode(int|string $key, string $set = 'alpha-2'): Chain;

    /**
     * @param callable(mixed): Rule $ruleCreator
     */
    public static function keyLazy(int|string $key, callable $ruleCreator): Chain;

    public static function keyLeapDate(int|string $key, string $format): Chain;

    public static function keyLeapYear(int|string $key): Chain;

    public static function keyLength(int|string $key, Rule $rule): Chain;

    public static function keyLessThan(int|string $key, mixed $compareTo): Chain;

    public static function keyLessThanOrEqual(int|string $key, mixed $compareTo): Chain;

    public static function keyLowercase(int|string $key): Chain;

    public static function keyLuhn(int|string $key): Chain;

    public static function keyMacAddress(int|string $key): Chain;

    public static function keyMax(int|string $key, Rule $rule): Chain;

    public static function keyMimetype(int|string $key, string $mimetype): Chain;

    public static function keyMin(int|string $key, Rule $rule): Chain;

    public static function keyMultiple(int|string $key, int $multipleOf): Chain;

    public static function keyNegative(int|string $key): Chain;

    public static function keyNfeAccessKey(int|string $key): Chain;

    public static function keyNif(int|string $key): Chain;

    public static function keyNip(int|string $key): Chain;

    public static function keyNo(int|string $key, bool $useLocale = false): Chain;

    public static function keyNoWhitespace(int|string $key): Chain;

    public static function keyNoneOf(int|string $key, Rule $rule1, Rule $rule2, Rule ...$rules): Chain;

    public static function keyNot(int|string $key, Rule $rule): Chain;

    public static function keyNotBlank(int|string $key): Chain;

    public static function keyNotEmoji(int|string $key): Chain;

    public static function keyNotEmpty(int|string $key): Chain;

    public static function keyNotOptional(int|string $key): Chain;

    public static function keyNotUndef(int|string $key): Chain;

    public static function keyNullType(int|string $key): Chain;

    public static function keyNumber(int|string $key): Chain;

    public static function keyNumericVal(int|string $key): Chain;

    public static function keyObjectType(int|string $key): Chain;

    public static function keyOdd(int|string $key): Chain;

    public static function keyOneOf(int|string $key, Rule $rule1, Rule $rule2, Rule ...$rules): Chain;

    public static function keyPerfectSquare(int|string $key): Chain;

    public static function keyPesel(int|string $key): Chain;

    public static function keyPhone(int|string $key, ?string $countryCode = null): Chain;

    public static function keyPhpLabel(int|string $key): Chain;

    public static function keyPis(int|string $key): Chain;

    public static function keyPolishIdCard(int|string $key): Chain;

    public static function keyPortugueseNif(int|string $key): Chain;

    public static function keyPositive(int|string $key): Chain;

    public static function keyPostalCode(int|string $key, string $countryCode, bool $formatted = false): Chain;

    public static function keyPrimeNumber(int|string $key): Chain;

    public static function keyPrintable(int|string $key, string ...$additionalChars): Chain;

    public static function keyPublicDomainSuffix(int|string $key): Chain;

    public static function keyPunct(int|string $key, string ...$additionalChars): Chain;

    public static function keyReadable(int|string $key): Chain;

    public static function keyRegex(int|string $key, string $regex): Chain;

    public static function keyResourceType(int|string $key): Chain;

    public static function keyRoman(int|string $key): Chain;

    public static function keyScalarVal(int|string $key): Chain;

    /**
     * @param "B"|"KB"|"MB"|"GB"|"TB"|"PB"|"EB"|"ZB"|"YB" $unit
     */
    public static function keySize(int|string $key, string $unit, Rule $rule): Chain;

    public static function keySlug(int|string $key): Chain;

    public static function keySorted(int|string $key, string $direction): Chain;

    public static function keySpace(int|string $key, string ...$additionalChars): Chain;

    public static function keyStartsWith(int|string $key, mixed $startValue, bool $identical = false): Chain;

    public static function keyStringType(int|string $key): Chain;

    public static function keyStringVal(int|string $key): Chain;

    public static function keySubdivisionCode(int|string $key, string $countryCode): Chain;

    /**
     * @param mixed[] $superset
     */
    public static function keySubset(int|string $key, array $superset): Chain;

    public static function keySymbolicLink(int|string $key): Chain;

    public static function keyTime(int|string $key, string $format = 'H:i:s'): Chain;

    public static function keyTld(int|string $key): Chain;

    public static function keyTrueVal(int|string $key): Chain;

    public static function keyUnique(int|string $key): Chain;

    public static function keyUploaded(int|string $key): Chain;

    public static function keyUppercase(int|string $key): Chain;

    public static function keyUrl(int|string $key): Chain;

    public static function keyUuid(int|string $key, ?int $version = null): Chain;

    public static function keyVersion(int|string $key): Chain;

    public static function keyVideoUrl(int|string $key, ?string $service = null): Chain;

    public static function keyVowel(int|string $key, string ...$additionalChars): Chain;

    public static function keyWhen(int|string $key, Rule $when, Rule $then, ?Rule $else = null): Chain;

    public static function keyWritable(int|string $key): Chain;

    public static function keyXdigit(int|string $key, string ...$additionalChars): Chain;

    public static function keyYes(int|string $key, bool $useLocale = false): Chain;
}
