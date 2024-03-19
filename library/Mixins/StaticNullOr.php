<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Mixins;

use Respect\Validation\Validatable;

interface StaticNullOr
{
    public static function nullOfAllOf(
        Validatable $rule1,
        Validatable $rule2,
        Validatable ...$rules,
    ): ChainedValidator;

    public static function nullOfAlnum(string ...$additionalChars): ChainedValidator;

    public static function nullOfAlpha(string ...$additionalChars): ChainedValidator;

    public static function nullOfAlwaysInvalid(): ChainedValidator;

    public static function nullOfAlwaysValid(): ChainedValidator;

    public static function nullOfAnyOf(
        Validatable $rule1,
        Validatable $rule2,
        Validatable ...$rules,
    ): ChainedValidator;

    public static function nullOfArrayType(): ChainedValidator;

    public static function nullOfArrayVal(): ChainedValidator;

    public static function nullOfBase(
        int $base,
        string $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
    ): ChainedValidator;

    public static function nullOfBase64(): ChainedValidator;

    public static function nullOfBetween(mixed $minValue, mixed $maxValue): ChainedValidator;

    public static function nullOfBetweenExclusive(mixed $minimum, mixed $maximum): ChainedValidator;

    public static function nullOfBoolType(): ChainedValidator;

    public static function nullOfBoolVal(): ChainedValidator;

    public static function nullOfBsn(): ChainedValidator;

    public static function nullOfCall(callable $callable, Validatable $rule): ChainedValidator;

    public static function nullOfCallableType(): ChainedValidator;

    public static function nullOfCallback(callable $callback, mixed ...$arguments): ChainedValidator;

    public static function nullOfCharset(string $charset, string ...$charsets): ChainedValidator;

    public static function nullOfCnh(): ChainedValidator;

    public static function nullOfCnpj(): ChainedValidator;

    public static function nullOfConsecutive(
        Validatable $rule1,
        Validatable $rule2,
        Validatable ...$rules,
    ): ChainedValidator;

    public static function nullOfConsonant(string ...$additionalChars): ChainedValidator;

    public static function nullOfContains(mixed $containsValue, bool $identical = false): ChainedValidator;

    /**
     * @param non-empty-array<mixed> $needles
     */
    public static function nullOfContainsAny(array $needles, bool $identical = false): ChainedValidator;

    public static function nullOfControl(string ...$additionalChars): ChainedValidator;

    public static function nullOfCountable(): ChainedValidator;

    /**
     * @param "alpha-2"|"alpha-3"|"numeric" $set
     */
    public static function nullOfCountryCode(string $set = 'alpha-2'): ChainedValidator;

    public static function nullOfCpf(): ChainedValidator;

    public static function nullOfCreditCard(string $brand = 'Any'): ChainedValidator;

    /**
     * @param "alpha-3"|"numeric" $set
     */
    public static function nullOfCurrencyCode(string $set = 'alpha-3'): ChainedValidator;

    public static function nullOfDate(string $format = 'Y-m-d'): ChainedValidator;

    public static function nullOfDateTime(?string $format = null): ChainedValidator;

    public static function nullOfDecimal(int $decimals): ChainedValidator;

    public static function nullOfDigit(string ...$additionalChars): ChainedValidator;

    public static function nullOfDirectory(): ChainedValidator;

    public static function nullOfDomain(bool $tldCheck = true): ChainedValidator;

    public static function nullOfEach(Validatable $rule): ChainedValidator;

    public static function nullOfEmail(): ChainedValidator;

    public static function nullOfEndsWith(mixed $endValue, bool $identical = false): ChainedValidator;

    public static function nullOfEquals(mixed $compareTo): ChainedValidator;

    public static function nullOfEquivalent(mixed $compareTo): ChainedValidator;

    public static function nullOfEven(): ChainedValidator;

    public static function nullOfExecutable(): ChainedValidator;

    public static function nullOfExists(): ChainedValidator;

    public static function nullOfExtension(string $extension): ChainedValidator;

    public static function nullOfFactor(int $dividend): ChainedValidator;

