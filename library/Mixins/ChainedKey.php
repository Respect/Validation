<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Mixins;

use DateTimeImmutable;
use Respect\Validation\Rule;

interface ChainedKey
{
    public function keyAllOf(int|string $key, Rule $rule1, Rule $rule2, Rule ...$rules): ChainedValidator;

    public function keyAlnum(int|string $key, string ...$additionalChars): ChainedValidator;

    public function keyAlpha(int|string $key, string ...$additionalChars): ChainedValidator;

    public function keyAlwaysInvalid(int|string $key): ChainedValidator;

    public function keyAlwaysValid(int|string $key): ChainedValidator;

    public function keyAnyOf(int|string $key, Rule $rule1, Rule $rule2, Rule ...$rules): ChainedValidator;

    public function keyArrayType(int|string $key): ChainedValidator;

    public function keyArrayVal(int|string $key): ChainedValidator;

    public function keyBase(
        int|string $key,
        int $base,
        string $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
    ): ChainedValidator;

    public function keyBase64(int|string $key): ChainedValidator;

    public function keyBetween(int|string $key, mixed $minValue, mixed $maxValue): ChainedValidator;

    public function keyBetweenExclusive(int|string $key, mixed $minimum, mixed $maximum): ChainedValidator;

    public function keyBoolType(int|string $key): ChainedValidator;

    public function keyBoolVal(int|string $key): ChainedValidator;

    public function keyBsn(int|string $key): ChainedValidator;

    public function keyCall(int|string $key, callable $callable, Rule $rule): ChainedValidator;

    public function keyCallableType(int|string $key): ChainedValidator;

    public function keyCallback(int|string $key, callable $callback, mixed ...$arguments): ChainedValidator;

    public function keyCharset(int|string $key, string $charset, string ...$charsets): ChainedValidator;

    public function keyCnh(int|string $key): ChainedValidator;

    public function keyCnpj(int|string $key): ChainedValidator;

    public function keyConsecutive(int|string $key, Rule $rule1, Rule $rule2, Rule ...$rules): ChainedValidator;

    public function keyConsonant(int|string $key, string ...$additionalChars): ChainedValidator;

    public function keyContains(int|string $key, mixed $containsValue, bool $identical = false): ChainedValidator;

    /**
     * @param non-empty-array<mixed> $needles
     */
    public function keyContainsAny(int|string $key, array $needles, bool $identical = false): ChainedValidator;

    public function keyControl(int|string $key, string ...$additionalChars): ChainedValidator;

    public function keyCountable(int|string $key): ChainedValidator;

    /**
     * @param "alpha-2"|"alpha-3"|"numeric" $set
     */
    public function keyCountryCode(int|string $key, string $set = 'alpha-2'): ChainedValidator;

    public function keyCpf(int|string $key): ChainedValidator;

    public function keyCreditCard(int|string $key, string $brand = 'Any'): ChainedValidator;

    /**
     * @param "alpha-3"|"numeric" $set
     */
    public function keyCurrencyCode(int|string $key, string $set = 'alpha-3'): ChainedValidator;

    public function keyDate(int|string $key, string $format = 'Y-m-d'): ChainedValidator;

    public function keyDateTime(int|string $key, ?string $format = null): ChainedValidator;

    /**
     * @param "years"|"months"|"days"|"hours"|"minutes"|"seconds"|"microseconds" $type
     */
    public function keyDateTimeDiff(
        int|string $key,
        string $type,
        Rule $rule,
        ?string $format = null,
        ?DateTimeImmutable $now = null,
    ): ChainedValidator;

    public function keyDecimal(int|string $key, int $decimals): ChainedValidator;

    public function keyDigit(int|string $key, string ...$additionalChars): ChainedValidator;

    public function keyDirectory(int|string $key): ChainedValidator;

    public function keyDomain(int|string $key, bool $tldCheck = true): ChainedValidator;

    public function keyEach(int|string $key, Rule $rule): ChainedValidator;

    public function keyEmail(int|string $key): ChainedValidator;

    public function keyEndsWith(int|string $key, mixed $endValue, bool $identical = false): ChainedValidator;

