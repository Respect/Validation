<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Mixins;

use DateTimeImmutable;
use Respect\Validation\Validatable;

interface StaticKey
{
    public static function keyAllOf(
        int|string $key,
        Validatable $rule1,
        Validatable $rule2,
        Validatable ...$rules,
    ): ChainedValidator;

    public static function keyAlnum(int|string $key, string ...$additionalChars): ChainedValidator;

    public static function keyAlpha(int|string $key, string ...$additionalChars): ChainedValidator;

    public static function keyAlwaysInvalid(int|string $key): ChainedValidator;

    public static function keyAlwaysValid(int|string $key): ChainedValidator;

    public static function keyAnyOf(
        int|string $key,
        Validatable $rule1,
        Validatable $rule2,
        Validatable ...$rules,
    ): ChainedValidator;

    public static function keyArrayType(int|string $key): ChainedValidator;

    public static function keyArrayVal(int|string $key): ChainedValidator;

    public static function keyBase(
        int|string $key,
        int $base,
        string $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
    ): ChainedValidator;

    public static function keyBase64(int|string $key): ChainedValidator;

    public static function keyBetween(int|string $key, mixed $minValue, mixed $maxValue): ChainedValidator;

    public static function keyBetweenExclusive(int|string $key, mixed $minimum, mixed $maximum): ChainedValidator;

    public static function keyBoolType(int|string $key): ChainedValidator;

    public static function keyBoolVal(int|string $key): ChainedValidator;

    public static function keyBsn(int|string $key): ChainedValidator;

    public static function keyCall(int|string $key, callable $callable, Validatable $rule): ChainedValidator;

    public static function keyCallableType(int|string $key): ChainedValidator;

    public static function keyCallback(int|string $key, callable $callback, mixed ...$arguments): ChainedValidator;

    public static function keyCharset(int|string $key, string $charset, string ...$charsets): ChainedValidator;

    public static function keyCnh(int|string $key): ChainedValidator;

    public static function keyCnpj(int|string $key): ChainedValidator;

    public static function keyConsecutive(
        int|string $key,
        Validatable $rule1,
        Validatable $rule2,
        Validatable ...$rules,
    ): ChainedValidator;

    public static function keyConsonant(int|string $key, string ...$additionalChars): ChainedValidator;

    public static function keyContains(
        int|string $key,
        mixed $containsValue,
        bool $identical = false,
    ): ChainedValidator;

    /**
     * @param non-empty-array<mixed> $needles
     */
    public static function keyContainsAny(int|string $key, array $needles, bool $identical = false): ChainedValidator;

    public static function keyControl(int|string $key, string ...$additionalChars): ChainedValidator;

    public static function keyCountable(int|string $key): ChainedValidator;

    /**
     * @param "alpha-2"|"alpha-3"|"numeric" $set
     */
    public static function keyCountryCode(int|string $key, string $set = 'alpha-2'): ChainedValidator;

    public static function keyCpf(int|string $key): ChainedValidator;

    public static function keyCreditCard(int|string $key, string $brand = 'Any'): ChainedValidator;

    /**
     * @param "alpha-3"|"numeric" $set
     */
    public static function keyCurrencyCode(int|string $key, string $set = 'alpha-3'): ChainedValidator;

    public static function keyDate(int|string $key, string $format = 'Y-m-d'): ChainedValidator;

    public static function keyDateTime(int|string $key, ?string $format = null): ChainedValidator;

    /**
     * @param "years"|"months"|"days"|"hours"|"minutes"|"seconds"|"microseconds" $type
     */
    public static function keyDateTimeDiff(
        int|string $key,
        string $type,
        Validatable $rule,
        ?string $format = null,
        ?DateTimeImmutable $now = null,
    ): ChainedValidator;

    public static function keyDecimal(int|string $key, int $decimals): ChainedValidator;

    public static function keyDigit(int|string $key, string ...$additionalChars): ChainedValidator;

    public static function keyDirectory(int|string $key): ChainedValidator;

    public static function keyDomain(int|string $key, bool $tldCheck = true): ChainedValidator;

    public static function keyEach(int|string $key, Validatable $rule): ChainedValidator;

    public static function keyEmail(int|string $key): ChainedValidator;

    public static function keyEndsWith(int|string $key, mixed $endValue, bool $identical = false): ChainedValidator;

