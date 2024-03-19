<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Mixins;

use Respect\Validation\Validatable;

interface ChainedUndefOr
{
    public function undefOfAllOf(Validatable $rule1, Validatable $rule2, Validatable ...$rules): ChainedValidator;

    public function undefOfAlnum(string ...$additionalChars): ChainedValidator;

    public function undefOfAlpha(string ...$additionalChars): ChainedValidator;

    public function undefOfAlwaysInvalid(): ChainedValidator;

    public function undefOfAlwaysValid(): ChainedValidator;

    public function undefOfAnyOf(Validatable $rule1, Validatable $rule2, Validatable ...$rules): ChainedValidator;

    public function undefOfArrayType(): ChainedValidator;

    public function undefOfArrayVal(): ChainedValidator;

    public function undefOfBase(
        int $base,
        string $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
    ): ChainedValidator;

    public function undefOfBase64(): ChainedValidator;

    public function undefOfBetween(mixed $minValue, mixed $maxValue): ChainedValidator;

    public function undefOfBetweenExclusive(mixed $minimum, mixed $maximum): ChainedValidator;

    public function undefOfBoolType(): ChainedValidator;

    public function undefOfBoolVal(): ChainedValidator;

    public function undefOfBsn(): ChainedValidator;

    public function undefOfCall(callable $callable, Validatable $rule): ChainedValidator;

    public function undefOfCallableType(): ChainedValidator;

    public function undefOfCallback(callable $callback, mixed ...$arguments): ChainedValidator;

    public function undefOfCharset(string $charset, string ...$charsets): ChainedValidator;

    public function undefOfCnh(): ChainedValidator;

    public function undefOfCnpj(): ChainedValidator;

    public function undefOfConsecutive(
        Validatable $rule1,
        Validatable $rule2,
        Validatable ...$rules,
    ): ChainedValidator;

    public function undefOfConsonant(string ...$additionalChars): ChainedValidator;

    public function undefOfContains(mixed $containsValue, bool $identical = false): ChainedValidator;

    /**
     * @param non-empty-array<mixed> $needles
     */
    public function undefOfContainsAny(array $needles, bool $identical = false): ChainedValidator;

    public function undefOfControl(string ...$additionalChars): ChainedValidator;

    public function undefOfCountable(): ChainedValidator;

    /**
     * @param "alpha-2"|"alpha-3"|"numeric" $set
     */
    public function undefOfCountryCode(string $set = 'alpha-2'): ChainedValidator;

    public function undefOfCpf(): ChainedValidator;

    public function undefOfCreditCard(string $brand = 'Any'): ChainedValidator;

    /**
     * @param "alpha-3"|"numeric" $set
     */
    public function undefOfCurrencyCode(string $set = 'alpha-3'): ChainedValidator;

    public function undefOfDate(string $format = 'Y-m-d'): ChainedValidator;

    public function undefOfDateTime(?string $format = null): ChainedValidator;

    public function undefOfDecimal(int $decimals): ChainedValidator;

    public function undefOfDigit(string ...$additionalChars): ChainedValidator;

    public function undefOfDirectory(): ChainedValidator;

    public function undefOfDomain(bool $tldCheck = true): ChainedValidator;

    public function undefOfEach(Validatable $rule): ChainedValidator;

    public function undefOfEmail(): ChainedValidator;

    public function undefOfEndsWith(mixed $endValue, bool $identical = false): ChainedValidator;

    public function undefOfEquals(mixed $compareTo): ChainedValidator;

    public function undefOfEquivalent(mixed $compareTo): ChainedValidator;

    public function undefOfEven(): ChainedValidator;

    public function undefOfExecutable(): ChainedValidator;

    public function undefOfExists(): ChainedValidator;

    public function undefOfExtension(string $extension): ChainedValidator;

    public function undefOfFactor(int $dividend): ChainedValidator;

    public function undefOfFalseVal(): ChainedValidator;

    public function undefOfFibonacci(): ChainedValidator;

    public function undefOfFile(): ChainedValidator;

    public function undefOfFilterVar(int $filter, mixed $options = null): ChainedValidator;

    public function undefOfFinite(): ChainedValidator;

    public function undefOfFloatType(): ChainedValidator;

    public function undefOfFloatVal(): ChainedValidator;

    public function undefOfGraph(string ...$additionalChars): ChainedValidator;

    public function undefOfGreaterThan(mixed $compareTo): ChainedValidator;

    public function undefOfGreaterThanOrEqual(mixed $compareTo): ChainedValidator;

    public function undefOfHetu(): ChainedValidator;

    public function undefOfHexRgbColor(): ChainedValidator;

    public function undefOfIban(): ChainedValidator;

    public function undefOfIdentical(mixed $compareTo): ChainedValidator;

    public function undefOfImage(): ChainedValidator;

    public function undefOfImei(): ChainedValidator;

    public function undefOfIn(mixed $haystack, bool $compareIdentical = false): ChainedValidator;

    public function undefOfInfinite(): ChainedValidator;

    /**
     * @param class-string $class
     */
    public function undefOfInstance(string $class): ChainedValidator;

    public function undefOfIntType(): ChainedValidator;

    public function undefOfIntVal(): ChainedValidator;

    public function undefOfIp(string $range = '*', ?int $options = null): ChainedValidator;

    public function undefOfIsbn(): ChainedValidator;

    public function undefOfIterableType(): ChainedValidator;

    public function undefOfIterableVal(): ChainedValidator;

    public function undefOfJson(): ChainedValidator;

    public function undefOfKey(string|int $key, Validatable $rule): ChainedValidator;

    public function undefOfKeyExists(string|int $key): ChainedValidator;

    public function undefOfKeyOptional(string|int $key, Validatable $rule): ChainedValidator;

