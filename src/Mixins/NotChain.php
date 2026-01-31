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

interface NotChain
{
    public function notAll(Validator $validator): Chain;

    public function notAllOf(Validator $validator1, Validator $validator2, Validator ...$validators): Chain;

    public function notAlnum(string ...$additionalChars): Chain;

    public function notAlpha(string ...$additionalChars): Chain;

    public function notAlwaysInvalid(): Chain;

    public function notAlwaysValid(): Chain;

    public function notAnyOf(Validator $validator1, Validator $validator2, Validator ...$validators): Chain;

    public function notArrayType(): Chain;

    public function notArrayVal(): Chain;

    public function notBase(int $base, string $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'): Chain;

    public function notBase64(): Chain;

    public function notBetween(mixed $minValue, mixed $maxValue): Chain;

    public function notBetweenExclusive(mixed $minimum, mixed $maximum): Chain;

    public function notBlank(): Chain;

    public function notBoolType(): Chain;

    public function notBoolVal(): Chain;

    public function notBsn(): Chain;

    public function notCall(callable $callable, Validator $validator): Chain;

    public function notCallableType(): Chain;

    public function notCharset(string $charset, string ...$charsets): Chain;

    public function notCircuit(Validator $validator1, Validator $validator2, Validator ...$validators): Chain;

    public function notCnh(): Chain;

    public function notCnpj(): Chain;

    public function notConsonant(string ...$additionalChars): Chain;

    public function notContains(mixed $containsValue): Chain;

    /** @param non-empty-array<mixed> $needles */
    public function notContainsAny(array $needles): Chain;

    public function notContainsCount(mixed $containsValue, int $count): Chain;

    public function notControl(string ...$additionalChars): Chain;

    public function notCountable(): Chain;

    /** @param "alpha-2"|"alpha-3"|"numeric" $set */
    public function notCountryCode(string $set = 'alpha-2'): Chain;

    public function notCpf(): Chain;

    public function notCreditCard(string $brand = 'Any'): Chain;

    /** @param "alpha-3"|"numeric" $set */
    public function notCurrencyCode(string $set = 'alpha-3'): Chain;

    public function notDate(string $format = 'Y-m-d'): Chain;

    public function notDateTime(string|null $format = null): Chain;

    /** @param "years"|"months"|"days"|"hours"|"minutes"|"seconds"|"microseconds" $type */
    public function notDateTimeDiff(string $type, Validator $validator, string|null $format = null, DateTimeImmutable|null $now = null): Chain;

    public function notDecimal(int $decimals): Chain;

    public function notDigit(string ...$additionalChars): Chain;

    public function notDirectory(): Chain;

    public function notDomain(bool $tldCheck = true): Chain;

    public function notEach(Validator $validator): Chain;

    public function notEmail(): Chain;

    public function notEmoji(): Chain;

    public function notEndsWith(mixed $endValue): Chain;

    public function notEquals(mixed $compareTo): Chain;

    public function notEquivalent(mixed $compareTo): Chain;

    public function notEven(): Chain;

    public function notExecutable(): Chain;

    public function notExists(): Chain;

    public function notExtension(string $extension): Chain;

    public function notFactor(int $dividend): Chain;

    /** @param callable(mixed): Validator $factory */
    public function notFactory(callable $factory): Chain;

    public function notFalseVal(): Chain;

    public function notFalsy(): Chain;

    public function notFile(): Chain;

    public function notFinite(): Chain;

    public function notFloatType(): Chain;

    public function notFloatVal(): Chain;

    public function notGraph(string ...$additionalChars): Chain;

    public function notGreaterThan(mixed $compareTo): Chain;

    public function notGreaterThanOrEqual(mixed $compareTo): Chain;

    public function notHetu(): Chain;

    public function notHexRgbColor(): Chain;

    public function notIban(): Chain;

    public function notIdentical(mixed $compareTo): Chain;

    public function notImage(): Chain;

    public function notImei(): Chain;

    public function notIn(mixed $haystack): Chain;

    public function notInfinite(): Chain;

    /** @param class-string $class */
    public function notInstance(string $class): Chain;

    public function notIntType(): Chain;

    public function notIntVal(): Chain;

    public function notIp(string $range = '*', int|null $options = null): Chain;

    public function notIsbn(): Chain;

    public function notIterableType(): Chain;

    public function notIterableVal(): Chain;

    public function notJson(): Chain;

    public function notKey(string|int $key, Validator $validator): Chain;

    public function notKeyExists(string|int $key): Chain;

    public function notKeyOptional(string|int $key, Validator $validator): Chain;

    public function notKeySet(Validator $validator, Validator ...$validators): Chain;

    /** @param "alpha-2"|"alpha-3" $set */
    public function notLanguageCode(string $set = 'alpha-2'): Chain;

    public function notLeapDate(string $format): Chain;

    public function notLeapYear(): Chain;

    public function notLength(Validator $validator): Chain;

    public function notLessThan(mixed $compareTo): Chain;

    public function notLessThanOrEqual(mixed $compareTo): Chain;

    public function notLowercase(): Chain;

    public function notLuhn(): Chain;

    public function notMacAddress(): Chain;

    public function notMasked(string $range, Validator $validator, string $replacement = '*'): Chain;

    public function notMax(Validator $validator): Chain;

    public function notMimetype(string $mimetype): Chain;

    public function notMin(Validator $validator): Chain;

    public function notMultiple(int $multipleOf): Chain;

    public function notNegative(): Chain;

    public function notNfeAccessKey(): Chain;

    public function notNif(): Chain;

    public function notNip(): Chain;

    public function notNoneOf(Validator $validator1, Validator $validator2, Validator ...$validators): Chain;

    public function notNullType(): Chain;

    public function notNumber(): Chain;

    public function notNumericVal(): Chain;

    public function notObjectType(): Chain;

    public function notOdd(): Chain;

    public function notOneOf(Validator $validator1, Validator $validator2, Validator ...$validators): Chain;

    public function notPesel(): Chain;

    public function notPhone(string|null $countryCode = null): Chain;

    public function notPis(): Chain;

    public function notPolishIdCard(): Chain;

    public function notPortugueseNif(): Chain;

    public function notPositive(): Chain;

    public function notPostalCode(string $countryCode, bool $formatted = false): Chain;

    public function notPrintable(string ...$additionalChars): Chain;

    public function notProperty(string $propertyName, Validator $validator): Chain;

    public function notPropertyExists(string $propertyName): Chain;

    public function notPropertyOptional(string $propertyName, Validator $validator): Chain;

    public function notPublicDomainSuffix(): Chain;

    public function notPunct(string ...$additionalChars): Chain;

    public function notReadable(): Chain;

    public function notRegex(string $regex): Chain;

    public function notResourceType(): Chain;

    public function notRoman(): Chain;

    public function notSatisfies(callable $callback, mixed ...$arguments): Chain;

    public function notScalarVal(): Chain;

    /** @param "B"|"KB"|"MB"|"GB"|"TB"|"PB"|"EB"|"ZB"|"YB" $unit */
    public function notSize(string $unit, Validator $validator): Chain;

    public function notSlug(): Chain;

    public function notSorted(string $direction): Chain;

    public function notSpace(string ...$additionalChars): Chain;

    public function notSpaced(): Chain;

    public function notStartsWith(mixed $startValue): Chain;

    public function notStringType(): Chain;

    public function notStringVal(): Chain;

    public function notSubdivisionCode(string $countryCode): Chain;

    /** @param mixed[] $superset */
    public function notSubset(array $superset): Chain;

    public function notSymbolicLink(): Chain;

    public function notTime(string $format = 'H:i:s'): Chain;

    public function notTld(): Chain;

    public function notTrueVal(): Chain;

    public function notUndef(): Chain;

    public function notUnique(): Chain;

    public function notUppercase(): Chain;

    public function notUrl(): Chain;

    public function notUuid(int|null $version = null): Chain;

    public function notVersion(): Chain;

    public function notVowel(string ...$additionalChars): Chain;

    public function notWhen(Validator $when, Validator $then, Validator|null $else = null): Chain;

    public function notWritable(): Chain;

    public function notXdigit(string ...$additionalChars): Chain;
}