    public static function nullOfFalseVal(): ChainedValidator;

    public static function nullOfFibonacci(): ChainedValidator;

    public static function nullOfFile(): ChainedValidator;

    public static function nullOfFilterVar(int $filter, mixed $options = null): ChainedValidator;

    public static function nullOfFinite(): ChainedValidator;

    public static function nullOfFloatType(): ChainedValidator;

    public static function nullOfFloatVal(): ChainedValidator;

    public static function nullOfGraph(string ...$additionalChars): ChainedValidator;

    public static function nullOfGreaterThan(mixed $compareTo): ChainedValidator;

    public static function nullOfGreaterThanOrEqual(mixed $compareTo): ChainedValidator;

    public static function nullOfHetu(): ChainedValidator;

    public static function nullOfHexRgbColor(): ChainedValidator;

    public static function nullOfIban(): ChainedValidator;

    public static function nullOfIdentical(mixed $compareTo): ChainedValidator;

    public static function nullOfImage(): ChainedValidator;

    public static function nullOfImei(): ChainedValidator;

    public static function nullOfIn(mixed $haystack, bool $compareIdentical = false): ChainedValidator;

    public static function nullOfInfinite(): ChainedValidator;

    /**
     * @param class-string $class
     */
    public static function nullOfInstance(string $class): ChainedValidator;

    public static function nullOfIntType(): ChainedValidator;

    public static function nullOfIntVal(): ChainedValidator;

    public static function nullOfIp(string $range = '*', ?int $options = null): ChainedValidator;

    public static function nullOfIsbn(): ChainedValidator;

    public static function nullOfIterableType(): ChainedValidator;

    public static function nullOfIterableVal(): ChainedValidator;

    public static function nullOfJson(): ChainedValidator;

    public static function nullOfKey(string|int $key, Validatable $rule): ChainedValidator;

    public static function nullOfKeyExists(string|int $key): ChainedValidator;

    public static function nullOfKeyOptional(string|int $key, Validatable $rule): ChainedValidator;

    public static function nullOfKeySet(Validatable $rule, Validatable ...$rules): ChainedValidator;

    /**
     * @param "alpha-2"|"alpha-3" $set
     */
    public static function nullOfLanguageCode(string $set = 'alpha-2'): ChainedValidator;

    /**
     * @param callable(mixed): Validatable $ruleCreator
     */
    public static function nullOfLazy(callable $ruleCreator): ChainedValidator;

    public static function nullOfLeapDate(string $format): ChainedValidator;

    public static function nullOfLeapYear(): ChainedValidator;

    public static function nullOfLength(Validatable $rule): ChainedValidator;

    public static function nullOfLessThan(mixed $compareTo): ChainedValidator;

    public static function nullOfLessThanOrEqual(mixed $compareTo): ChainedValidator;

    public static function nullOfLowercase(): ChainedValidator;

    public static function nullOfLuhn(): ChainedValidator;

    public static function nullOfMacAddress(): ChainedValidator;

    public static function nullOfMax(Validatable $rule): ChainedValidator;

    public static function nullOfMaxAge(int $age, ?string $format = null): ChainedValidator;

    public static function nullOfMimetype(string $mimetype): ChainedValidator;

    public static function nullOfMin(Validatable $rule): ChainedValidator;

    public static function nullOfMinAge(int $age, ?string $format = null): ChainedValidator;

    public static function nullOfMultiple(int $multipleOf): ChainedValidator;

    public static function nullOfNegative(): ChainedValidator;

    public static function nullOfNfeAccessKey(): ChainedValidator;

    public static function nullOfNif(): ChainedValidator;

    public static function nullOfNip(): ChainedValidator;

    public static function nullOfNo(bool $useLocale = false): ChainedValidator;

    public static function nullOfNoWhitespace(): ChainedValidator;

    public static function nullOfNoneOf(
        Validatable $rule1,
        Validatable $rule2,
        Validatable ...$rules,
    ): ChainedValidator;

    public static function nullOfNot(Validatable $rule): ChainedValidator;