    public static function keyEquals(int|string $key, mixed $compareTo): ChainedValidator;

    public static function keyEquivalent(int|string $key, mixed $compareTo): ChainedValidator;

    public static function keyEven(int|string $key): ChainedValidator;

    public static function keyExecutable(int|string $key): ChainedValidator;

    public static function keyExtension(int|string $key, string $extension): ChainedValidator;

    public static function keyFactor(int|string $key, int $dividend): ChainedValidator;

    public static function keyFalseVal(int|string $key): ChainedValidator;

    public static function keyFibonacci(int|string $key): ChainedValidator;

    public static function keyFile(int|string $key): ChainedValidator;

    public static function keyFilterVar(int|string $key, int $filter, mixed $options = null): ChainedValidator;

    public static function keyFinite(int|string $key): ChainedValidator;

    public static function keyFloatType(int|string $key): ChainedValidator;

    public static function keyFloatVal(int|string $key): ChainedValidator;

    public static function keyGraph(int|string $key, string ...$additionalChars): ChainedValidator;

    public static function keyGreaterThan(int|string $key, mixed $compareTo): ChainedValidator;

    public static function keyGreaterThanOrEqual(int|string $key, mixed $compareTo): ChainedValidator;

    public static function keyHetu(int|string $key): ChainedValidator;

    public static function keyHexRgbColor(int|string $key): ChainedValidator;

    public static function keyIban(int|string $key): ChainedValidator;

    public static function keyIdentical(int|string $key, mixed $compareTo): ChainedValidator;

    public static function keyImage(int|string $key): ChainedValidator;

    public static function keyImei(int|string $key): ChainedValidator;

    public static function keyIn(int|string $key, mixed $haystack, bool $compareIdentical = false): ChainedValidator;

    public static function keyInfinite(int|string $key): ChainedValidator;

    /**
     * @param class-string $class
     */
    public static function keyInstance(int|string $key, string $class): ChainedValidator;

    public static function keyIntType(int|string $key): ChainedValidator;

    public static function keyIntVal(int|string $key): ChainedValidator;

    public static function keyIp(int|string $key, string $range = '*', ?int $options = null): ChainedValidator;

    public static function keyIsbn(int|string $key): ChainedValidator;

    public static function keyIterableType(int|string $key): ChainedValidator;

    public static function keyIterableVal(int|string $key): ChainedValidator;

    public static function keyJson(int|string $key): ChainedValidator;

    /**
     * @param "alpha-2"|"alpha-3" $set
     */
    public static function keyLanguageCode(int|string $key, string $set = 'alpha-2'): ChainedValidator;

    /**
     * @param callable(mixed): Validatable $ruleCreator
     */
    public static function keyLazy(int|string $key, callable $ruleCreator): ChainedValidator;

    public static function keyLeapDate(int|string $key, string $format): ChainedValidator;

    public static function keyLeapYear(int|string $key): ChainedValidator;

    public static function keyLength(int|string $key, Validatable $rule): ChainedValidator;

    public static function keyLessThan(int|string $key, mixed $compareTo): ChainedValidator;

    public static function keyLessThanOrEqual(int|string $key, mixed $compareTo): ChainedValidator;

    public static function keyLowercase(int|string $key): ChainedValidator;

    public static function keyLuhn(int|string $key): ChainedValidator;

    public static function keyMacAddress(int|string $key): ChainedValidator;

    public static function keyMax(int|string $key, Validatable $rule): ChainedValidator;

    public static function keyMimetype(int|string $key, string $mimetype): ChainedValidator;

    public static function keyMin(int|string $key, Validatable $rule): ChainedValidator;

    public static function keyMultiple(int|string $key, int $multipleOf): ChainedValidator;

    public static function keyNegative(int|string $key): ChainedValidator;

    public static function keyNfeAccessKey(int|string $key): ChainedValidator;

    public static function keyNif(int|string $key): ChainedValidator;

    public static function keyNip(int|string $key): ChainedValidator;

    public static function keyNo(int|string $key, bool $useLocale = false): ChainedValidator;

    public static function keyNoWhitespace(int|string $key): ChainedValidator;

    public static function keyNoneOf(
        int|string $key,
        Validatable $rule1,
        Validatable $rule2,
        Validatable ...$rules,
    ): ChainedValidator;

    public static function keyNot(int|string $key, Validatable $rule): ChainedValidator;

