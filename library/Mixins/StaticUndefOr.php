<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Mixins;

use Respect\Validation\Validatable;

interface StaticUndefOr
{
    public static function undefOfAllOf(
        Validatable $rule1,
        Validatable $rule2,
        Validatable ...$rules,
    ): ChainedValidator;

    public static function undefOfAlnum(string ...$additionalChars): ChainedValidator;

    public static function undefOfAlpha(string ...$additionalChars): ChainedValidator;

    public static function undefOfAlwaysInvalid(): ChainedValidator;

    public static function undefOfAlwaysValid(): ChainedValidator;

    public static function undefOfAnyOf(
        Validatable $rule1,
        Validatable $rule2,
        Validatable ...$rules,
    ): ChainedValidator;

    public static function undefOfArrayType(): ChainedValidator;

    public static function undefOfArrayVal(): ChainedValidator;

    public static function undefOfBase(
        int $base,
        string $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
    ): ChainedValidator;

    public static function undefOfBase64(): ChainedValidator;

    public static function undefOfBetween(mixed $minValue, mixed $maxValue): ChainedValidator;

    public static function undefOfBetweenExclusive(mixed $minimum, mixed $maximum): ChainedValidator;

    public static function undefOfBoolType(): ChainedValidator;

    public static function undefOfBoolVal(): ChainedValidator;

    public static function undefOfBsn(): ChainedValidator;

    public static function undefOfCall(callable $callable, Validatable $rule): ChainedValidator;

    public static function undefOfCallableType(): ChainedValidator;

    public static function undefOfCallback(callable $callback, mixed ...$arguments): ChainedValidator;

    public static function undefOfCharset(string $charset, string ...$charsets): ChainedValidator;

    public static function undefOfCnh(): ChainedValidator;

    public static function undefOfCnpj(): ChainedValidator;

    public static function undefOfConsecutive(
        Validatable $rule1,
        Validatable $rule2,
        Validatable ...$rules,
    ): ChainedValidator;

    public static function undefOfConsonant(string ...$additionalChars): ChainedValidator;

    public static function undefOfContains(mixed $containsValue, bool $identical = false): ChainedValidator;

    /**
     * @param non-empty-array<mixed> $needles
     */
    public static function undefOfContainsAny(array $needles, bool $identical = false): ChainedValidator;

    public static function undefOfControl(string ...$additionalChars): ChainedValidator;

    public static function undefOfCountable(): ChainedValidator;

    /**
     * @param "alpha-2"|"alpha-3"|"numeric" $set
     */
    public static function undefOfCountryCode(string $set = 'alpha-2'): ChainedValidator;

    public static function undefOfCpf(): ChainedValidator;

    public static function undefOfCreditCard(string $brand = 'Any'): ChainedValidator;

    /**
     * @param "alpha-3"|"numeric" $set
     */
    public static function undefOfCurrencyCode(string $set = 'alpha-3'): ChainedValidator;

    public static function undefOfDate(string $format = 'Y-m-d'): ChainedValidator;

    public static function undefOfDateTime(?string $format = null): ChainedValidator;

    public static function undefOfDecimal(int $decimals): ChainedValidator;

    public static function undefOfDigit(string ...$additionalChars): ChainedValidator;

    public static function undefOfDirectory(): ChainedValidator;

    public static function undefOfDomain(bool $tldCheck = true): ChainedValidator;

    public static function undefOfEach(Validatable $rule): ChainedValidator;

    public static function undefOfEmail(): ChainedValidator;

    public static function undefOfEndsWith(mixed $endValue, bool $identical = false): ChainedValidator;

    public static function undefOfEquals(mixed $compareTo): ChainedValidator;

    public static function undefOfEquivalent(mixed $compareTo): ChainedValidator;

    public static function undefOfEven(): ChainedValidator;

    public static function undefOfExecutable(): ChainedValidator;

    public static function undefOfExists(): ChainedValidator;

    public static function undefOfExtension(string $extension): ChainedValidator;

    public static function undefOfFactor(int $dividend): ChainedValidator;

