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

interface PropertyChain
{
    /** @return Chain<mixed> */
    public function propertyAfter(string $propertyName, callable $callable, Validator $validator): Chain;

    /** @return Chain<mixed> */
    public function propertyAll(string $propertyName, Validator $validator): Chain;

    /** @return Chain<mixed> */
    public function propertyAllOf(string $propertyName, Validator $validator1, Validator $validator2, Validator ...$validators): Chain;

    /** @return Chain<mixed> */
    public function propertyAlnum(string $propertyName, string ...$additionalChars): Chain;

    /** @return Chain<mixed> */
    public function propertyAlpha(string $propertyName, string ...$additionalChars): Chain;

    /** @return Chain<mixed> */
    public function propertyAlwaysInvalid(string $propertyName): Chain;

    /** @return Chain<mixed> */
    public function propertyAlwaysValid(string $propertyName): Chain;

    /** @return Chain<mixed> */
    public function propertyAnyOf(string $propertyName, Validator $validator1, Validator $validator2, Validator ...$validators): Chain;

    /** @return Chain<mixed> */
    public function propertyArrayType(string $propertyName): Chain;

    /** @return Chain<mixed> */
    public function propertyArrayVal(string $propertyName): Chain;

    /** @return Chain<mixed> */
    public function propertyBase(string $propertyName, int $base, string $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'): Chain;

    /** @return Chain<mixed> */
    public function propertyBase64(string $propertyName): Chain;

    /** @return Chain<mixed> */
    public function propertyBetween(string $propertyName, mixed $minValue, mixed $maxValue): Chain;

    /** @return Chain<mixed> */
    public function propertyBetweenExclusive(string $propertyName, mixed $minimum, mixed $maximum): Chain;

    /** @return Chain<mixed> */
    public function propertyBlank(string $propertyName): Chain;

    /** @return Chain<mixed> */
    public function propertyBoolType(string $propertyName): Chain;

    /** @return Chain<mixed> */
    public function propertyBoolVal(string $propertyName): Chain;

    /** @return Chain<mixed> */
    public function propertyBsn(string $propertyName): Chain;

    /** @return Chain<mixed> */
    public function propertyCallableType(string $propertyName): Chain;

    /** @return Chain<mixed> */
    public function propertyCharset(string $propertyName, string $charset, string ...$charsets): Chain;

    /** @return Chain<mixed> */
    public function propertyCnh(string $propertyName): Chain;

    /** @return Chain<mixed> */
    public function propertyCnpj(string $propertyName): Chain;

    /** @return Chain<mixed> */
    public function propertyConsonant(string $propertyName, string ...$additionalChars): Chain;

    /** @return Chain<mixed> */
    public function propertyContains(string $propertyName, mixed $containsValue): Chain;

    /**
     * @param non-empty-array<mixed> $needles
     * @return Chain<mixed>
     */
    public function propertyContainsAny(string $propertyName, array $needles): Chain;

    /** @return Chain<mixed> */
    public function propertyContainsCount(string $propertyName, mixed $containsValue, int $count): Chain;

    /** @return Chain<mixed> */
    public function propertyControl(string $propertyName, string ...$additionalChars): Chain;

    /** @return Chain<mixed> */
    public function propertyCountable(string $propertyName): Chain;

    /**
     * @param "alpha-2"|"alpha-3"|"numeric" $set
     * @return Chain<mixed>
     */
    public function propertyCountryCode(string $propertyName, string $set = 'alpha-2'): Chain;

    /** @return Chain<mixed> */
    public function propertyCpf(string $propertyName): Chain;

    /** @return Chain<mixed> */
    public function propertyCreditCard(string $propertyName, string $brand = 'Any'): Chain;

    /**
     * @param "alpha-3"|"numeric" $set
     * @return Chain<mixed>
     */
    public function propertyCurrencyCode(string $propertyName, string $set = 'alpha-3'): Chain;

    /** @return Chain<mixed> */
    public function propertyDate(string $propertyName, string $format = 'Y-m-d'): Chain;

    /** @return Chain<mixed> */
    public function propertyDateTime(string $propertyName, string|null $format = null): Chain;

    /**
     * @param "years"|"months"|"days"|"hours"|"minutes"|"seconds"|"microseconds" $type
     * @return Chain<mixed>
     */
    public function propertyDateTimeDiff(string $propertyName, string $type, Validator $validator, string|null $format = null, DateTimeImmutable|null $now = null): Chain;

    /** @return Chain<mixed> */
    public function propertyDecimal(string $propertyName, int $decimals): Chain;

    /** @return Chain<mixed> */
    public function propertyDigit(string $propertyName, string ...$additionalChars): Chain;

    /** @return Chain<mixed> */
    public function propertyDirectory(string $propertyName): Chain;

    /** @return Chain<mixed> */
    public function propertyDomain(string $propertyName, bool $tldCheck = true): Chain;

    /** @return Chain<mixed> */
    public function propertyEach(string $propertyName, Validator $validator): Chain;

    /** @return Chain<mixed> */
    public function propertyEachKey(string $propertyName, Validator $validator): Chain;

    /** @return Chain<mixed> */
    public function propertyEmail(string $propertyName): Chain;

    /** @return Chain<mixed> */
    public function propertyEmoji(string $propertyName): Chain;

    /** @return Chain<mixed> */
    public function propertyEndsWith(string $propertyName, mixed $endValue, mixed ...$endValues): Chain;

    /** @return Chain<mixed> */
    public function propertyEquals(string $propertyName, mixed $compareTo): Chain;

    /** @return Chain<mixed> */
    public function propertyEquivalent(string $propertyName, mixed $compareTo): Chain;

    /** @return Chain<mixed> */
    public function propertyEven(string $propertyName): Chain;

    /** @return Chain<mixed> */
    public function propertyExecutable(string $propertyName): Chain;

    /** @return Chain<mixed> */
    public function propertyExtension(string $propertyName, string $extension): Chain;

    /** @return Chain<mixed> */
    public function propertyFactor(string $propertyName, int $dividend): Chain;

    /**
     * @param callable(mixed): Validator $factory
     * @return Chain<mixed>
     */
    public function propertyFactory(string $propertyName, callable $factory): Chain;

    /** @return Chain<mixed> */
    public function propertyFalseVal(string $propertyName): Chain;

    /** @return Chain<mixed> */
    public function propertyFalsy(string $propertyName): Chain;

    /** @return Chain<mixed> */
    public function propertyFile(string $propertyName): Chain;

    /** @return Chain<mixed> */
    public function propertyFinite(string $propertyName): Chain;

    /** @return Chain<mixed> */
    public function propertyFloatType(string $propertyName): Chain;

    /** @return Chain<mixed> */
    public function propertyFloatVal(string $propertyName): Chain;

    /** @return Chain<mixed> */
    public function propertyFormat(string $propertyName, Formatter $formatter): Chain;

    /** @return Chain<mixed> */
    public function propertyGiven(string $propertyName, Validator $when, Validator $then): Chain;

    /** @return Chain<mixed> */
    public function propertyGraph(string $propertyName, string ...$additionalChars): Chain;

    /** @return Chain<mixed> */
    public function propertyGreaterThan(string $propertyName, mixed $compareTo): Chain;

    /** @return Chain<mixed> */
    public function propertyGreaterThanOrEqual(string $propertyName, mixed $compareTo): Chain;

    /** @return Chain<mixed> */
    public function propertyHetu(string $propertyName): Chain;

    /** @return Chain<mixed> */
    public function propertyHexRgbColor(string $propertyName): Chain;

    /** @return Chain<mixed> */
    public function propertyIban(string $propertyName): Chain;

    /** @return Chain<mixed> */
    public function propertyIdentical(string $propertyName, mixed $compareTo): Chain;

    /** @return Chain<mixed> */
    public function propertyImage(string $propertyName): Chain;

    /** @return Chain<mixed> */
    public function propertyImei(string $propertyName): Chain;

    /** @return Chain<mixed> */
    public function propertyIn(string $propertyName, mixed $haystack): Chain;

    /** @return Chain<mixed> */
    public function propertyInfinite(string $propertyName): Chain;

    /**
     * @param class-string $class
     * @return Chain<mixed>
     */
    public function propertyInstance(string $propertyName, string $class): Chain;

    /** @return Chain<mixed> */
    public function propertyIntType(string $propertyName): Chain;

    /** @return Chain<mixed> */
    public function propertyIntVal(string $propertyName): Chain;

    /** @return Chain<mixed> */
    public function propertyIp(string $propertyName, string $range = '*', int|null $options = null): Chain;

    /** @return Chain<mixed> */
    public function propertyIsbn(string $propertyName): Chain;

    /** @return Chain<mixed> */
    public function propertyIterableType(string $propertyName): Chain;

    /** @return Chain<mixed> */
    public function propertyIterableVal(string $propertyName): Chain;

    /** @return Chain<mixed> */
    public function propertyJson(string $propertyName): Chain;

    /**
     * @param "alpha-2"|"alpha-3" $set
     * @return Chain<mixed>
     */
    public function propertyLanguageCode(string $propertyName, string $set = 'alpha-2'): Chain;

    /** @return Chain<mixed> */
    public function propertyLeapDate(string $propertyName, string $format): Chain;

    /** @return Chain<mixed> */
    public function propertyLeapYear(string $propertyName): Chain;

    /** @return Chain<mixed> */
    public function propertyLength(string $propertyName, Validator $validator): Chain;

    /** @return Chain<mixed> */
    public function propertyLessThan(string $propertyName, mixed $compareTo): Chain;

    /** @return Chain<mixed> */
    public function propertyLessThanOrEqual(string $propertyName, mixed $compareTo): Chain;

    /** @return Chain<mixed> */
    public function propertyLowercase(string $propertyName): Chain;

    /** @return Chain<mixed> */
    public function propertyLuhn(string $propertyName): Chain;

    /** @return Chain<mixed> */
    public function propertyMacAddress(string $propertyName): Chain;

    /** @return Chain<mixed> */
    public function propertyMax(string $propertyName, Validator $validator): Chain;

    /** @return Chain<mixed> */
    public function propertyMimetype(string $propertyName, string $mimetype): Chain;

    /** @return Chain<mixed> */
    public function propertyMin(string $propertyName, Validator $validator): Chain;

    /** @return Chain<mixed> */
    public function propertyMultiple(string $propertyName, int $multipleOf): Chain;

    /** @return Chain<mixed> */
    public function propertyNegative(string $propertyName): Chain;

    /** @return Chain<mixed> */
    public function propertyNfeAccessKey(string $propertyName): Chain;

    /** @return Chain<mixed> */
    public function propertyNif(string $propertyName): Chain;

    /** @return Chain<mixed> */
    public function propertyNip(string $propertyName): Chain;

    /** @return Chain<mixed> */
    public function propertyNoneOf(string $propertyName, Validator $validator1, Validator $validator2, Validator ...$validators): Chain;

    /** @return Chain<mixed> */
    public function propertyNot(string $propertyName, Validator $validator): Chain;

    /** @return Chain<mixed> */
    public function propertyNullType(string $propertyName): Chain;

    /** @return Chain<mixed> */
    public function propertyNumber(string $propertyName): Chain;

    /** @return Chain<mixed> */
    public function propertyNumericVal(string $propertyName): Chain;

    /** @return Chain<mixed> */
    public function propertyObjectType(string $propertyName): Chain;

    /** @return Chain<mixed> */
    public function propertyOdd(string $propertyName): Chain;

    /** @return Chain<mixed> */
    public function propertyOneOf(string $propertyName, Validator $validator1, Validator $validator2, Validator ...$validators): Chain;

    /** @return Chain<mixed> */
    public function propertyPesel(string $propertyName): Chain;

    /** @return Chain<mixed> */
    public function propertyPhone(string $propertyName, string|null $countryCode = null): Chain;

    /** @return Chain<mixed> */
    public function propertyPis(string $propertyName): Chain;

    /** @return Chain<mixed> */
    public function propertyPolishIdCard(string $propertyName): Chain;

    /** @return Chain<mixed> */
    public function propertyPortugueseNif(string $propertyName): Chain;

    /** @return Chain<mixed> */
    public function propertyPositive(string $propertyName): Chain;

    /** @return Chain<mixed> */
    public function propertyPostalCode(string $propertyName, string $countryCode, bool $formatted = false): Chain;

    /** @return Chain<mixed> */
    public function propertyPrintable(string $propertyName, string ...$additionalChars): Chain;

    /** @return Chain<mixed> */
    public function propertyPublicDomainSuffix(string $propertyName): Chain;

    /** @return Chain<mixed> */
    public function propertyPunct(string $propertyName, string ...$additionalChars): Chain;

    /** @return Chain<mixed> */
    public function propertyReadable(string $propertyName): Chain;

    /** @return Chain<mixed> */
    public function propertyRegex(string $propertyName, string $regex): Chain;

    /** @return Chain<mixed> */
    public function propertyResourceType(string $propertyName): Chain;

    /** @return Chain<mixed> */
    public function propertyRoman(string $propertyName): Chain;

    /** @return Chain<mixed> */
    public function propertySatisfies(string $propertyName, callable $callback, mixed ...$arguments): Chain;

    /** @return Chain<mixed> */
    public function propertyScalarVal(string $propertyName): Chain;

    /** @return Chain<mixed> */
    public function propertyShortCircuit(string $propertyName, Validator ...$validators): Chain;

    /**
     * @param "B"|"KB"|"MB"|"GB"|"TB"|"PB"|"EB"|"ZB"|"YB" $unit
     * @return Chain<mixed>
     */
    public function propertySize(string $propertyName, string $unit, Validator $validator): Chain;

    /** @return Chain<mixed> */
    public function propertySlug(string $propertyName): Chain;

    /** @return Chain<mixed> */
    public function propertySorted(string $propertyName, string $direction): Chain;

    /** @return Chain<mixed> */
    public function propertySpace(string $propertyName, string ...$additionalChars): Chain;

    /** @return Chain<mixed> */
    public function propertySpaced(string $propertyName): Chain;

    /** @return Chain<mixed> */
    public function propertyStartsWith(string $propertyName, mixed $startValue, mixed ...$startValues): Chain;

    /** @return Chain<mixed> */
    public function propertyStringType(string $propertyName): Chain;

    /** @return Chain<mixed> */
    public function propertyStringVal(string $propertyName): Chain;

    /** @return Chain<mixed> */
    public function propertySubdivisionCode(string $propertyName, string $countryCode): Chain;

    /**
     * @param mixed[] $superset
     * @return Chain<mixed>
     */
    public function propertySubset(string $propertyName, array $superset): Chain;

    /** @return Chain<mixed> */
    public function propertySymbolicLink(string $propertyName): Chain;

    /** @return Chain<mixed> */
    public function propertyTime(string $propertyName, string $format = 'H:i:s'): Chain;

    /** @return Chain<mixed> */
    public function propertyTld(string $propertyName): Chain;

    /** @return Chain<mixed> */
    public function propertyTrimmed(string $propertyName, string ...$trimValues): Chain;

    /** @return Chain<mixed> */
    public function propertyTrueVal(string $propertyName): Chain;

    /** @return Chain<mixed> */
    public function propertyUndef(string $propertyName): Chain;

    /** @return Chain<mixed> */
    public function propertyUnique(string $propertyName): Chain;

    /** @return Chain<mixed> */
    public function propertyUppercase(string $propertyName): Chain;

    /** @return Chain<mixed> */
    public function propertyUrl(string $propertyName): Chain;

    /** @return Chain<mixed> */
    public function propertyUuid(string $propertyName, int|null $version = null): Chain;

    /** @return Chain<mixed> */
    public function propertyVersion(string $propertyName): Chain;

    /** @return Chain<mixed> */
    public function propertyVowel(string $propertyName, string ...$additionalChars): Chain;

    /** @return Chain<mixed> */
    public function propertyWhen(string $propertyName, Validator $when, Validator $then, Validator|null $else = null): Chain;

    /** @return Chain<mixed> */
    public function propertyWritable(string $propertyName): Chain;

    /** @return Chain<mixed> */
    public function propertyXdigit(string $propertyName, string ...$additionalChars): Chain;
}