    public function keyEquals(int|string $key, mixed $compareTo): ChainedValidator;

    public function keyEquivalent(int|string $key, mixed $compareTo): ChainedValidator;

    public function keyEven(int|string $key): ChainedValidator;

    public function keyExecutable(int|string $key): ChainedValidator;

    public function keyExtension(int|string $key, string $extension): ChainedValidator;

    public function keyFactor(int|string $key, int $dividend): ChainedValidator;

    public function keyFalseVal(int|string $key): ChainedValidator;

    public function keyFibonacci(int|string $key): ChainedValidator;

    public function keyFile(int|string $key): ChainedValidator;

    public function keyFilterVar(int|string $key, int $filter, mixed $options = null): ChainedValidator;

    public function keyFinite(int|string $key): ChainedValidator;

    public function keyFloatType(int|string $key): ChainedValidator;

    public function keyFloatVal(int|string $key): ChainedValidator;

    public function keyGraph(int|string $key, string ...$additionalChars): ChainedValidator;

    public function keyGreaterThan(int|string $key, mixed $compareTo): ChainedValidator;

    public function keyGreaterThanOrEqual(int|string $key, mixed $compareTo): ChainedValidator;

    public function keyHetu(int|string $key): ChainedValidator;

    public function keyHexRgbColor(int|string $key): ChainedValidator;

    public function keyIban(int|string $key): ChainedValidator;

    public function keyIdentical(int|string $key, mixed $compareTo): ChainedValidator;

    public function keyImage(int|string $key): ChainedValidator;

    public function keyImei(int|string $key): ChainedValidator;

    public function keyIn(int|string $key, mixed $haystack, bool $compareIdentical = false): ChainedValidator;

    public function keyInfinite(int|string $key): ChainedValidator;

    /**
     * @param class-string $class
     */
    public function keyInstance(int|string $key, string $class): ChainedValidator;

    public function keyIntType(int|string $key): ChainedValidator;

    public function keyIntVal(int|string $key): ChainedValidator;

    public function keyIp(int|string $key, string $range = '*', ?int $options = null): ChainedValidator;

    public function keyIsbn(int|string $key): ChainedValidator;

    public function keyIterableType(int|string $key): ChainedValidator;

    public function keyIterableVal(int|string $key): ChainedValidator;

    public function keyJson(int|string $key): ChainedValidator;

    /**
     * @param "alpha-2"|"alpha-3" $set
     */
    public function keyLanguageCode(int|string $key, string $set = 'alpha-2'): ChainedValidator;

    /**
     * @param callable(mixed): Rule $ruleCreator
     */
    public function keyLazy(int|string $key, callable $ruleCreator): ChainedValidator;

    public function keyLeapDate(int|string $key, string $format): ChainedValidator;

    public function keyLeapYear(int|string $key): ChainedValidator;

    public function keyLength(int|string $key, Rule $rule): ChainedValidator;

    public function keyLessThan(int|string $key, mixed $compareTo): ChainedValidator;

    public function keyLessThanOrEqual(int|string $key, mixed $compareTo): ChainedValidator;

    public function keyLowercase(int|string $key): ChainedValidator;

    public function keyLuhn(int|string $key): ChainedValidator;

    public function keyMacAddress(int|string $key): ChainedValidator;

    public function keyMax(int|string $key, Rule $rule): ChainedValidator;

    public function keyMimetype(int|string $key, string $mimetype): ChainedValidator;

    public function keyMin(int|string $key, Rule $rule): ChainedValidator;

    public function keyMultiple(int|string $key, int $multipleOf): ChainedValidator;

    public function keyNegative(int|string $key): ChainedValidator;

    public function keyNfeAccessKey(int|string $key): ChainedValidator;

    public function keyNif(int|string $key): ChainedValidator;

    public function keyNip(int|string $key): ChainedValidator;

    public function keyNo(int|string $key, bool $useLocale = false): ChainedValidator;

    public function keyNoWhitespace(int|string $key): ChainedValidator;

    public function keyNoneOf(int|string $key, Rule $rule1, Rule $rule2, Rule ...$rules): ChainedValidator;