    public static function undefOfFalseVal(): ChainedValidator;

    public static function undefOfFibonacci(): ChainedValidator;

    public static function undefOfFile(): ChainedValidator;

    public static function undefOfFilterVar(int $filter, mixed $options = null): ChainedValidator;

    public static function undefOfFinite(): ChainedValidator;

    public static function undefOfFloatType(): ChainedValidator;

    public static function undefOfFloatVal(): ChainedValidator;

    public static function undefOfGraph(string ...$additionalChars): ChainedValidator;

    public static function undefOfGreaterThan(mixed $compareTo): ChainedValidator;

    public static function undefOfGreaterThanOrEqual(mixed $compareTo): ChainedValidator;

    public static function undefOfHetu(): ChainedValidator;

    public static function undefOfHexRgbColor(): ChainedValidator;

    public static function undefOfIban(): ChainedValidator;

    public static function undefOfIdentical(mixed $compareTo): ChainedValidator;

    public static function undefOfImage(): ChainedValidator;

    public static function undefOfImei(): ChainedValidator;

    public static function undefOfIn(mixed $haystack, bool $compareIdentical = false): ChainedValidator;

    public static function undefOfInfinite(): ChainedValidator;

    /**
     * @param class-string $class
     */
    public static function undefOfInstance(string $class): ChainedValidator;

    public static function undefOfIntType(): ChainedValidator;

    public static function undefOfIntVal(): ChainedValidator;

    public static function undefOfIp(string $range = '*', ?int $options = null): ChainedValidator;

    public static function undefOfIsbn(): ChainedValidator;

    public static function undefOfIterableType(): ChainedValidator;

    public static function undefOfIterableVal(): ChainedValidator;

    public static function undefOfJson(): ChainedValidator;

    public static function undefOfKey(string|int $key, Validatable $rule): ChainedValidator;

    public static function undefOfKeyExists(string|int $key): ChainedValidator;

    public static function undefOfKeyOptional(string|int $key, Validatable $rule): ChainedValidator;

    public static function undefOfKeySet(Validatable $rule, Validatable ...$rules): ChainedValidator;

    /**
     * @param "alpha-2"|"alpha-3" $set
     */
    public static function undefOfLanguageCode(string $set = 'alpha-2'): ChainedValidator;

    /**
     * @param callable(mixed): Validatable $ruleCreator
     */
    public static function undefOfLazy(callable $ruleCreator): ChainedValidator;

    public static function undefOfLeapDate(string $format): ChainedValidator;

    public static function undefOfLeapYear(): ChainedValidator;

    public static function undefOfLength(Validatable $rule): ChainedValidator;

    public static function undefOfLessThan(mixed $compareTo): ChainedValidator;

    public static function undefOfLessThanOrEqual(mixed $compareTo): ChainedValidator;

    public static function undefOfLowercase(): ChainedValidator;

    public static function undefOfLuhn(): ChainedValidator;

    public static function undefOfMacAddress(): ChainedValidator;

    public static function undefOfMax(Validatable $rule): ChainedValidator;

    public static function undefOfMaxAge(int $age, ?string $format = null): ChainedValidator;

    public static function undefOfMimetype(string $mimetype): ChainedValidator;

    public static function undefOfMin(Validatable $rule): ChainedValidator;

    public static function undefOfMinAge(int $age, ?string $format = null): ChainedValidator;

    public static function undefOfMultiple(int $multipleOf): ChainedValidator;

    public static function undefOfNegative(): ChainedValidator;

    public static function undefOfNfeAccessKey(): ChainedValidator;

    public static function undefOfNif(): ChainedValidator;

    public static function undefOfNip(): ChainedValidator;

    public static function undefOfNo(bool $useLocale = false): ChainedValidator;

    public static function undefOfNoWhitespace(): ChainedValidator;

    public static function undefOfNoneOf(
        Validatable $rule1,
        Validatable $rule2,
        Validatable ...$rules,
    ): ChainedValidator;

    public static function undefOfNot(Validatable $rule): ChainedValidator;

