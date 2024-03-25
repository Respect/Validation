<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Mixins;

use DateTimeImmutable;
use Respect\Validation\Validatable;

interface StaticNot
{
    public static function notAllOf(Validatable $rule1, Validatable $rule2, Validatable ...$rules): ChainedValidator;

    public static function notAlnum(string ...$additionalChars): ChainedValidator;

    public static function notAlpha(string ...$additionalChars): ChainedValidator;

    public static function notAlwaysInvalid(): ChainedValidator;

    public static function notAlwaysValid(): ChainedValidator;

    public static function notAnyOf(Validatable $rule1, Validatable $rule2, Validatable ...$rules): ChainedValidator;

    public static function notArrayType(): ChainedValidator;

    public static function notArrayVal(): ChainedValidator;

    public static function notBase(
        int $base,
        string $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
    ): ChainedValidator;

    public static function notBase64(): ChainedValidator;

    public static function notBetween(mixed $minValue, mixed $maxValue): ChainedValidator;

    public static function notBetweenExclusive(mixed $minimum, mixed $maximum): ChainedValidator;

    public static function notBoolType(): ChainedValidator;

    public static function notBoolVal(): ChainedValidator;

    public static function notBsn(): ChainedValidator;

    public static function notCall(callable $callable, Validatable $rule): ChainedValidator;

    public static function notCallableType(): ChainedValidator;

    public static function notCallback(callable $callback, mixed ...$arguments): ChainedValidator;

    public static function notCharset(string $charset, string ...$charsets): ChainedValidator;

    public static function notCnh(): ChainedValidator;

    public static function notCnpj(): ChainedValidator;

    public static function notConsecutive(
        Validatable $rule1,
        Validatable $rule2,
        Validatable ...$rules,
    ): ChainedValidator;

    public static function notConsonant(string ...$additionalChars): ChainedValidator;

    public static function notContains(mixed $containsValue, bool $identical = false): ChainedValidator;

    /**
     * @param non-empty-array<mixed> $needles
     */
    public static function notContainsAny(array $needles, bool $identical = false): ChainedValidator;

    public static function notControl(string ...$additionalChars): ChainedValidator;

    public static function notCountable(): ChainedValidator;

    /**
     * @param "alpha-2"|"alpha-3"|"numeric" $set
     */
    public static function notCountryCode(string $set = 'alpha-2'): ChainedValidator;

    public static function notCpf(): ChainedValidator;

    public static function notCreditCard(string $brand = 'Any'): ChainedValidator;

    /**
     * @param "alpha-3"|"numeric" $set
     */
    public static function notCurrencyCode(string $set = 'alpha-3'): ChainedValidator;

    public static function notDate(string $format = 'Y-m-d'): ChainedValidator;

    public static function notDateTime(?string $format = null): ChainedValidator;

    /**
     * @param "years"|"months"|"days"|"hours"|"minutes"|"seconds"|"microseconds" $type
     */
    public static function notDateTimeDiff(
        string $type,
        Validatable $rule,
        ?string $format = null,
        ?DateTimeImmutable $now = null,
    ): ChainedValidator;

    public static function notDecimal(int $decimals): ChainedValidator;

    public static function notDigit(string ...$additionalChars): ChainedValidator;

    public static function notDirectory(): ChainedValidator;

    public static function notDomain(bool $tldCheck = true): ChainedValidator;

    public static function notEach(Validatable $rule): ChainedValidator;

    public static function notEmail(): ChainedValidator;

    public static function notEndsWith(mixed $endValue, bool $identical = false): ChainedValidator;

    public static function notEquals(mixed $compareTo): ChainedValidator;

    public static function notEquivalent(mixed $compareTo): ChainedValidator;

    public static function notEven(): ChainedValidator;

    public static function notExecutable(): ChainedValidator;

    public static function notExists(): ChainedValidator;

    public static function notExtension(string $extension): ChainedValidator;

    public static function notFactor(int $dividend): ChainedValidator;

    public static function notFalseVal(): ChainedValidator;

    public static function notFibonacci(): ChainedValidator;

    public static function notFile(): ChainedValidator;

    public static function notFilterVar(int $filter, mixed $options = null): ChainedValidator;

    public static function notFinite(): ChainedValidator;

    public static function notFloatType(): ChainedValidator;

    public static function notFloatVal(): ChainedValidator;

    public static function notGraph(string ...$additionalChars): ChainedValidator;

    public static function notGreaterThan(mixed $compareTo): ChainedValidator;

    public static function notGreaterThanOrEqual(mixed $compareTo): ChainedValidator;

    public static function notHetu(): ChainedValidator;

    public static function notHexRgbColor(): ChainedValidator;

    public static function notIban(): ChainedValidator;

    public static function notIdentical(mixed $compareTo): ChainedValidator;

    public static function notImage(): ChainedValidator;

    public static function notImei(): ChainedValidator;

    public static function notIn(mixed $haystack, bool $compareIdentical = false): ChainedValidator;

    public static function notInfinite(): ChainedValidator;

    /**
     * @param class-string $class
     */
    public static function notInstance(string $class): ChainedValidator;

    public static function notIntType(): ChainedValidator;

    public static function notIntVal(): ChainedValidator;

    public static function notIp(string $range = '*', ?int $options = null): ChainedValidator;

    public static function notIsbn(): ChainedValidator;

    public static function notIterableType(): ChainedValidator;

