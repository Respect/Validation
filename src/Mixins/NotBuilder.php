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

interface NotBuilder
{
    /** @return Chain<mixed> */
    public static function notAfter(callable $callable, Validator $validator): Chain;

    /** @return Chain<mixed> */
    public static function notAll(Validator $validator): Chain;

    /** @return Chain<mixed> */
    public static function notAllOf(Validator $validator1, Validator $validator2, Validator ...$validators): Chain;

    /** @return Chain<mixed> */
    public static function notAlnum(string ...$additionalChars): Chain;

    /** @return Chain<mixed> */
    public static function notAlpha(string ...$additionalChars): Chain;

    /** @return Chain<mixed> */
    public static function notAlwaysInvalid(): Chain;

    /** @return Chain<mixed> */
    public static function notAlwaysValid(): Chain;

    /** @return Chain<mixed> */
    public static function notAnyOf(Validator $validator1, Validator $validator2, Validator ...$validators): Chain;

    /** @return Chain<mixed> */
    public static function notArrayType(): Chain;

    /** @return Chain<mixed> */
    public static function notArrayVal(): Chain;

    /** @return Chain<mixed> */
    public static function notBase(int $base, string $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'): Chain;

    /** @return Chain<mixed> */
    public static function notBase64(): Chain;

    /** @return Chain<mixed> */
    public static function notBetween(mixed $minValue, mixed $maxValue): Chain;

    /** @return Chain<mixed> */
    public static function notBetweenExclusive(mixed $minimum, mixed $maximum): Chain;

    /** @return Chain<mixed> */
    public static function notBlank(): Chain;

    /** @return Chain<mixed> */
    public static function notBoolType(): Chain;

    /** @return Chain<mixed> */
    public static function notBoolVal(): Chain;

    /** @return Chain<mixed> */
    public static function notBsn(): Chain;

    /** @return Chain<mixed> */
    public static function notCallableType(): Chain;

    /** @return Chain<mixed> */
    public static function notCharset(string $charset, string ...$charsets): Chain;

    /** @return Chain<mixed> */
    public static function notCnh(): Chain;

    /** @return Chain<mixed> */
    public static function notCnpj(): Chain;

    /** @return Chain<mixed> */
    public static function notConsonant(string ...$additionalChars): Chain;

    /** @return Chain<mixed> */
    public static function notContains(mixed $containsValue): Chain;

    /**
     * @param non-empty-array<mixed> $needles
     * @return Chain<mixed>
     */
    public static function notContainsAny(array $needles): Chain;

    /** @return Chain<mixed> */
    public static function notContainsCount(mixed $containsValue, int $count): Chain;

    /** @return Chain<mixed> */
    public static function notControl(string ...$additionalChars): Chain;

    /** @return Chain<mixed> */
    public static function notCountable(): Chain;

    /**
     * @param "alpha-2"|"alpha-3"|"numeric" $set
     * @return Chain<mixed>
     */
    public static function notCountryCode(string $set = 'alpha-2'): Chain;

    /** @return Chain<mixed> */
    public static function notCpf(): Chain;

    /** @return Chain<mixed> */
    public static function notCreditCard(string $brand = 'Any'): Chain;

    /**
     * @param "alpha-3"|"numeric" $set
     * @return Chain<mixed>
     */
    public static function notCurrencyCode(string $set = 'alpha-3'): Chain;

    /** @return Chain<mixed> */
    public static function notDate(string $format = 'Y-m-d'): Chain;

    /** @return Chain<mixed> */
    public static function notDateTime(string|null $format = null): Chain;

    /**
     * @param "years"|"months"|"days"|"hours"|"minutes"|"seconds"|"microseconds" $type
     * @return Chain<mixed>
     */
    public static function notDateTimeDiff(string $type, Validator $validator, string|null $format = null, DateTimeImmutable|null $now = null): Chain;

    /** @return Chain<mixed> */
    public static function notDecimal(int $decimals): Chain;

    /** @return Chain<mixed> */
    public static function notDigit(string ...$additionalChars): Chain;

    /** @return Chain<mixed> */
    public static function notDirectory(): Chain;

    /** @return Chain<mixed> */
    public static function notDomain(bool $tldCheck = true): Chain;

    /** @return Chain<mixed> */
    public static function notEach(Validator $validator): Chain;

    /** @return Chain<mixed> */
    public static function notEachKey(Validator $validator): Chain;

    /** @return Chain<mixed> */
    public static function notEmail(): Chain;

    /** @return Chain<mixed> */
    public static function notEmoji(): Chain;

    /** @return Chain<mixed> */
    public static function notEndsWith(mixed $endValue, mixed ...$endValues): Chain;

    /** @return Chain<mixed> */
    public static function notEquals(mixed $compareTo): Chain;

    /** @return Chain<mixed> */
    public static function notEquivalent(mixed $compareTo): Chain;

    /** @return Chain<mixed> */
    public static function notEven(): Chain;

    /** @return Chain<mixed> */
    public static function notExecutable(): Chain;

    /** @return Chain<mixed> */
    public static function notExists(): Chain;

    /** @return Chain<mixed> */
    public static function notExtension(string $extension): Chain;

    /** @return Chain<mixed> */
    public static function notFactor(int $dividend): Chain;

    /**
     * @param callable(mixed): Validator $factory
     * @return Chain<mixed>
     */
    public static function notFactory(callable $factory): Chain;

    /** @return Chain<mixed> */
    public static function notFalseVal(): Chain;

    /** @return Chain<mixed> */
    public static function notFalsy(): Chain;

    /** @return Chain<mixed> */
    public static function notFile(): Chain;

    /** @return Chain<mixed> */
    public static function notFinite(): Chain;

    /** @return Chain<mixed> */
    public static function notFloatType(): Chain;

    /** @return Chain<mixed> */
    public static function notFloatVal(): Chain;

    /** @return Chain<mixed> */
    public static function notFormat(Formatter $formatter): Chain;

    /** @return Chain<mixed> */
    public static function notFormatted(Formatter $formatter, Validator $validator): Chain;

    /** @return Chain<mixed> */
    public static function notGiven(Validator $when, Validator $then): Chain;

    /** @return Chain<mixed> */
    public static function notGraph(string ...$additionalChars): Chain;

    /** @return Chain<mixed> */
    public static function notGreaterThan(mixed $compareTo): Chain;

    /** @return Chain<mixed> */
    public static function notGreaterThanOrEqual(mixed $compareTo): Chain;

    /** @return Chain<mixed> */
    public static function notHetu(): Chain;

    /** @return Chain<mixed> */
    public static function notHexRgbColor(): Chain;

    /** @return Chain<mixed> */
    public static function notIban(): Chain;

    /** @return Chain<mixed> */
    public static function notIdentical(mixed $compareTo): Chain;

    /** @return Chain<mixed> */
    public static function notImage(): Chain;

    /** @return Chain<mixed> */
    public static function notImei(): Chain;

    /** @return Chain<mixed> */
    public static function notIn(mixed $haystack): Chain;

    /** @return Chain<mixed> */
    public static function notInfinite(): Chain;

    /**
     * @param class-string $class
     * @return Chain<mixed>
     */
    public static function notInstance(string $class): Chain;

    /** @return Chain<mixed> */
    public static function notIntType(): Chain;

    /** @return Chain<mixed> */
    public static function notIntVal(): Chain;

    /** @return Chain<mixed> */
    public static function notIp(string $range = '*', int|null $options = null): Chain;

    /** @return Chain<mixed> */
    public static function notIsbn(): Chain;

    /** @return Chain<mixed> */
    public static function notIterableType(): Chain;

    /** @return Chain<mixed> */
    public static function notIterableVal(): Chain;

    /** @return Chain<mixed> */
    public static function notJson(): Chain;

    /** @return Chain<mixed> */
    public static function notKey(int|string $key, Validator $validator): Chain;

    /** @return Chain<mixed> */
    public static function notKeyExists(int|string $key): Chain;

    /** @return Chain<mixed> */
    public static function notKeyOptional(int|string $key, Validator $validator): Chain;

    /** @return Chain<mixed> */
    public static function notKeySet(Validator $validator, Validator ...$validators): Chain;

    /**
     * @param "alpha-2"|"alpha-3" $set
     * @return Chain<mixed>
     */
    public static function notLanguageCode(string $set = 'alpha-2'): Chain;

    /** @return Chain<mixed> */
    public static function notLeapDate(string $format): Chain;

    /** @return Chain<mixed> */
    public static function notLeapYear(): Chain;

    /** @return Chain<mixed> */
    public static function notLength(Validator $validator): Chain;

    /** @return Chain<mixed> */
    public static function notLessThan(mixed $compareTo): Chain;

    /** @return Chain<mixed> */
    public static function notLessThanOrEqual(mixed $compareTo): Chain;

    /** @return Chain<mixed> */
    public static function notLowercase(): Chain;

    /** @return Chain<mixed> */
    public static function notLuhn(): Chain;

    /** @return Chain<mixed> */
    public static function notMacAddress(): Chain;

    /** @return Chain<mixed> */
    public static function notMax(Validator $validator): Chain;

    /** @return Chain<mixed> */
    public static function notMimetype(string $mimetype): Chain;

    /** @return Chain<mixed> */
    public static function notMin(Validator $validator): Chain;

    /** @return Chain<mixed> */
    public static function notMultiple(int $multipleOf): Chain;

    /** @return Chain<mixed> */
    public static function notNegative(): Chain;

    /** @return Chain<mixed> */
    public static function notNfeAccessKey(): Chain;

    /** @return Chain<mixed> */
    public static function notNif(): Chain;

    /** @return Chain<mixed> */
    public static function notNip(): Chain;

    /** @return Chain<mixed> */
    public static function notNoneOf(Validator $validator1, Validator $validator2, Validator ...$validators): Chain;

    /** @return Chain<mixed> */
    public static function notNullType(): Chain;

    /** @return Chain<mixed> */
    public static function notNumber(): Chain;

    /** @return Chain<mixed> */
    public static function notNumericVal(): Chain;

    /** @return Chain<mixed> */
    public static function notObjectType(): Chain;

    /** @return Chain<mixed> */
    public static function notOdd(): Chain;

    /** @return Chain<mixed> */
    public static function notOneOf(Validator $validator1, Validator $validator2, Validator ...$validators): Chain;

    /** @return Chain<mixed> */
    public static function notPesel(): Chain;

    /** @return Chain<mixed> */
    public static function notPhone(string|null $countryCode = null): Chain;

    /** @return Chain<mixed> */
    public static function notPis(): Chain;

    /** @return Chain<mixed> */
    public static function notPolishIdCard(): Chain;

    /** @return Chain<mixed> */
    public static function notPortugueseNif(): Chain;

    /** @return Chain<mixed> */
    public static function notPositive(): Chain;

    /** @return Chain<mixed> */
    public static function notPostalCode(string $countryCode, bool $formatted = false): Chain;

    /** @return Chain<mixed> */
    public static function notPrintable(string ...$additionalChars): Chain;

    /** @return Chain<mixed> */
    public static function notProperty(string $propertyName, Validator $validator): Chain;

    /** @return Chain<mixed> */
    public static function notPropertyExists(string $propertyName): Chain;

    /** @return Chain<mixed> */
    public static function notPropertyOptional(string $propertyName, Validator $validator): Chain;

    /** @return Chain<mixed> */
    public static function notPublicDomainSuffix(): Chain;

    /** @return Chain<mixed> */
    public static function notPunct(string ...$additionalChars): Chain;

    /** @return Chain<mixed> */
    public static function notReadable(): Chain;

    /** @return Chain<mixed> */
    public static function notRegex(string $regex): Chain;

    /** @return Chain<mixed> */
    public static function notResourceType(): Chain;

    /** @return Chain<mixed> */
    public static function notRoman(): Chain;

    /** @return Chain<mixed> */
    public static function notSatisfies(callable $callback, mixed ...$arguments): Chain;

    /** @return Chain<mixed> */
    public static function notScalarVal(): Chain;

    /** @return Chain<mixed> */
    public static function notShortCircuit(Validator ...$validators): Chain;

    /**
     * @param "B"|"KB"|"MB"|"GB"|"TB"|"PB"|"EB"|"ZB"|"YB" $unit
     * @return Chain<mixed>
     */
    public static function notSize(string $unit, Validator $validator): Chain;

    /** @return Chain<mixed> */
    public static function notSlug(): Chain;

    /** @return Chain<mixed> */
    public static function notSorted(string $direction): Chain;

    /** @return Chain<mixed> */
    public static function notSpace(string ...$additionalChars): Chain;

    /** @return Chain<mixed> */
    public static function notSpaced(): Chain;

    /** @return Chain<mixed> */
    public static function notStartsWith(mixed $startValue, mixed ...$startValues): Chain;

    /** @return Chain<mixed> */
    public static function notStringType(): Chain;

    /** @return Chain<mixed> */
    public static function notStringVal(): Chain;

    /** @return Chain<mixed> */
    public static function notSubdivisionCode(string $countryCode): Chain;

    /**
     * @param mixed[] $superset
     * @return Chain<mixed>
     */
    public static function notSubset(array $superset): Chain;

    /** @return Chain<mixed> */
    public static function notSymbolicLink(): Chain;

    /** @return Chain<mixed> */
    public static function notTime(string $format = 'H:i:s'): Chain;

    /** @return Chain<mixed> */
    public static function notTld(): Chain;

    /** @return Chain<mixed> */
    public static function notTrimmed(string ...$trimValues): Chain;

    /** @return Chain<mixed> */
    public static function notTrueVal(): Chain;

    /** @return Chain<mixed> */
    public static function notUndef(): Chain;

    /** @return Chain<mixed> */
    public static function notUnique(): Chain;

    /** @return Chain<mixed> */
    public static function notUppercase(): Chain;

    /** @return Chain<mixed> */
    public static function notUrl(): Chain;

    /** @return Chain<mixed> */
    public static function notUuid(int|null $version = null): Chain;

    /** @return Chain<mixed> */
    public static function notVersion(): Chain;

    /** @return Chain<mixed> */
    public static function notVowel(string ...$additionalChars): Chain;

    /** @return Chain<mixed> */
    public static function notWhen(Validator $when, Validator $then, Validator|null $else = null): Chain;

    /** @return Chain<mixed> */
    public static function notWritable(): Chain;

    /** @return Chain<mixed> */
    public static function notXdigit(string ...$additionalChars): Chain;
}