    public static function undefOfNotBlank(): ChainedValidator;

    public static function undefOfNotEmoji(): ChainedValidator;

    public static function undefOfNotEmpty(): ChainedValidator;

    public static function undefOfNotOptional(): ChainedValidator;

    public static function undefOfNullType(): ChainedValidator;

    public static function undefOfNumber(): ChainedValidator;

    public static function undefOfNumericVal(): ChainedValidator;

    public static function undefOfObjectType(): ChainedValidator;

    public static function undefOfOdd(): ChainedValidator;

    public static function undefOfOneOf(
        Validatable $rule1,
        Validatable $rule2,
        Validatable ...$rules,
    ): ChainedValidator;

    public static function undefOfPerfectSquare(): ChainedValidator;

    public static function undefOfPesel(): ChainedValidator;

    public static function undefOfPhone(?string $countryCode = null): ChainedValidator;

    public static function undefOfPhpLabel(): ChainedValidator;

    public static function undefOfPis(): ChainedValidator;

    public static function undefOfPolishIdCard(): ChainedValidator;

    public static function undefOfPortugueseNif(): ChainedValidator;

    public static function undefOfPositive(): ChainedValidator;

    public static function undefOfPostalCode(string $countryCode, bool $formatted = false): ChainedValidator;

    public static function undefOfPrimeNumber(): ChainedValidator;

    public static function undefOfPrintable(string ...$additionalChars): ChainedValidator;

    public static function undefOfProperty(string $propertyName, Validatable $rule): ChainedValidator;

    public static function undefOfPropertyExists(string $propertyName): ChainedValidator;

    public static function undefOfPropertyOptional(string $propertyName, Validatable $rule): ChainedValidator;

    public static function undefOfPublicDomainSuffix(): ChainedValidator;

    public static function undefOfPunct(string ...$additionalChars): ChainedValidator;

    public static function undefOfReadable(): ChainedValidator;

    public static function undefOfRegex(string $regex): ChainedValidator;

    public static function undefOfResourceType(): ChainedValidator;

    public static function undefOfRoman(): ChainedValidator;

    public static function undefOfScalarVal(): ChainedValidator;

    public static function undefOfSize(
        string|int|null $minSize = null,
        string|int|null $maxSize = null,
    ): ChainedValidator;

    public static function undefOfSlug(): ChainedValidator;

    public static function undefOfSorted(string $direction): ChainedValidator;

    public static function undefOfSpace(string ...$additionalChars): ChainedValidator;

    public static function undefOfStartsWith(mixed $startValue, bool $identical = false): ChainedValidator;

    public static function undefOfStringType(): ChainedValidator;

    public static function undefOfStringVal(): ChainedValidator;

    public static function undefOfSubdivisionCode(string $countryCode): ChainedValidator;

    /**
     * @param mixed[] $superset
     */
    public static function undefOfSubset(array $superset): ChainedValidator;

    public static function undefOfSymbolicLink(): ChainedValidator;

    public static function undefOfTime(string $format = 'H:i:s'): ChainedValidator;

    public static function undefOfTld(): ChainedValidator;

    public static function undefOfTrueVal(): ChainedValidator;

    public static function undefOfUnique(): ChainedValidator;

    public static function undefOfUploaded(): ChainedValidator;

    public static function undefOfUppercase(): ChainedValidator;

    public static function undefOfUrl(): ChainedValidator;

    public static function undefOfUuid(?int $version = null): ChainedValidator;

    public static function undefOfVersion(): ChainedValidator;

    public static function undefOfVideoUrl(?string $service = null): ChainedValidator;

    public static function undefOfVowel(string ...$additionalChars): ChainedValidator;

    public static function undefOfWhen(
        Validatable $when,
        Validatable $then,
        ?Validatable $else = null,
    ): ChainedValidator;

    public static function undefOfWritable(): ChainedValidator;

    public static function undefOfXdigit(string ...$additionalChars): ChainedValidator;

    public static function undefOfYes(bool $useLocale = false): ChainedValidator;
}