    public function keyNot(int|string $key, Rule $rule): ChainedValidator;

    public function keyNotBlank(int|string $key): ChainedValidator;

    public function keyNotEmoji(int|string $key): ChainedValidator;

    public function keyNotEmpty(int|string $key): ChainedValidator;

    public function keyNotOptional(int|string $key): ChainedValidator;

    public function keyNotUndef(int|string $key): ChainedValidator;

    public function keyNullType(int|string $key): ChainedValidator;

    public function keyNumber(int|string $key): ChainedValidator;

    public function keyNumericVal(int|string $key): ChainedValidator;

    public function keyObjectType(int|string $key): ChainedValidator;

    public function keyOdd(int|string $key): ChainedValidator;

    public function keyOneOf(int|string $key, Rule $rule1, Rule $rule2, Rule ...$rules): ChainedValidator;

    public function keyPerfectSquare(int|string $key): ChainedValidator;

    public function keyPesel(int|string $key): ChainedValidator;

    public function keyPhone(int|string $key, ?string $countryCode = null): ChainedValidator;

    public function keyPhpLabel(int|string $key): ChainedValidator;

    public function keyPis(int|string $key): ChainedValidator;

    public function keyPolishIdCard(int|string $key): ChainedValidator;

    public function keyPortugueseNif(int|string $key): ChainedValidator;

    public function keyPositive(int|string $key): ChainedValidator;

    public function keyPostalCode(int|string $key, string $countryCode, bool $formatted = false): ChainedValidator;

    public function keyPrimeNumber(int|string $key): ChainedValidator;

    public function keyPrintable(int|string $key, string ...$additionalChars): ChainedValidator;

    public function keyPublicDomainSuffix(int|string $key): ChainedValidator;

    public function keyPunct(int|string $key, string ...$additionalChars): ChainedValidator;

    public function keyReadable(int|string $key): ChainedValidator;

    public function keyRegex(int|string $key, string $regex): ChainedValidator;

    public function keyResourceType(int|string $key): ChainedValidator;

    public function keyRoman(int|string $key): ChainedValidator;

    public function keyScalarVal(int|string $key): ChainedValidator;

    public function keySize(
        int|string $key,
        string|int|null $minSize = null,
        string|int|null $maxSize = null,
    ): ChainedValidator;

    public function keySlug(int|string $key): ChainedValidator;

    public function keySorted(int|string $key, string $direction): ChainedValidator;

    public function keySpace(int|string $key, string ...$additionalChars): ChainedValidator;

    public function keyStartsWith(int|string $key, mixed $startValue, bool $identical = false): ChainedValidator;

    public function keyStringType(int|string $key): ChainedValidator;

    public function keyStringVal(int|string $key): ChainedValidator;

    public function keySubdivisionCode(int|string $key, string $countryCode): ChainedValidator;

    /**
     * @param mixed[] $superset
     */
    public function keySubset(int|string $key, array $superset): ChainedValidator;

    public function keySymbolicLink(int|string $key): ChainedValidator;

    public function keyTime(int|string $key, string $format = 'H:i:s'): ChainedValidator;

    public function keyTld(int|string $key): ChainedValidator;

    public function keyTrueVal(int|string $key): ChainedValidator;

    public function keyUnique(int|string $key): ChainedValidator;

    public function keyUploaded(int|string $key): ChainedValidator;

    public function keyUppercase(int|string $key): ChainedValidator;

    public function keyUrl(int|string $key): ChainedValidator;

    public function keyUuid(int|string $key, ?int $version = null): ChainedValidator;

    public function keyVersion(int|string $key): ChainedValidator;

    public function keyVideoUrl(int|string $key, ?string $service = null): ChainedValidator;

    public function keyVowel(int|string $key, string ...$additionalChars): ChainedValidator;

    public function keyWhen(int|string $key, Rule $when, Rule $then, ?Rule $else = null): ChainedValidator;

    public function keyWritable(int|string $key): ChainedValidator;

    public function keyXdigit(int|string $key, string ...$additionalChars): ChainedValidator;

    public function keyYes(int|string $key, bool $useLocale = false): ChainedValidator;
}
