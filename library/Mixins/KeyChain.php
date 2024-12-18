<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Mixins;

use DateTimeImmutable;
use Respect\Validation\Rule;

interface KeyChain
{
    public function keyAllOf(int|string $key, Rule $rule1, Rule $rule2, Rule ...$rules): Chain;

    public function keyAlnum(int|string $key, string ...$additionalChars): Chain;

    public function keyAlpha(int|string $key, string ...$additionalChars): Chain;

    public function keyAlwaysInvalid(int|string $key): Chain;

    public function keyAlwaysValid(int|string $key): Chain;

    public function keyAnyOf(int|string $key, Rule $rule1, Rule $rule2, Rule ...$rules): Chain;

    public function keyArrayType(int|string $key): Chain;

    public function keyArrayVal(int|string $key): Chain;

    public function keyBase(
        int|string $key,
        int $base,
        string $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
    ): Chain;

    public function keyBase64(int|string $key): Chain;

    public function keyBetween(int|string $key, mixed $minValue, mixed $maxValue): Chain;

    public function keyBetweenExclusive(int|string $key, mixed $minimum, mixed $maximum): Chain;

    public function keyBoolType(int|string $key): Chain;

    public function keyBoolVal(int|string $key): Chain;

    public function keyBsn(int|string $key): Chain;

    public function keyCall(int|string $key, callable $callable, Rule $rule): Chain;

    public function keyCallableType(int|string $key): Chain;

    public function keyCallback(int|string $key, callable $callback, mixed ...$arguments): Chain;

    public function keyCharset(int|string $key, string $charset, string ...$charsets): Chain;

    public function keyCnh(int|string $key): Chain;

    public function keyCnpj(int|string $key): Chain;

    public function keyConsecutive(int|string $key, Rule $rule1, Rule $rule2, Rule ...$rules): Chain;

    public function keyConsonant(int|string $key, string ...$additionalChars): Chain;

    public function keyContains(int|string $key, mixed $containsValue, bool $identical = false): Chain;

    /**
     * @param non-empty-array<mixed> $needles
     */
    public function keyContainsAny(int|string $key, array $needles, bool $identical = false): Chain;

    public function keyControl(int|string $key, string ...$additionalChars): Chain;

    public function keyCountable(int|string $key): Chain;

    /**
     * @param "alpha-2"|"alpha-3"|"numeric" $set
     */
    public function keyCountryCode(int|string $key, string $set = 'alpha-2'): Chain;

    public function keyCpf(int|string $key): Chain;

    public function keyCreditCard(int|string $key, string $brand = 'Any'): Chain;

    /**
     * @param "alpha-3"|"numeric" $set
     */
    public function keyCurrencyCode(int|string $key, string $set = 'alpha-3'): Chain;

    public function keyDate(int|string $key, string $format = 'Y-m-d'): Chain;

    public function keyDateTime(int|string $key, ?string $format = null): Chain;

    /**
     * @param "years"|"months"|"days"|"hours"|"minutes"|"seconds"|"microseconds" $type
     */
    public function keyDateTimeDiff(
        int|string $key,
        string $type,
        Rule $rule,
        ?string $format = null,
        ?DateTimeImmutable $now = null,
    ): Chain;

    public function keyDecimal(int|string $key, int $decimals): Chain;

    public function keyDigit(int|string $key, string ...$additionalChars): Chain;

    public function keyDirectory(int|string $key): Chain;

    public function keyDomain(int|string $key, bool $tldCheck = true): Chain;

    public function keyEach(int|string $key, Rule $rule): Chain;

    public function keyEmail(int|string $key): Chain;

    public function keyEndsWith(int|string $key, mixed $endValue, bool $identical = false): Chain;

    public function keyEquals(int|string $key, mixed $compareTo): Chain;

    public function keyEquivalent(int|string $key, mixed $compareTo): Chain;

    public function keyEven(int|string $key): Chain;

    public function keyExecutable(int|string $key): Chain;

    public function keyExtension(int|string $key, string $extension): Chain;

    public function keyFactor(int|string $key, int $dividend): Chain;

    public function keyFalseVal(int|string $key): Chain;

    public function keyFibonacci(int|string $key): Chain;

    public function keyFile(int|string $key): Chain;

    public function keyFilterVar(int|string $key, int $filter, mixed $options = null): Chain;

    public function keyFinite(int|string $key): Chain;

    public function keyFloatType(int|string $key): Chain;

    public function keyFloatVal(int|string $key): Chain;

    public function keyGraph(int|string $key, string ...$additionalChars): Chain;

    public function keyGreaterThan(int|string $key, mixed $compareTo): Chain;

    public function keyGreaterThanOrEqual(int|string $key, mixed $compareTo): Chain;

    public function keyHetu(int|string $key): Chain;

    public function keyHexRgbColor(int|string $key): Chain;

    public function keyIban(int|string $key): Chain;

    public function keyIdentical(int|string $key, mixed $compareTo): Chain;

    public function keyImage(int|string $key): Chain;

    public function keyImei(int|string $key): Chain;

    public function keyIn(int|string $key, mixed $haystack, bool $compareIdentical = false): Chain;

    public function keyInfinite(int|string $key): Chain;

    /**
     * @param class-string $class
     */
    public function keyInstance(int|string $key, string $class): Chain;

    public function keyIntType(int|string $key): Chain;

    public function keyIntVal(int|string $key): Chain;

    public function keyIp(int|string $key, string $range = '*', ?int $options = null): Chain;

