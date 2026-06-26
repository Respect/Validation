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

interface KeyBuilder
{
    /** @return Chain<array|\ArrayAccess> */
    public static function keyAfter(int|string $key, callable $callable, Validator $validator): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyAll(int|string $key, Validator $validator): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyAllOf(int|string $key, Validator $validator1, Validator $validator2, Validator ...$validators): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyAlnum(int|string $key, string ...$additionalChars): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyAlpha(int|string $key, string ...$additionalChars): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyAlwaysInvalid(int|string $key): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyAlwaysValid(int|string $key): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyAnyOf(int|string $key, Validator $validator1, Validator $validator2, Validator ...$validators): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyArrayType(int|string $key): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyArrayVal(int|string $key): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyBase(int|string $key, int $base, string $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyBase64(int|string $key): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyBetween(int|string $key, mixed $minValue, mixed $maxValue): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyBetweenExclusive(int|string $key, mixed $minimum, mixed $maximum): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyBlank(int|string $key): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyBoolType(int|string $key): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyBoolVal(int|string $key): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyBsn(int|string $key): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyCallableType(int|string $key): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyCharset(int|string $key, string $charset, string ...$charsets): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyCnh(int|string $key): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyCnpj(int|string $key): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyConsonant(int|string $key, string ...$additionalChars): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyContains(int|string $key, mixed $containsValue): Chain;

    /**
     * @param non-empty-array<mixed> $needles
     * @return Chain<array|\ArrayAccess>
     */
    public static function keyContainsAny(int|string $key, array $needles): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyContainsCount(int|string $key, mixed $containsValue, int $count): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyControl(int|string $key, string ...$additionalChars): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyCountable(int|string $key): Chain;

    /**
     * @param "alpha-2"|"alpha-3"|"numeric" $set
     * @return Chain<array|\ArrayAccess>
     */
    public static function keyCountryCode(int|string $key, string $set = 'alpha-2'): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyCpf(int|string $key): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyCreditCard(int|string $key, string $brand = 'Any'): Chain;

    /**
     * @param "alpha-3"|"numeric" $set
     * @return Chain<array|\ArrayAccess>
     */
    public static function keyCurrencyCode(int|string $key, string $set = 'alpha-3'): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyDate(int|string $key, string $format = 'Y-m-d'): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyDateTime(int|string $key, string|null $format = null): Chain;

    /**
     * @param "years"|"months"|"days"|"hours"|"minutes"|"seconds"|"microseconds" $type
     * @return Chain<array|\ArrayAccess>
     */
    public static function keyDateTimeDiff(int|string $key, string $type, Validator $validator, string|null $format = null, DateTimeImmutable|null $now = null): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyDecimal(int|string $key, int $decimals): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyDigit(int|string $key, string ...$additionalChars): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyDirectory(int|string $key): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyDomain(int|string $key, bool $tldCheck = true): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyEach(int|string $key, Validator $validator): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyEachKey(int|string $key, Validator $validator): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyEmail(int|string $key): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyEmoji(int|string $key): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyEndsWith(int|string $key, mixed $endValue, mixed ...$endValues): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyEquals(int|string $key, mixed $compareTo): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyEquivalent(int|string $key, mixed $compareTo): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyEven(int|string $key): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyExecutable(int|string $key): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyExtension(int|string $key, string $extension): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyFactor(int|string $key, int $dividend): Chain;

    /**
     * @param callable(mixed): Validator $factory
     * @return Chain<array|\ArrayAccess>
     */
    public static function keyFactory(int|string $key, callable $factory): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyFalseVal(int|string $key): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyFalsy(int|string $key): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyFile(int|string $key): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyFinite(int|string $key): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyFloatType(int|string $key): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyFloatVal(int|string $key): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyFormat(int|string $key, Formatter $formatter): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyGiven(int|string $key, Validator $when, Validator $then): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyGraph(int|string $key, string ...$additionalChars): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyGreaterThan(int|string $key, mixed $compareTo): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyGreaterThanOrEqual(int|string $key, mixed $compareTo): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyHetu(int|string $key): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyHexRgbColor(int|string $key): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyIban(int|string $key): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyIdentical(int|string $key, mixed $compareTo): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyImage(int|string $key): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyImei(int|string $key): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyIn(int|string $key, mixed $haystack): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyInfinite(int|string $key): Chain;

    /**
     * @param class-string $class
     * @return Chain<array|\ArrayAccess>
     */
    public static function keyInstance(int|string $key, string $class): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyIntType(int|string $key): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyIntVal(int|string $key): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyIp(int|string $key, string $range = '*', int|null $options = null): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyIsbn(int|string $key): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyIterableType(int|string $key): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyIterableVal(int|string $key): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyJson(int|string $key): Chain;

    /**
     * @param "alpha-2"|"alpha-3" $set
     * @return Chain<array|\ArrayAccess>
     */
    public static function keyLanguageCode(int|string $key, string $set = 'alpha-2'): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyLeapDate(int|string $key, string $format): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyLeapYear(int|string $key): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyLength(int|string $key, Validator $validator): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyLessThan(int|string $key, mixed $compareTo): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyLessThanOrEqual(int|string $key, mixed $compareTo): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyLowercase(int|string $key): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyLuhn(int|string $key): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyMacAddress(int|string $key): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyMax(int|string $key, Validator $validator): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyMimetype(int|string $key, string $mimetype): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyMin(int|string $key, Validator $validator): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyMultiple(int|string $key, int $multipleOf): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyNegative(int|string $key): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyNfeAccessKey(int|string $key): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyNif(int|string $key): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyNip(int|string $key): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyNoneOf(int|string $key, Validator $validator1, Validator $validator2, Validator ...$validators): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyNot(int|string $key, Validator $validator): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyNullType(int|string $key): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyNumber(int|string $key): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyNumericVal(int|string $key): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyObjectType(int|string $key): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyOdd(int|string $key): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyOneOf(int|string $key, Validator $validator1, Validator $validator2, Validator ...$validators): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyPesel(int|string $key): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyPhone(int|string $key, string|null $countryCode = null): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyPis(int|string $key): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyPolishIdCard(int|string $key): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyPortugueseNif(int|string $key): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyPositive(int|string $key): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyPostalCode(int|string $key, string $countryCode, bool $formatted = false): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyPrintable(int|string $key, string ...$additionalChars): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyPublicDomainSuffix(int|string $key): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyPunct(int|string $key, string ...$additionalChars): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyReadable(int|string $key): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyRegex(int|string $key, string $regex): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyResourceType(int|string $key): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyRoman(int|string $key): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keySatisfies(int|string $key, callable $callback, mixed ...$arguments): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyScalarVal(int|string $key): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyShortCircuit(int|string $key, Validator ...$validators): Chain;

    /**
     * @param "B"|"KB"|"MB"|"GB"|"TB"|"PB"|"EB"|"ZB"|"YB" $unit
     * @return Chain<array|\ArrayAccess>
     */
    public static function keySize(int|string $key, string $unit, Validator $validator): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keySlug(int|string $key): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keySorted(int|string $key, string $direction): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keySpace(int|string $key, string ...$additionalChars): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keySpaced(int|string $key): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyStartsWith(int|string $key, mixed $startValue, mixed ...$startValues): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyStringType(int|string $key): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyStringVal(int|string $key): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keySubdivisionCode(int|string $key, string $countryCode): Chain;

    /**
     * @param mixed[] $superset
     * @return Chain<array|\ArrayAccess>
     */
    public static function keySubset(int|string $key, array $superset): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keySymbolicLink(int|string $key): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyTime(int|string $key, string $format = 'H:i:s'): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyTld(int|string $key): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyTrimmed(int|string $key, string ...$trimValues): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyTrueVal(int|string $key): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyUndef(int|string $key): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyUnique(int|string $key): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyUppercase(int|string $key): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyUrl(int|string $key): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyUuid(int|string $key, int|null $version = null): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyVersion(int|string $key): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyVowel(int|string $key, string ...$additionalChars): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyWhen(int|string $key, Validator $when, Validator $then, Validator|null $else = null): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyWritable(int|string $key): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyXdigit(int|string $key, string ...$additionalChars): Chain;
}