    public static function nullOfNotBlank(): ChainedValidator;

    public static function nullOfNotEmoji(): ChainedValidator;

    public static function nullOfNotEmpty(): ChainedValidator;

    public static function nullOfNotOptional(): ChainedValidator;

    public static function nullOfNullType(): ChainedValidator;

    public static function nullOfNumber(): ChainedValidator;

    public static function nullOfNumericVal(): ChainedValidator;

    public static function nullOfObjectType(): ChainedValidator;

    public static function nullOfOdd(): ChainedValidator;

    public static function nullOfOneOf(
        Validatable $rule1,
        Validatable $rule2,
        Validatable ...$rules,
    ): ChainedValidator;

    public static function nullOfPerfectSquare(): ChainedValidator;

    public static function nullOfPesel(): ChainedValidator;

    public static function nullOfPhone(?string $countryCode = null): ChainedValidator;

    public static function nullOfPhpLabel(): ChainedValidator;

    public static function nullOfPis(): ChainedValidator;

    public static function nullOfPolishIdCard(): ChainedValidator;

    public static function nullOfPortugueseNif(): ChainedValidator;

    public static function nullOfPositive(): ChainedValidator;

    public static function nullOfPostalCode(string $countryCode, bool $formatted = false): ChainedValidator;

    public static function nullOfPrimeNumber(): ChainedValidator;

    public static function nullOfPrintable(string ...$additionalChars): ChainedValidator;

    public static function nullOfProperty(string $propertyName, Validatable $rule): ChainedValidator;

    public static function nullOfPropertyExists(string $propertyName): ChainedValidator;

    public static function nullOfPropertyOptional(string $propertyName, Validatable $rule): ChainedValidator;

    public static function nullOfPublicDomainSuffix(): ChainedValidator;

    public static function nullOfPunct(string ...$additionalChars): ChainedValidator;

    public static function nullOfReadable(): ChainedValidator;

    public static function nullOfRegex(string $regex): ChainedValidator;

    public static function nullOfResourceType(): ChainedValidator;

    public static function nullOfRoman(): ChainedValidator;

    public static function nullOfScalarVal(): ChainedValidator;

    public static function nullOfSize(
        string|int|null $minSize = null,
        string|int|null $maxSize = null,
    ): ChainedValidator;

    public static function nullOfSlug(): ChainedValidator;

    public static function nullOfSorted(string $direction): ChainedValidator;

    public static function nullOfSpace(string ...$additionalChars): ChainedValidator;

    public static function nullOfStartsWith(mixed $startValue, bool $identical = false): ChainedValidator;

    public static function nullOfStringType(): ChainedValidator;

    public static function nullOfStringVal(): ChainedValidator;

    public static function nullOfSubdivisionCode(string $countryCode): ChainedValidator;

    /**
     * @param mixed[] $superset
     */
    public static function nullOfSubset(array $superset): ChainedValidator;

    public static function nullOfSymbolicLink(): ChainedValidator;

    public static function nullOfTime(string $format = 'H:i:s'): ChainedValidator;

    public static function nullOfTld(): ChainedValidator;

    public static function nullOfTrueVal(): ChainedValidator;

    public static function nullOfUnique(): ChainedValidator;

    public static function nullOfUploaded(): ChainedValidator;

    public static function nullOfUppercase(): ChainedValidator;

    public static function nullOfUrl(): ChainedValidator;

    public static function nullOfUuid(?int $version = null): ChainedValidator;

    public static function nullOfVersion(): ChainedValidator;

    public static function nullOfVideoUrl(?string $service = null): ChainedValidator;

    public static function nullOfVowel(string ...$additionalChars): ChainedValidator;

    public static function nullOfWhen(
        Validatable $when,
        Validatable $then,
        ?Validatable $else = null,
    ): ChainedValidator;

    public static function nullOfWritable(): ChainedValidator;

    public static function nullOfXdigit(string ...$additionalChars): ChainedValidator;

    public static function nullOfYes(bool $useLocale = false): ChainedValidator;
}
