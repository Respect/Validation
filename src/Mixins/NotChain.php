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

interface NotChain
{
    /** @return Chain<mixed> */
    public function notAfter(callable $callable, Validator $validator): Chain;

    /** @return Chain<mixed> */
    public function notAll(Validator $validator): Chain;

    /** @return Chain<mixed> */
    public function notAllOf(Validator $validator1, Validator $validator2, Validator ...$validators): Chain;

    /** @return Chain<mixed> */
    public function notAlnum(string ...$additionalChars): Chain;

    /** @return Chain<mixed> */
    public function notAlpha(string ...$additionalChars): Chain;

    /** @return Chain<mixed> */
    public function notAlwaysInvalid(): Chain;

    /** @return Chain<mixed> */
    public function notAlwaysValid(): Chain;

    /** @return Chain<mixed> */
    public function notAnyOf(Validator $validator1, Validator $validator2, Validator ...$validators): Chain;

    /** @return Chain<mixed> */
    public function notArrayType(): Chain;

    /** @return Chain<mixed> */
    public function notArrayVal(): Chain;

    /** @return Chain<mixed> */
    public function notBase(int $base, string $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'): Chain;

    /** @return Chain<mixed> */
    public function notBase64(): Chain;

    /** @return Chain<mixed> */
    public function notBetween(mixed $minValue, mixed $maxValue): Chain;

    /** @return Chain<mixed> */
    public function notBetweenExclusive(mixed $minimum, mixed $maximum): Chain;

    /** @return Chain<mixed> */
    public function notBlank(): Chain;

    /** @return Chain<mixed> */
    public function notBoolType(): Chain;

    /** @return Chain<mixed> */
    public function notBoolVal(): Chain;

    /** @return Chain<mixed> */
    public function notBsn(): Chain;

    /** @return Chain<mixed> */
    public function notCallableType(): Chain;

    /** @return Chain<mixed> */
    public function notCharset(string $charset, string ...$charsets): Chain;

    /** @return Chain<mixed> */
    public function notCnh(): Chain;

    /** @return Chain<mixed> */
    public function notCnpj(): Chain;

    /** @return Chain<mixed> */
    public function notConsonant(string ...$additionalChars): Chain;

    /** @return Chain<mixed> */
    public function notContains(mixed $containsValue): Chain;

    /**
     * @param non-empty-array<mixed> $needles
     * @return Chain<mixed>
     */
    public function notContainsAny(array $needles): Chain;

    /** @return Chain<mixed> */
    public function notContainsCount(mixed $containsValue, int $count): Chain;

    /** @return Chain<mixed> */
    public function notControl(string ...$additionalChars): Chain;

    /** @return Chain<mixed> */
    public function notCountable(): Chain;

    /**
     * @param "alpha-2"|"alpha-3"|"numeric" $set
     * @return Chain<mixed>
     */
    public function notCountryCode(string $set = 'alpha-2'): Chain;

    /** @return Chain<mixed> */
    public function notCpf(): Chain;

    /** @return Chain<mixed> */
    public function notCreditCard(string $brand = 'Any'): Chain;

    /**
     * @param "alpha-3"|"numeric" $set
     * @return Chain<mixed>
     */
    public function notCurrencyCode(string $set = 'alpha-3'): Chain;

    /** @return Chain<mixed> */
    public function notDate(string $format = 'Y-m-d'): Chain;

    /** @return Chain<mixed> */
    public function notDateTime(string|null $format = null): Chain;

    /**
     * @param "years"|"months"|"days"|"hours"|"minutes"|"seconds"|"microseconds" $type
     * @return Chain<mixed>
     */
    public function notDateTimeDiff(string $type, Validator $validator, string|null $format = null, DateTimeImmutable|null $now = null): Chain;

    /** @return Chain<mixed> */
    public function notDecimal(int $decimals): Chain;

    /** @return Chain<mixed> */
    public function notDigit(string ...$additionalChars): Chain;

    /** @return Chain<mixed> */
    public function notDirectory(): Chain;

    /** @return Chain<mixed> */
    public function notDomain(bool $tldCheck = true): Chain;

    /** @return Chain<mixed> */
    public function notEach(Validator $validator): Chain;

    /** @return Chain<mixed> */
    public function notEachKey(Validator $validator): Chain;

    /** @return Chain<mixed> */
    public function notEmail(): Chain;

    /** @return Chain<mixed> */
    public function notEmoji(): Chain;

    /** @return Chain<mixed> */
    public function notEndsWith(mixed $endValue, mixed ...$endValues): Chain;

    /** @return Chain<mixed> */
    public function notEquals(mixed $compareTo): Chain;

    /** @return Chain<mixed> */
    public function notEquivalent(mixed $compareTo): Chain;

    /** @return Chain<mixed> */
    public function notEven(): Chain;

    /** @return Chain<mixed> */
    public function notExecutable(): Chain;

    /** @return Chain<mixed> */
    public function notExists(): Chain;

    /** @return Chain<mixed> */
    public function notExtension(string $extension): Chain;

    /** @return Chain<mixed> */
    public function notFactor(int $dividend): Chain;

    /**
     * @param callable(mixed): Validator $factory
     * @return Chain<mixed>
     */
    public function notFactory(callable $factory): Chain;

    /** @return Chain<mixed> */
    public function notFalseVal(): Chain;

    /** @return Chain<mixed> */
    public function notFalsy(): Chain;

    /** @return Chain<mixed> */
    public function notFile(): Chain;

    /** @return Chain<mixed> */
    public function notFinite(): Chain;

    /** @return Chain<mixed> */
    public function notFloatType(): Chain;

    /** @return Chain<mixed> */
    public function notFloatVal(): Chain;

    /** @return Chain<mixed> */
    public function notFormat(Formatter $formatter): Chain;

    /** @return Chain<mixed> */
    public function notFormatted(Formatter $formatter, Validator $validator): Chain;

    /** @return Chain<mixed> */
    public function notGiven(Validator $when, Validator $then): Chain;

    /** @return Chain<mixed> */
    public function notGraph(string ...$additionalChars): Chain;

    /** @return Chain<mixed> */
    public function notGreaterThan(mixed $compareTo): Chain;

    /** @return Chain<mixed> */
    public function notGreaterThanOrEqual(mixed $compareTo): Chain;

    /** @return Chain<mixed> */
    public function notHetu(): Chain;

    /** @return Chain<mixed> */
    public function notHexRgbColor(): Chain;

    /** @return Chain<mixed> */
    public function notIban(): Chain;

    /** @return Chain<mixed> */
    public function notIdentical(mixed $compareTo): Chain;

    /** @return Chain<mixed> */
    public function notImage(): Chain;

    /** @return Chain<mixed> */
    public function notImei(): Chain;

    /** @return Chain<mixed> */
    public function notIn(mixed $haystack): Chain;

    /** @return Chain<mixed> */
    public function notInfinite(): Chain;

    /**
     * @param class-string $class
     * @return Chain<mixed>
     */
    public function notInstance(string $class): Chain;

    /** @return Chain<mixed> */
    public function notIntType(): Chain;

    /** @return Chain<mixed> */
    public function notIntVal(): Chain;

    /** @return Chain<mixed> */
    public function notIp(string $range = '*', int|null $options = null): Chain;

    /** @return Chain<mixed> */
    public function notIsbn(): Chain;

    /** @return Chain<mixed> */
    public function notIterableType(): Chain;

    /** @return Chain<mixed> */
    public function notIterableVal(): Chain;

    /** @return Chain<mixed> */
    public function notJson(): Chain;

    /** @return Chain<mixed> */
    public function notKey(int|string $key, Validator $validator): Chain;

    /** @return Chain<mixed> */
    public function notKeyExists(int|string $key): Chain;

    /** @return Chain<mixed> */
    public function notKeyOptional(int|string $key, Validator $validator): Chain;

    /** @return Chain<mixed> */
    public function notKeySet(Validator $validator, Validator ...$validators): Chain;

    /**
     * @param "alpha-2"|"alpha-3" $set
     * @return Chain<mixed>
     */
    public function notLanguageCode(string $set = 'alpha-2'): Chain;

    /** @return Chain<mixed> */
    public function notLeapDate(string $format): Chain;

    /** @return Chain<mixed> */
    public function notLeapYear(): Chain;

    /** @return Chain<mixed> */
    public function notLength(Validator $validator): Chain;

    /** @return Chain<mixed> */
    public function notLessThan(mixed $compareTo): Chain;

    /** @return Chain<mixed> */
    public function notLessThanOrEqual(mixed $compareTo): Chain;

    /** @return Chain<mixed> */
    public function notLowercase(): Chain;

    /** @return Chain<mixed> */
    public function notLuhn(): Chain;

    /** @return Chain<mixed> */
    public function notMacAddress(): Chain;

    /** @return Chain<mixed> */
    public function notMax(Validator $validator): Chain;

    /** @return Chain<mixed> */
    public function notMimetype(string $mimetype): Chain;

    /** @return Chain<mixed> */
    public function notMin(Validator $validator): Chain;

    /** @return Chain<mixed> */
    public function notMultiple(int $multipleOf): Chain;

    /** @return Chain<mixed> */
    public function notNegative(): Chain;

    /** @return Chain<mixed> */
    public function notNfeAccessKey(): Chain;

    /** @return Chain<mixed> */
    public function notNif(): Chain;

    /** @return Chain<mixed> */
    public function notNip(): Chain;

    /** @return Chain<mixed> */
    public function notNoneOf(Validator $validator1, Validator $validator2, Validator ...$validators): Chain;

    /** @return Chain<mixed> */
    public function notNullType(): Chain;

    /** @return Chain<mixed> */
    public function notNumber(): Chain;

    /** @return Chain<mixed> */
    public function notNumericVal(): Chain;

    /** @return Chain<mixed> */
    public function notObjectType(): Chain;

    /** @return Chain<mixed> */
    public function notOdd(): Chain;

    /** @return Chain<mixed> */
    public function notOneOf(Validator $validator1, Validator $validator2, Validator ...$validators): Chain;

    /** @return Chain<mixed> */
    public function notPesel(): Chain;

    /** @return Chain<mixed> */
    public function notPhone(string|null $countryCode = null): Chain;

    /** @return Chain<mixed> */
    public function notPis(): Chain;

    /** @return Chain<mixed> */
    public function notPolishIdCard(): Chain;

    /** @return Chain<mixed> */
    public function notPortugueseNif(): Chain;

    /** @return Chain<mixed> */
    public function notPositive(): Chain;

    /** @return Chain<mixed> */
    public function notPostalCode(string $countryCode, bool $formatted = false): Chain;

    /** @return Chain<mixed> */
    public function notPrintable(string ...$additionalChars): Chain;

    /** @return Chain<mixed> */
    public function notProperty(string $propertyName, Validator $validator): Chain;

    /** @return Chain<mixed> */
    public function notPropertyExists(string $propertyName): Chain;

    /** @return Chain<mixed> */
    public function notPropertyOptional(string $propertyName, Validator $validator): Chain;

    /** @return Chain<mixed> */
    public function notPublicDomainSuffix(): Chain;

    /** @return Chain<mixed> */
    public function notPunct(string ...$additionalChars): Chain;

    /** @return Chain<mixed> */
    public function notReadable(): Chain;

    /** @return Chain<mixed> */
    public function notRegex(string $regex): Chain;

    /** @return Chain<mixed> */
    public function notResourceType(): Chain;

    /** @return Chain<mixed> */
    public function notRoman(): Chain;

    /** @return Chain<mixed> */
    public function notSatisfies(callable $callback, mixed ...$arguments): Chain;

    /** @return Chain<mixed> */
    public function notScalarVal(): Chain;

    /** @return Chain<mixed> */
    public function notShortCircuit(Validator ...$validators): Chain;

    /**
     * @param "B"|"KB"|"MB"|"GB"|"TB"|"PB"|"EB"|"ZB"|"YB" $unit
     * @return Chain<mixed>
     */
    public function notSize(string $unit, Validator $validator): Chain;

    /** @return Chain<mixed> */
    public function notSlug(): Chain;

    /** @return Chain<mixed> */
    public function notSorted(string $direction): Chain;

    /** @return Chain<mixed> */
    public function notSpace(string ...$additionalChars): Chain;

    /** @return Chain<mixed> */
    public function notSpaced(): Chain;

    /** @return Chain<mixed> */
    public function notStartsWith(mixed $startValue, mixed ...$startValues): Chain;

    /** @return Chain<mixed> */
    public function notStringType(): Chain;

    /** @return Chain<mixed> */
    public function notStringVal(): Chain;

    /** @return Chain<mixed> */
    public function notSubdivisionCode(string $countryCode): Chain;

    /**
     * @param mixed[] $superset
     * @return Chain<mixed>
     */
    public function notSubset(array $superset): Chain;

    /** @return Chain<mixed> */
    public function notSymbolicLink(): Chain;

    /** @return Chain<mixed> */
    public function notTime(string $format = 'H:i:s'): Chain;

    /** @return Chain<mixed> */
    public function notTld(): Chain;

    /** @return Chain<mixed> */
    public function notTrimmed(string ...$trimValues): Chain;

    /** @return Chain<mixed> */
    public function notTrueVal(): Chain;

    /** @return Chain<mixed> */
    public function notUndef(): Chain;

    /** @return Chain<mixed> */
    public function notUnique(): Chain;

    /** @return Chain<mixed> */
    public function notUppercase(): Chain;

    /** @return Chain<mixed> */
    public function notUrl(): Chain;

    /** @return Chain<mixed> */
    public function notUuid(int|null $version = null): Chain;

    /** @return Chain<mixed> */
    public function notVersion(): Chain;

    /** @return Chain<mixed> */
    public function notVowel(string ...$additionalChars): Chain;

    /** @return Chain<mixed> */
    public function notWhen(Validator $when, Validator $then, Validator|null $else = null): Chain;

    /** @return Chain<mixed> */
    public function notWritable(): Chain;

    /** @return Chain<mixed> */
    public function notXdigit(string ...$additionalChars): Chain;
}