    public function undefOfKeySet(Validatable $rule, Validatable ...$rules): ChainedValidator;

    /**
     * @param "alpha-2"|"alpha-3" $set
     */
    public function undefOfLanguageCode(string $set = 'alpha-2'): ChainedValidator;

    /**
     * @param callable(mixed): Validatable $ruleCreator
     */
    public function undefOfLazy(callable $ruleCreator): ChainedValidator;

    public function undefOfLeapDate(string $format): ChainedValidator;

    public function undefOfLeapYear(): ChainedValidator;

    public function undefOfLength(Validatable $rule): ChainedValidator;

    public function undefOfLessThan(mixed $compareTo): ChainedValidator;

    public function undefOfLessThanOrEqual(mixed $compareTo): ChainedValidator;

    public function undefOfLowercase(): ChainedValidator;

    public function undefOfLuhn(): ChainedValidator;

    public function undefOfMacAddress(): ChainedValidator;

    public function undefOfMax(Validatable $rule): ChainedValidator;

    public function undefOfMaxAge(int $age, ?string $format = null): ChainedValidator;

    public function undefOfMimetype(string $mimetype): ChainedValidator;

    public function undefOfMin(Validatable $rule): ChainedValidator;

    public function undefOfMinAge(int $age, ?string $format = null): ChainedValidator;

    public function undefOfMultiple(int $multipleOf): ChainedValidator;

    public function undefOfNegative(): ChainedValidator;

    public function undefOfNfeAccessKey(): ChainedValidator;

    public function undefOfNif(): ChainedValidator;

    public function undefOfNip(): ChainedValidator;

    public function undefOfNo(bool $useLocale = false): ChainedValidator;

    public function undefOfNoWhitespace(): ChainedValidator;

    public function undefOfNoneOf(Validatable $rule1, Validatable $rule2, Validatable ...$rules): ChainedValidator;

    public function undefOfNot(Validatable $rule): ChainedValidator;

    public function undefOfNotBlank(): ChainedValidator;

    public function undefOfNotEmoji(): ChainedValidator;

    public function undefOfNotEmpty(): ChainedValidator;

    public function undefOfNotOptional(): ChainedValidator;

    public function undefOfNullType(): ChainedValidator;

    public function undefOfNumber(): ChainedValidator;

    public function undefOfNumericVal(): ChainedValidator;

    public function undefOfObjectType(): ChainedValidator;

    public function undefOfOdd(): ChainedValidator;

    public function undefOfOneOf(Validatable $rule1, Validatable $rule2, Validatable ...$rules): ChainedValidator;

    public function undefOfPerfectSquare(): ChainedValidator;

    public function undefOfPesel(): ChainedValidator;

    public function undefOfPhone(?string $countryCode = null): ChainedValidator;

    public function undefOfPhpLabel(): ChainedValidator;

    public function undefOfPis(): ChainedValidator;

    public function undefOfPolishIdCard(): ChainedValidator;

    public function undefOfPortugueseNif(): ChainedValidator;

    public function undefOfPositive(): ChainedValidator;

    public function undefOfPostalCode(string $countryCode, bool $formatted = false): ChainedValidator;

    public function undefOfPrimeNumber(): ChainedValidator;

    public function undefOfPrintable(string ...$additionalChars): ChainedValidator;

    public function undefOfProperty(string $propertyName, Validatable $rule): ChainedValidator;

    public function undefOfPropertyExists(string $propertyName): ChainedValidator;

    public function undefOfPropertyOptional(string $propertyName, Validatable $rule): ChainedValidator;

    public function undefOfPublicDomainSuffix(): ChainedValidator;

    public function undefOfPunct(string ...$additionalChars): ChainedValidator;

    public function undefOfReadable(): ChainedValidator;

    public function undefOfRegex(string $regex): ChainedValidator;

    public function undefOfResourceType(): ChainedValidator;

    public function undefOfRoman(): ChainedValidator;

    public function undefOfScalarVal(): ChainedValidator;

    public function undefOfSize(string|int|null $minSize = null, string|int|null $maxSize = null): ChainedValidator;

    public function undefOfSlug(): ChainedValidator;

    public function undefOfSorted(string $direction): ChainedValidator;

    public function undefOfSpace(string ...$additionalChars): ChainedValidator;

    public function undefOfStartsWith(mixed $startValue, bool $identical = false): ChainedValidator;

    public function undefOfStringType(): ChainedValidator;

    public function undefOfStringVal(): ChainedValidator;

    public function undefOfSubdivisionCode(string $countryCode): ChainedValidator;

    /**
     * @param mixed[] $superset
     */
    public function undefOfSubset(array $superset): ChainedValidator;

    public function undefOfSymbolicLink(): ChainedValidator;

    public function undefOfTime(string $format = 'H:i:s'): ChainedValidator;

    public function undefOfTld(): ChainedValidator;

    public function undefOfTrueVal(): ChainedValidator;

    public function undefOfUnique(): ChainedValidator;

    public function undefOfUploaded(): ChainedValidator;

    public function undefOfUppercase(): ChainedValidator;

    public function undefOfUrl(): ChainedValidator;

    public function undefOfUuid(?int $version = null): ChainedValidator;

    public function undefOfVersion(): ChainedValidator;

    public function undefOfVideoUrl(?string $service = null): ChainedValidator;

    public function undefOfVowel(string ...$additionalChars): ChainedValidator;

    public function undefOfWhen(Validatable $when, Validatable $then, ?Validatable $else = null): ChainedValidator;

    public function undefOfWritable(): ChainedValidator;

    public function undefOfXdigit(string ...$additionalChars): ChainedValidator;

    public function undefOfYes(bool $useLocale = false): ChainedValidator;
}