    public static function keyNotBlank(int|string $key): ChainedValidator;

    public static function keyNotEmoji(int|string $key): ChainedValidator;

    public static function keyNotEmpty(int|string $key): ChainedValidator;

    public static function keyNotOptional(int|string $key): ChainedValidator;

    public static function keyNotUndef(int|string $key): ChainedValidator;

    public static function keyNullType(int|string $key): ChainedValidator;

    public static function keyNumber(int|string $key): ChainedValidator;

    public static function keyNumericVal(int|string $key): ChainedValidator;

    public static function keyObjectType(int|string $key): ChainedValidator;

    public static function keyOdd(int|string $key): ChainedValidator;

    public static function keyOneOf(
        int|string $key,
        Validatable $rule1,
        Validatable $rule2,
        Validatable ...$rules,
    ): ChainedValidator;

    public static function keyPerfectSquare(int|string $key): ChainedValidator;

    public static function keyPesel(int|string $key): ChainedValidator;

    public static function keyPhone(int|string $key, ?string $countryCode = null): ChainedValidator;

    public static function keyPhpLabel(int|string $key): ChainedValidator;

    public static function keyPis(int|string $key): ChainedValidator;

    public static function keyPolishIdCard(int|string $key): ChainedValidator;

    public static function keyPortugueseNif(int|string $key): ChainedValidator;

    public static function keyPositive(int|string $key): ChainedValidator;

    public static function keyPostalCode(
        int|string $key,
        string $countryCode,
        bool $formatted = false,
    ): ChainedValidator;

    public static function keyPrimeNumber(int|string $key): ChainedValidator;

    public static function keyPrintable(int|string $key, string ...$additionalChars): ChainedValidator;

    public static function keyPublicDomainSuffix(int|string $key): ChainedValidator;

    public static function keyPunct(int|string $key, string ...$additionalChars): ChainedValidator;

    public static function keyReadable(int|string $key): ChainedValidator;

    public static function keyRegex(int|string $key, string $regex): ChainedValidator;

    public static function keyResourceType(int|string $key): ChainedValidator;

    public static function keyRoman(int|string $key): ChainedValidator;

    public static function keyScalarVal(int|string $key): ChainedValidator;

    public static function keySize(
        int|string $key,
        string|int|null $minSize = null,
        string|int|null $maxSize = null,
    ): ChainedValidator;

    public static function keySlug(int|string $key): ChainedValidator;

    public static function keySorted(int|string $key, string $direction): ChainedValidator;

    public static function keySpace(int|string $key, string ...$additionalChars): ChainedValidator;

    public static function keyStartsWith(
        int|string $key,
        mixed $startValue,
        bool $identical = false,
    ): ChainedValidator;

    public static function keyStringType(int|string $key): ChainedValidator;

    public static function keyStringVal(int|string $key): ChainedValidator;

    public static function keySubdivisionCode(int|string $key, string $countryCode): ChainedValidator;

    /**
     * @param mixed[] $superset
     */
    public static function keySubset(int|string $key, array $superset): ChainedValidator;

    public static function keySymbolicLink(int|string $key): ChainedValidator;

    public static function keyTime(int|string $key, string $format = 'H:i:s'): ChainedValidator;

    public static function keyTld(int|string $key): ChainedValidator;

    public static function keyTrueVal(int|string $key): ChainedValidator;

    public static function keyUnique(int|string $key): ChainedValidator;

    public static function keyUploaded(int|string $key): ChainedValidator;

    public static function keyUppercase(int|string $key): ChainedValidator;

    public static function keyUrl(int|string $key): ChainedValidator;

    public static function keyUuid(int|string $key, ?int $version = null): ChainedValidator;

    public static function keyVersion(int|string $key): ChainedValidator;

    public static function keyVideoUrl(int|string $key, ?string $service = null): ChainedValidator;

    public static function keyVowel(int|string $key, string ...$additionalChars): ChainedValidator;

    public static function keyWhen(
        int|string $key,
        Validatable $when,
        Validatable $then,
        ?Validatable $else = null,
    ): ChainedValidator;

    public static function keyWritable(int|string $key): ChainedValidator;

    public static function keyXdigit(int|string $key, string ...$additionalChars): ChainedValidator;

    public static function keyYes(int|string $key, bool $useLocale = false): ChainedValidator;
}
