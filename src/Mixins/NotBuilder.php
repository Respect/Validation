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
use Respect\Validation\Validator;

interface NotBuilder
{
    public static function notAfter(callable $callable, Validator $validator): Chain;

    public static function notAll(Validator $validator): Chain;

    public static function notAllOf(Validator $validator1, Validator $validator2, Validator ...$validators): Chain;

    public static function notAlnum(string ...$additionalChars): Chain;

    public static function notAlpha(string ...$additionalChars): Chain;

    public static function notAlwaysInvalid(): Chain;

    public static function notAlwaysValid(): Chain;

    public static function notAnyOf(Validator $validator1, Validator $validator2, Validator ...$validators): Chain;

    public static function notArrayType(): Chain;

    public static function notArrayVal(): Chain;

    public static function notBase(int $base, string $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'): Chain;

    public static function notBase64(): Chain;

    public static function notBetween(mixed $minValue, mixed $maxValue): Chain;

    public static function notBetweenExclusive(mixed $minimum, mixed $maximum): Chain;

    public static function notBlank(): Chain;

    public static function notBoolType(): Chain;

    public static function notBoolVal(): Chain;

    public static function notBsn(): Chain;

    public static function notCallableType(): Chain;

    public static function notCharset(string $charset, string ...$charsets): Chain;

    public static function notCircuit(Validator $validator1, Validator $validator2, Validator ...$validators): Chain;

    public static function notCnh(): Chain;

    public static function notCnpj(): Chain;

    public static function notConsonant(string ...$additionalChars): Chain;

    public static function notContains(mixed $containsValue): Chain;

    /** @param non-empty-array<mixed> $needles */
    public static function notContainsAny(array $needles): Chain;

    public static function notContainsCount(mixed $containsValue, int $count): Chain;

    public static function notControl(string ...$additionalChars): Chain;

    public static function notCountable(): Chain;

    /** @param "alpha-2"|"alpha-3"|"numeric" $set */
    public static function notCountryCode(string $set = 'alpha-2'): Chain;

    public static function notCpf(): Chain;

    public static function notCreditCard(string $brand = 'Any'): Chain;

    /** @param "alpha-3"|"numeric" $set */
    public static function notCurrencyCode(string $set = 'alpha-3'): Chain;

    public static function notDate(string $format = 'Y-m-d'): Chain;

    public static function notDateTime(string|null $format = null): Chain;

    /** @param "years"|"months"|"days"|"hours"|"minutes"|"seconds"|"microseconds" $type */
    public static function notDateTimeDiff(string $type, Validator $validator, string|null $format = null, DateTimeImmutable|null $now = null): Chain;

    public static function notDecimal(int $decimals): Chain;

    public static function notDigit(string ...$additionalChars): Chain;

    public static function notDirectory(): Chain;

    public static function notDomain(bool $tldCheck = true): Chain;

    public static function notEach(Validator $validator): Chain;

    public static function notEmail(): Chain;

    public static function notEmoji(): Chain;

    public static function notEndsWith(mixed $endValue): Chain;

    public static function notEquals(mixed $compareTo): Chain;

    public static function notEquivalent(mixed $compareTo): Chain;

    public static function notEven(): Chain;

    public static function notExecutable(): Chain;

    public static function notExists(): Chain;

    public static function notExtension(string $extension): Chain;

    public static function notFactor(int $dividend): Chain;

    /** @param callable(mixed): Validator $factory */
    public static function notFactory(callable $factory): Chain;

    public static function notFalseVal(): Chain;

    public static function notFalsy(): Chain;

    public static function notFile(): Chain;

    public static function notFinite(): Chain;

    public static function notFloatType(): Chain;

    public static function notFloatVal(): Chain;

    public static function notGraph(string ...$additionalChars): Chain;

    public static function notGreaterThan(mixed $compareTo): Chain;

    public static function notGreaterThanOrEqual(mixed $compareTo): Chain;

    public static function notHetu(): Chain;

    public static function notHexRgbColor(): Chain;

    public static function notIban(): Chain;

    public static function notIdentical(mixed $compareTo): Chain;

    public static function notImage(): Chain;

    public static function notImei(): Chain;

    public static function notIn(mixed $haystack): Chain;

    public static function notInfinite(): Chain;

    /** @param class-string $class */
    public static function notInstance(string $class): Chain;

    public static function notIntType(): Chain;

    public static function notIntVal(): Chain;

    public static function notIp(string $range = '*', int|null $options = null): Chain;

    public static function notIsbn(): Chain;

    public static function notIterableType(): Chain;

    public static function notIterableVal(): Chain;

    public static function notJson(): Chain;

    public static function notKey(string|int $key, Validator $validator): Chain;

    public static function notKeyExists(string|int $key): Chain;

    public static function notKeyOptional(string|int $key, Validator $validator): Chain;

    public static function notKeySet(Validator $validator, Validator ...$validators): Chain;

    /** @param "alpha-2"|"alpha-3" $set */
    public static function notLanguageCode(string $set = 'alpha-2'): Chain;

    public static function notLeapDate(string $format): Chain;

    public static function notLeapYear(): Chain;

    public static function notLength(Validator $validator): Chain;

    public static function notLessThan(mixed $compareTo): Chain;

    public static function notLessThanOrEqual(mixed $compareTo): Chain;

    public static function notLowercase(): Chain;

    public static function notLuhn(): Chain;

    public static function notMacAddress(): Chain;

    public static function notMasked(string $range, Validator $validator, string $replacement = '*'): Chain;

    public static function notMax(Validator $validator): Chain;

    public static function notMimetype(string $mimetype): Chain;

    public static function notMin(Validator $validator): Chain;

    public static function notMultiple(int $multipleOf): Chain;

    public static function notNegative(): Chain;

    public static function notNfeAccessKey(): Chain;

    public static function notNif(): Chain;

    public static function notNip(): Chain;

    public static function notNoneOf(Validator $validator1, Validator $validator2, Validator ...$validators): Chain;

    public static function notNullType(): Chain;

    public static function notNumber(): Chain;

    public static function notNumericVal(): Chain;

    public static function notObjectType(): Chain;

    public static function notOdd(): Chain;

    public static function notOneOf(Validator $validator1, Validator $validator2, Validator ...$validators): Chain;

    public static function notPesel(): Chain;

    public static function notPhone(string|null $countryCode = null): Chain;

    public static function notPis(): Chain;

    public static function notPolishIdCard(): Chain;

    public static function notPortugueseNif(): Chain;

    public static function notPositive(): Chain;

    public static function notPostalCode(string $countryCode, bool $formatted = false): Chain;

    public static function notPrintable(string ...$additionalChars): Chain;

    public static function notProperty(string $propertyName, Validator $validator): Chain;

    public static function notPropertyExists(string $propertyName): Chain;

    public static function notPropertyOptional(string $propertyName, Validator $validator): Chain;

    public static function notPublicDomainSuffix(): Chain;

    public static function notPunct(string ...$additionalChars): Chain;

    public static function notReadable(): Chain;

    public static function notRegex(string $regex): Chain;

    public static function notResourceType(): Chain;

    public static function notRoman(): Chain;

    public static function notSatisfies(callable $callback, mixed ...$arguments): Chain;

    public static function notScalarVal(): Chain;

    /** @param "B"|"KB"|"MB"|"GB"|"TB"|"PB"|"EB"|"ZB"|"YB" $unit */
    public static function notSize(string $unit, Validator $validator): Chain;

    public static function notSlug(): Chain;

    public static function notSorted(string $direction): Chain;

    public static function notSpace(string ...$additionalChars): Chain;

    public static function notSpaced(): Chain;

    public static function notStartsWith(mixed $startValue): Chain;

    public static function notStringType(): Chain;

    public static function notStringVal(): Chain;

    public static function notSubdivisionCode(string $countryCode): Chain;

    /** @param mixed[] $superset */
    public static function notSubset(array $superset): Chain;

    public static function notSymbolicLink(): Chain;

    public static function notTime(string $format = 'H:i:s'): Chain;

    public static function notTld(): Chain;

    public static function notTrueVal(): Chain;

    public static function notUndef(): Chain;

    public static function notUnique(): Chain;

    public static function notUppercase(): Chain;

    public static function notUrl(): Chain;

    public static function notUuid(int|null $version = null): Chain;

    public static function notVersion(): Chain;

    public static function notVowel(string ...$additionalChars): Chain;

    public static function notWhen(Validator $when, Validator $then, Validator|null $else = null): Chain;

    public static function notWritable(): Chain;

    public static function notXdigit(string ...$additionalChars): Chain;
}