    public function keyIsbn(int|string $key): Chain;

    public function keyIterableType(int|string $key): Chain;

    public function keyIterableVal(int|string $key): Chain;

    public function keyJson(int|string $key): Chain;

    /**
     * @param "alpha-2"|"alpha-3" $set
     */
    public function keyLanguageCode(int|string $key, string $set = 'alpha-2'): Chain;

    /**
     * @param callable(mixed): Rule $ruleCreator
     */
    public function keyLazy(int|string $key, callable $ruleCreator): Chain;

    public function keyLeapDate(int|string $key, string $format): Chain;

    public function keyLeapYear(int|string $key): Chain;

    public function keyLength(int|string $key, Rule $rule): Chain;

    public function keyLessThan(int|string $key, mixed $compareTo): Chain;

    public function keyLessThanOrEqual(int|string $key, mixed $compareTo): Chain;

    public function keyLowercase(int|string $key): Chain;

    public function keyLuhn(int|string $key): Chain;

    public function keyMacAddress(int|string $key): Chain;

    public function keyMax(int|string $key, Rule $rule): Chain;

    public function keyMimetype(int|string $key, string $mimetype): Chain;

    public function keyMin(int|string $key, Rule $rule): Chain;

    public function keyMultiple(int|string $key, int $multipleOf): Chain;

    public function keyNegative(int|string $key): Chain;

    public function keyNfeAccessKey(int|string $key): Chain;

    public function keyNif(int|string $key): Chain;

    public function keyNip(int|string $key): Chain;

    public function keyNo(int|string $key, bool $useLocale = false): Chain;

    public function keyNoWhitespace(int|string $key): Chain;

    public function keyNoneOf(int|string $key, Rule $rule1, Rule $rule2, Rule ...$rules): Chain;

    public function keyNot(int|string $key, Rule $rule): Chain;

    public function keyNotBlank(int|string $key): Chain;

    public function keyNotEmoji(int|string $key): Chain;

    public function keyNotEmpty(int|string $key): Chain;

    public function keyNotOptional(int|string $key): Chain;

    public function keyNotUndef(int|string $key): Chain;

    public function keyNullType(int|string $key): Chain;

    public function keyNumber(int|string $key): Chain;

    public function keyNumericVal(int|string $key): Chain;

    public function keyObjectType(int|string $key): Chain;

    public function keyOdd(int|string $key): Chain;

    public function keyOneOf(int|string $key, Rule $rule1, Rule $rule2, Rule ...$rules): Chain;

    public function keyPerfectSquare(int|string $key): Chain;

    public function keyPesel(int|string $key): Chain;

    public function keyPhone(int|string $key, ?string $countryCode = null): Chain;

    public function keyPhpLabel(int|string $key): Chain;

    public function keyPis(int|string $key): Chain;

    public function keyPolishIdCard(int|string $key): Chain;

    public function keyPortugueseNif(int|string $key): Chain;

    public function keyPositive(int|string $key): Chain;

    public function keyPostalCode(int|string $key, string $countryCode, bool $formatted = false): Chain;

    public function keyPrimeNumber(int|string $key): Chain;

    public function keyPrintable(int|string $key, string ...$additionalChars): Chain;

    public function keyPublicDomainSuffix(int|string $key): Chain;

    public function keyPunct(int|string $key, string ...$additionalChars): Chain;

    public function keyReadable(int|string $key): Chain;

    public function keyRegex(int|string $key, string $regex): Chain;

    public function keyResourceType(int|string $key): Chain;

    public function keyRoman(int|string $key): Chain;

    public function keyScalarVal(int|string $key): Chain;

    /**
     * @param "B"|"KB"|"MB"|"GB"|"TB"|"PB"|"EB"|"ZB"|"YB" $unit
     */
    public function keySize(int|string $key, string $unit, Rule $rule): Chain;

    public function keySlug(int|string $key): Chain;

    public function keySorted(int|string $key, string $direction): Chain;

    public function keySpace(int|string $key, string ...$additionalChars): Chain;

    public function keyStartsWith(int|string $key, mixed $startValue, bool $identical = false): Chain;

    public function keyStringType(int|string $key): Chain;

    public function keyStringVal(int|string $key): Chain;

    public function keySubdivisionCode(int|string $key, string $countryCode): Chain;

    /**
     * @param mixed[] $superset
     */
    public function keySubset(int|string $key, array $superset): Chain;

    public function keySymbolicLink(int|string $key): Chain;

    public function keyTime(int|string $key, string $format = 'H:i:s'): Chain;

    public function keyTld(int|string $key): Chain;

    public function keyTrueVal(int|string $key): Chain;

    public function keyUnique(int|string $key): Chain;

    public function keyUploaded(int|string $key): Chain;

    public function keyUppercase(int|string $key): Chain;

    public function keyUrl(int|string $key): Chain;

    public function keyUuid(int|string $key, ?int $version = null): Chain;

    public function keyVersion(int|string $key): Chain;

    public function keyVideoUrl(int|string $key, ?string $service = null): Chain;

    public function keyVowel(int|string $key, string ...$additionalChars): Chain;

    public function keyWhen(int|string $key, Rule $when, Rule $then, ?Rule $else = null): Chain;

    public function keyWritable(int|string $key): Chain;

    public function keyXdigit(int|string $key, string ...$additionalChars): Chain;

    public function keyYes(int|string $key, bool $useLocale = false): Chain;
}