    public static function notIterableVal(): ChainedValidator;

    public static function notJson(): ChainedValidator;

    public static function notKey(string|int $key, Validatable $rule): ChainedValidator;

    public static function notKeyExists(string|int $key): ChainedValidator;

    public static function notKeyOptional(string|int $key, Validatable $rule): ChainedValidator;

    public static function notKeySet(Validatable $rule, Validatable ...$rules): ChainedValidator;

    /**
     * @param "alpha-2"|"alpha-3" $set
     */
    public static function notLanguageCode(string $set = 'alpha-2'): ChainedValidator;

    /**
     * @param callable(mixed): Validatable $ruleCreator
     */
    public static function notLazy(callable $ruleCreator): ChainedValidator;

    public static function notLeapDate(string $format): ChainedValidator;

    public static function notLeapYear(): ChainedValidator;

    public static function notLength(Validatable $rule): ChainedValidator;

    public static function notLessThan(mixed $compareTo): ChainedValidator;

    public static function notLessThanOrEqual(mixed $compareTo): ChainedValidator;

    public static function notLowercase(): ChainedValidator;

    public static function notLuhn(): ChainedValidator;

    public static function notMacAddress(): ChainedValidator;

    public static function notMax(Validatable $rule): ChainedValidator;

    public static function notMaxAge(int $age, ?string $format = null): ChainedValidator;

    public static function notMimetype(string $mimetype): ChainedValidator;

    public static function notMin(Validatable $rule): ChainedValidator;

    public static function notMinAge(int $age, ?string $format = null): ChainedValidator;

    public static function notMultiple(int $multipleOf): ChainedValidator;

    public static function notNegative(): ChainedValidator;

    public static function notNfeAccessKey(): ChainedValidator;

    public static function notNif(): ChainedValidator;

    public static function notNip(): ChainedValidator;

    public static function notNo(bool $useLocale = false): ChainedValidator;

    public static function notNoWhitespace(): ChainedValidator;

    public static function notNoneOf(Validatable $rule1, Validatable $rule2, Validatable ...$rules): ChainedValidator;

    public static function notNullType(): ChainedValidator;

    public static function notNumber(): ChainedValidator;

    public static function notNumericVal(): ChainedValidator;

    public static function notObjectType(): ChainedValidator;

    public static function notOdd(): ChainedValidator;

    public static function notOneOf(Validatable $rule1, Validatable $rule2, Validatable ...$rules): ChainedValidator;

    public static function notPerfectSquare(): ChainedValidator;

    public static function notPesel(): ChainedValidator;

    public static function notPhone(?string $countryCode = null): ChainedValidator;

    public static function notPhpLabel(): ChainedValidator;

    public static function notPis(): ChainedValidator;

    public static function notPolishIdCard(): ChainedValidator;

    public static function notPortugueseNif(): ChainedValidator;

    public static function notPositive(): ChainedValidator;

    public static function notPostalCode(string $countryCode, bool $formatted = false): ChainedValidator;

    public static function notPrimeNumber(): ChainedValidator;

    public static function notPrintable(string ...$additionalChars): ChainedValidator;

    public static function notProperty(string $propertyName, Validatable $rule): ChainedValidator;

    public static function notPropertyExists(string $propertyName): ChainedValidator;

    public static function notPropertyOptional(string $propertyName, Validatable $rule): ChainedValidator;

    public static function notPublicDomainSuffix(): ChainedValidator;

    public static function notPunct(string ...$additionalChars): ChainedValidator;

    public static function notReadable(): ChainedValidator;

    public static function notRegex(string $regex): ChainedValidator;

    public static function notResourceType(): ChainedValidator;

    public static function notRoman(): ChainedValidator;

    public static function notScalarVal(): ChainedValidator;

    public static function notSize(string|int|null $minSize = null, string|int|null $maxSize = null): ChainedValidator;

    public static function notSlug(): ChainedValidator;

    public static function notSorted(string $direction): ChainedValidator;

    public static function notSpace(string ...$additionalChars): ChainedValidator;

    public static function notStartsWith(mixed $startValue, bool $identical = false): ChainedValidator;

    public static function notStringType(): ChainedValidator;

    public static function notStringVal(): ChainedValidator;

    public static function notSubdivisionCode(string $countryCode): ChainedValidator;

    /**
     * @param mixed[] $superset
     */
    public static function notSubset(array $superset): ChainedValidator;

    public static function notSymbolicLink(): ChainedValidator;

    public static function notTime(string $format = 'H:i:s'): ChainedValidator;

    public static function notTld(): ChainedValidator;

    public static function notTrueVal(): ChainedValidator;

    public static function notUnique(): ChainedValidator;

    public static function notUploaded(): ChainedValidator;

    public static function notUppercase(): ChainedValidator;

    public static function notUrl(): ChainedValidator;

    public static function notUuid(?int $version = null): ChainedValidator;

    public static function notVersion(): ChainedValidator;

    public static function notVideoUrl(?string $service = null): ChainedValidator;

    public static function notVowel(string ...$additionalChars): ChainedValidator;

    public static function notWhen(Validatable $when, Validatable $then, ?Validatable $else = null): ChainedValidator;

    public static function notWritable(): ChainedValidator;

    public static function notXdigit(string ...$additionalChars): ChainedValidator;

    public static function notYes(bool $useLocale = false): ChainedValidator;
}
