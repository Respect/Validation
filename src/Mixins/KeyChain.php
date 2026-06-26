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

interface KeyChain
{
    /** @return Chain<mixed> */
    public function keyAfter(int|string $key, callable $callable, Validator $validator): Chain;

    /** @return Chain<mixed> */
    public function keyAll(int|string $key, Validator $validator): Chain;

    /** @return Chain<mixed> */
    public function keyAllOf(int|string $key, Validator $validator1, Validator $validator2, Validator ...$validators): Chain;

    /** @return Chain<mixed> */
    public function keyAlnum(int|string $key, string ...$additionalChars): Chain;

    /** @return Chain<mixed> */
    public function keyAlpha(int|string $key, string ...$additionalChars): Chain;

    /** @return Chain<mixed> */
    public function keyAlwaysInvalid(int|string $key): Chain;

    /** @return Chain<mixed> */
    public function keyAlwaysValid(int|string $key): Chain;

    /** @return Chain<mixed> */
    public function keyAnyOf(int|string $key, Validator $validator1, Validator $validator2, Validator ...$validators): Chain;

    /** @return Chain<mixed> */
    public function keyArrayType(int|string $key): Chain;

    /** @return Chain<mixed> */
    public function keyArrayVal(int|string $key): Chain;

    /** @return Chain<mixed> */
    public function keyBase(int|string $key, int $base, string $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'): Chain;

    /** @return Chain<mixed> */
    public function keyBase64(int|string $key): Chain;

    /** @return Chain<mixed> */
    public function keyBetween(int|string $key, mixed $minValue, mixed $maxValue): Chain;

    /** @return Chain<mixed> */
    public function keyBetweenExclusive(int|string $key, mixed $minimum, mixed $maximum): Chain;

    /** @return Chain<mixed> */
    public function keyBlank(int|string $key): Chain;

    /** @return Chain<mixed> */
    public function keyBoolType(int|string $key): Chain;

    /** @return Chain<mixed> */
    public function keyBoolVal(int|string $key): Chain;

    /** @return Chain<mixed> */
    public function keyBsn(int|string $key): Chain;

    /** @return Chain<mixed> */
    public function keyCallableType(int|string $key): Chain;

    /** @return Chain<mixed> */
    public function keyCharset(int|string $key, string $charset, string ...$charsets): Chain;

    /** @return Chain<mixed> */
    public function keyCnh(int|string $key): Chain;

    /** @return Chain<mixed> */
    public function keyCnpj(int|string $key): Chain;

    /** @return Chain<mixed> */
    public function keyConsonant(int|string $key, string ...$additionalChars): Chain;

    /** @return Chain<mixed> */
    public function keyContains(int|string $key, mixed $containsValue): Chain;

    /**
     * @param non-empty-array<mixed> $needles
     * @return Chain<mixed>
     */
    public function keyContainsAny(int|string $key, array $needles): Chain;

    /** @return Chain<mixed> */
    public function keyContainsCount(int|string $key, mixed $containsValue, int $count): Chain;

    /** @return Chain<mixed> */
    public function keyControl(int|string $key, string ...$additionalChars): Chain;

    /** @return Chain<mixed> */
    public function keyCountable(int|string $key): Chain;

    /**
     * @param "alpha-2"|"alpha-3"|"numeric" $set
     * @return Chain<mixed>
     */
    public function keyCountryCode(int|string $key, string $set = 'alpha-2'): Chain;

    /** @return Chain<mixed> */
    public function keyCpf(int|string $key): Chain;

    /** @return Chain<mixed> */
    public function keyCreditCard(int|string $key, string $brand = 'Any'): Chain;

    /**
     * @param "alpha-3"|"numeric" $set
     * @return Chain<mixed>
     */
    public function keyCurrencyCode(int|string $key, string $set = 'alpha-3'): Chain;

    /** @return Chain<mixed> */
    public function keyDate(int|string $key, string $format = 'Y-m-d'): Chain;

    /** @return Chain<mixed> */
    public function keyDateTime(int|string $key, string|null $format = null): Chain;

    /**
     * @param "years"|"months"|"days"|"hours"|"minutes"|"seconds"|"microseconds" $type
     * @return Chain<mixed>
     */
    public function keyDateTimeDiff(int|string $key, string $type, Validator $validator, string|null $format = null, DateTimeImmutable|null $now = null): Chain;

    /** @return Chain<mixed> */
    public function keyDecimal(int|string $key, int $decimals): Chain;

    /** @return Chain<mixed> */
    public function keyDigit(int|string $key, string ...$additionalChars): Chain;

    /** @return Chain<mixed> */
    public function keyDirectory(int|string $key): Chain;

    /** @return Chain<mixed> */
    public function keyDomain(int|string $key, bool $tldCheck = true): Chain;

    /** @return Chain<mixed> */
    public function keyEach(int|string $key, Validator $validator): Chain;

    /** @return Chain<mixed> */
    public function keyEachKey(int|string $key, Validator $validator): Chain;

    /** @return Chain<mixed> */
    public function keyEmail(int|string $key): Chain;

    /** @return Chain<mixed> */
    public function keyEmoji(int|string $key): Chain;

    /** @return Chain<mixed> */
    public function keyEndsWith(int|string $key, mixed $endValue, mixed ...$endValues): Chain;

    /** @return Chain<mixed> */
    public function keyEquals(int|string $key, mixed $compareTo): Chain;

    /** @return Chain<mixed> */
    public function keyEquivalent(int|string $key, mixed $compareTo): Chain;

    /** @return Chain<mixed> */
    public function keyEven(int|string $key): Chain;

    /** @return Chain<mixed> */
    public function keyExecutable(int|string $key): Chain;

    /** @return Chain<mixed> */
    public function keyExtension(int|string $key, string $extension): Chain;

    /** @return Chain<mixed> */
    public function keyFactor(int|string $key, int $dividend): Chain;

    /**
     * @param callable(mixed): Validator $factory
     * @return Chain<mixed>
     */
    public function keyFactory(int|string $key, callable $factory): Chain;

    /** @return Chain<mixed> */
    public function keyFalseVal(int|string $key): Chain;

    /** @return Chain<mixed> */
    public function keyFalsy(int|string $key): Chain;

    /** @return Chain<mixed> */
    public function keyFile(int|string $key): Chain;

    /** @return Chain<mixed> */
    public function keyFinite(int|string $key): Chain;

    /** @return Chain<mixed> */
    public function keyFloatType(int|string $key): Chain;

    /** @return Chain<mixed> */
    public function keyFloatVal(int|string $key): Chain;

    /** @return Chain<mixed> */
    public function keyFormat(int|string $key, Formatter $formatter): Chain;

    /** @return Chain<mixed> */
    public function keyGiven(int|string $key, Validator $when, Validator $then): Chain;

    /** @return Chain<mixed> */
    public function keyGraph(int|string $key, string ...$additionalChars): Chain;

    /** @return Chain<mixed> */
    public function keyGreaterThan(int|string $key, mixed $compareTo): Chain;

    /** @return Chain<mixed> */
    public function keyGreaterThanOrEqual(int|string $key, mixed $compareTo): Chain;

    /** @return Chain<mixed> */
    public function keyHetu(int|string $key): Chain;

    /** @return Chain<mixed> */
    public function keyHexRgbColor(int|string $key): Chain;

    /** @return Chain<mixed> */
    public function keyIban(int|string $key): Chain;

    /** @return Chain<mixed> */
    public function keyIdentical(int|string $key, mixed $compareTo): Chain;

    /** @return Chain<mixed> */
    public function keyImage(int|string $key): Chain;

    /** @return Chain<mixed> */
    public function keyImei(int|string $key): Chain;

    /** @return Chain<mixed> */
    public function keyIn(int|string $key, mixed $haystack): Chain;

    /** @return Chain<mixed> */
    public function keyInfinite(int|string $key): Chain;

    /**
     * @param class-string $class
     * @return Chain<mixed>
     */
    public function keyInstance(int|string $key, string $class): Chain;

    /** @return Chain<mixed> */
    public function keyIntType(int|string $key): Chain;

    /** @return Chain<mixed> */
    public function keyIntVal(int|string $key): Chain;

    /** @return Chain<mixed> */
    public function keyIp(int|string $key, string $range = '*', int|null $options = null): Chain;

    /** @return Chain<mixed> */
    public function keyIsbn(int|string $key): Chain;

    /** @return Chain<mixed> */
    public function keyIterableType(int|string $key): Chain;

    /** @return Chain<mixed> */
    public function keyIterableVal(int|string $key): Chain;

    /** @return Chain<mixed> */
    public function keyJson(int|string $key): Chain;

    /**
     * @param "alpha-2"|"alpha-3" $set
     * @return Chain<mixed>
     */
    public function keyLanguageCode(int|string $key, string $set = 'alpha-2'): Chain;

    /** @return Chain<mixed> */
    public function keyLeapDate(int|string $key, string $format): Chain;

    /** @return Chain<mixed> */
    public function keyLeapYear(int|string $key): Chain;

    /** @return Chain<mixed> */
    public function keyLength(int|string $key, Validator $validator): Chain;

    /** @return Chain<mixed> */
    public function keyLessThan(int|string $key, mixed $compareTo): Chain;

    /** @return Chain<mixed> */
    public function keyLessThanOrEqual(int|string $key, mixed $compareTo): Chain;

    /** @return Chain<mixed> */
    public function keyLowercase(int|string $key): Chain;

    /** @return Chain<mixed> */
    public function keyLuhn(int|string $key): Chain;

    /** @return Chain<mixed> */
    public function keyMacAddress(int|string $key): Chain;

    /** @return Chain<mixed> */
    public function keyMax(int|string $key, Validator $validator): Chain;

    /** @return Chain<mixed> */
    public function keyMimetype(int|string $key, string $mimetype): Chain;

    /** @return Chain<mixed> */
    public function keyMin(int|string $key, Validator $validator): Chain;

    /** @return Chain<mixed> */
    public function keyMultiple(int|string $key, int $multipleOf): Chain;

    /** @return Chain<mixed> */
    public function keyNegative(int|string $key): Chain;

    /** @return Chain<mixed> */
    public function keyNfeAccessKey(int|string $key): Chain;

    /** @return Chain<mixed> */
    public function keyNif(int|string $key): Chain;

    /** @return Chain<mixed> */
    public function keyNip(int|string $key): Chain;

    /** @return Chain<mixed> */
    public function keyNoneOf(int|string $key, Validator $validator1, Validator $validator2, Validator ...$validators): Chain;

    /** @return Chain<mixed> */
    public function keyNot(int|string $key, Validator $validator): Chain;

    /** @return Chain<mixed> */
    public function keyNullType(int|string $key): Chain;

    /** @return Chain<mixed> */
    public function keyNumber(int|string $key): Chain;

    /** @return Chain<mixed> */
    public function keyNumericVal(int|string $key): Chain;

    /** @return Chain<mixed> */
    public function keyObjectType(int|string $key): Chain;

    /** @return Chain<mixed> */
    public function keyOdd(int|string $key): Chain;

    /** @return Chain<mixed> */
    public function keyOneOf(int|string $key, Validator $validator1, Validator $validator2, Validator ...$validators): Chain;

    /** @return Chain<mixed> */
    public function keyPesel(int|string $key): Chain;

    /** @return Chain<mixed> */
    public function keyPhone(int|string $key, string|null $countryCode = null): Chain;

    /** @return Chain<mixed> */
    public function keyPis(int|string $key): Chain;

    /** @return Chain<mixed> */
    public function keyPolishIdCard(int|string $key): Chain;

    /** @return Chain<mixed> */
    public function keyPortugueseNif(int|string $key): Chain;

    /** @return Chain<mixed> */
    public function keyPositive(int|string $key): Chain;

    /** @return Chain<mixed> */
    public function keyPostalCode(int|string $key, string $countryCode, bool $formatted = false): Chain;

    /** @return Chain<mixed> */
    public function keyPrintable(int|string $key, string ...$additionalChars): Chain;

    /** @return Chain<mixed> */
    public function keyPublicDomainSuffix(int|string $key): Chain;

    /** @return Chain<mixed> */
    public function keyPunct(int|string $key, string ...$additionalChars): Chain;

    /** @return Chain<mixed> */
    public function keyReadable(int|string $key): Chain;

    /** @return Chain<mixed> */
    public function keyRegex(int|string $key, string $regex): Chain;

    /** @return Chain<mixed> */
    public function keyResourceType(int|string $key): Chain;

    /** @return Chain<mixed> */
    public function keyRoman(int|string $key): Chain;

    /** @return Chain<mixed> */
    public function keySatisfies(int|string $key, callable $callback, mixed ...$arguments): Chain;

    /** @return Chain<mixed> */
    public function keyScalarVal(int|string $key): Chain;

    /** @return Chain<mixed> */
    public function keyShortCircuit(int|string $key, Validator ...$validators): Chain;

    /**
     * @param "B"|"KB"|"MB"|"GB"|"TB"|"PB"|"EB"|"ZB"|"YB" $unit
     * @return Chain<mixed>
     */
    public function keySize(int|string $key, string $unit, Validator $validator): Chain;

    /** @return Chain<mixed> */
    public function keySlug(int|string $key): Chain;

    /** @return Chain<mixed> */
    public function keySorted(int|string $key, string $direction): Chain;

    /** @return Chain<mixed> */
    public function keySpace(int|string $key, string ...$additionalChars): Chain;

    /** @return Chain<mixed> */
    public function keySpaced(int|string $key): Chain;

    /** @return Chain<mixed> */
    public function keyStartsWith(int|string $key, mixed $startValue, mixed ...$startValues): Chain;

    /** @return Chain<mixed> */
    public function keyStringType(int|string $key): Chain;

    /** @return Chain<mixed> */
    public function keyStringVal(int|string $key): Chain;

    /** @return Chain<mixed> */
    public function keySubdivisionCode(int|string $key, string $countryCode): Chain;

    /**
     * @param mixed[] $superset
     * @return Chain<mixed>
     */
    public function keySubset(int|string $key, array $superset): Chain;

    /** @return Chain<mixed> */
    public function keySymbolicLink(int|string $key): Chain;

    /** @return Chain<mixed> */
    public function keyTime(int|string $key, string $format = 'H:i:s'): Chain;

    /** @return Chain<mixed> */
    public function keyTld(int|string $key): Chain;

    /** @return Chain<mixed> */
    public function keyTrimmed(int|string $key, string ...$trimValues): Chain;

    /** @return Chain<mixed> */
    public function keyTrueVal(int|string $key): Chain;

    /** @return Chain<mixed> */
    public function keyUndef(int|string $key): Chain;

    /** @return Chain<mixed> */
    public function keyUnique(int|string $key): Chain;

    /** @return Chain<mixed> */
    public function keyUppercase(int|string $key): Chain;

    /** @return Chain<mixed> */
    public function keyUrl(int|string $key): Chain;

    /** @return Chain<mixed> */
    public function keyUuid(int|string $key, int|null $version = null): Chain;

    /** @return Chain<mixed> */
    public function keyVersion(int|string $key): Chain;

    /** @return Chain<mixed> */
    public function keyVowel(int|string $key, string ...$additionalChars): Chain;

    /** @return Chain<mixed> */
    public function keyWhen(int|string $key, Validator $when, Validator $then, Validator|null $else = null): Chain;

    /** @return Chain<mixed> */
    public function keyWritable(int|string $key): Chain;

    /** @return Chain<mixed> */
    public function keyXdigit(int|string $key, string ...$additionalChars): Chain;
}
