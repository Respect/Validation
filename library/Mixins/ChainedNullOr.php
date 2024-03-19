<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Mixins;

use Respect\Validation\Validatable;

interface ChainedNullOr
{
    public function nullOfAllOf(Validatable $rule1, Validatable $rule2, Validatable ...$rules): ChainedValidator;

    public function nullOfAlnum(string ...$additionalChars): ChainedValidator;

    public function nullOfAlpha(string ...$additionalChars): ChainedValidator;

    public function nullOfAlwaysInvalid(): ChainedValidator;

    public function nullOfAlwaysValid(): ChainedValidator;

    public function nullOfAnyOf(Validatable $rule1, Validatable $rule2, Validatable ...$rules): ChainedValidator;

    public function nullOfArrayType(): ChainedValidator;

    public function nullOfArrayVal(): ChainedValidator;

    public function nullOfBase(
        int $base,
        string $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
    ): ChainedValidator;

    public function nullOfBase64(): ChainedValidator;

    public function nullOfBetween(mixed $minValue, mixed $maxValue): ChainedValidator;

    public function nullOfBetweenExclusive(mixed $minimum, mixed $maximum): ChainedValidator;

    public function nullOfBoolType(): ChainedValidator;

    public function nullOfBoolVal(): ChainedValidator;

    public function nullOfBsn(): ChainedValidator;

    public function nullOfCall(callable $callable, Validatable $rule): ChainedValidator;

    public function nullOfCallableType(): ChainedValidator;

    public function nullOfCallback(callable $callback, mixed ...$arguments): ChainedValidator;

    public function nullOfCharset(string $charset, string ...$charsets): ChainedValidator;

    public function nullOfCnh(): ChainedValidator;

    public function nullOfCnpj(): ChainedValidator;

    public function nullOfConsecutive(Validatable $rule1, Validatable $rule2, Validatable ...$rules): ChainedValidator;

    public function nullOfConsonant(string ...$additionalChars): ChainedValidator;

    public function nullOfContains(mixed $containsValue, bool $identical = false): ChainedValidator;

    /**
     * @param non-empty-array<mixed> $needles
     */
    public function nullOfContainsAny(array $needles, bool $identical = false): ChainedValidator;

    public function nullOfControl(string ...$additionalChars): ChainedValidator;

    public function nullOfCountable(): ChainedValidator;

    /**
     * @param "alpha-2"|"alpha-3"|"numeric" $set
     */
    public function nullOfCountryCode(string $set = 'alpha-2'): ChainedValidator;

    public function nullOfCpf(): ChainedValidator;

    public function nullOfCreditCard(string $brand = 'Any'): ChainedValidator;

    /**
     * @param "alpha-3"|"numeric" $set
     */
    public function nullOfCurrencyCode(string $set = 'alpha-3'): ChainedValidator;

    public function nullOfDate(string $format = 'Y-m-d'): ChainedValidator;

    public function nullOfDateTime(?string $format = null): ChainedValidator;

    public function nullOfDecimal(int $decimals): ChainedValidator;

    public function nullOfDigit(string ...$additionalChars): ChainedValidator;

    public function nullOfDirectory(): ChainedValidator;

    public function nullOfDomain(bool $tldCheck = true): ChainedValidator;

    public function nullOfEach(Validatable $rule): ChainedValidator;

    public function nullOfEmail(): ChainedValidator;

    public function nullOfEndsWith(mixed $endValue, bool $identical = false): ChainedValidator;

    public function nullOfEquals(mixed $compareTo): ChainedValidator;

    public function nullOfEquivalent(mixed $compareTo): ChainedValidator;

    public function nullOfEven(): ChainedValidator;

    public function nullOfExecutable(): ChainedValidator;

    public function nullOfExists(): ChainedValidator;

    public function nullOfExtension(string $extension): ChainedValidator;

    public function nullOfFactor(int $dividend): ChainedValidator;

    public function nullOfFalseVal(): ChainedValidator;

    public function nullOfFibonacci(): ChainedValidator;

    public function nullOfFile(): ChainedValidator;

    public function nullOfFilterVar(int $filter, mixed $options = null): ChainedValidator;

    public function nullOfFinite(): ChainedValidator;

    public function nullOfFloatType(): ChainedValidator;

    public function nullOfFloatVal(): ChainedValidator;

    public function nullOfGraph(string ...$additionalChars): ChainedValidator;

    public function nullOfGreaterThan(mixed $compareTo): ChainedValidator;

    public function nullOfGreaterThanOrEqual(mixed $compareTo): ChainedValidator;

    public function nullOfHetu(): ChainedValidator;

    public function nullOfHexRgbColor(): ChainedValidator;

    public function nullOfIban(): ChainedValidator;

    public function nullOfIdentical(mixed $compareTo): ChainedValidator;

    public function nullOfImage(): ChainedValidator;

    public function nullOfImei(): ChainedValidator;

    public function nullOfIn(mixed $haystack, bool $compareIdentical = false): ChainedValidator;

    public function nullOfInfinite(): ChainedValidator;

    /**
     * @param class-string $class
     */
    public function nullOfInstance(string $class): ChainedValidator;

    public function nullOfIntType(): ChainedValidator;

    public function nullOfIntVal(): ChainedValidator;

    public function nullOfIp(string $range = '*', ?int $options = null): ChainedValidator;

    public function nullOfIsbn(): ChainedValidator;

    public function nullOfIterableType(): ChainedValidator;

    public function nullOfIterableVal(): ChainedValidator;

    public function nullOfJson(): ChainedValidator;

    public function nullOfKey(string|int $key, Validatable $rule): ChainedValidator;

    public function nullOfKeyExists(string|int $key): ChainedValidator;

    public function nullOfKeyOptional(string|int $key, Validatable $rule): ChainedValidator;

    public function nullOfKeySet(Validatable $rule, Validatable ...$rules): ChainedValidator;

    /**
     * @param "alpha-2"|"alpha-3" $set
     */
    public function nullOfLanguageCode(string $set = 'alpha-2'): ChainedValidator;

    /**
     * @param callable(mixed): Validatable $ruleCreator
     */
    public function nullOfLazy(callable $ruleCreator): ChainedValidator;

    public function nullOfLeapDate(string $format): ChainedValidator;

    public function nullOfLeapYear(): ChainedValidator;

    public function nullOfLength(Validatable $rule): ChainedValidator;

    public function nullOfLessThan(mixed $compareTo): ChainedValidator;

    public function nullOfLessThanOrEqual(mixed $compareTo): ChainedValidator;

    public function nullOfLowercase(): ChainedValidator;

    public function nullOfLuhn(): ChainedValidator;

    public function nullOfMacAddress(): ChainedValidator;

    public function nullOfMax(Validatable $rule): ChainedValidator;

    public function nullOfMaxAge(int $age, ?string $format = null): ChainedValidator;

    public function nullOfMimetype(string $mimetype): ChainedValidator;

    public function nullOfMin(Validatable $rule): ChainedValidator;

    public function nullOfMinAge(int $age, ?string $format = null): ChainedValidator;

    public function nullOfMultiple(int $multipleOf): ChainedValidator;

    public function nullOfNegative(): ChainedValidator;

    public function nullOfNfeAccessKey(): ChainedValidator;

    public function nullOfNif(): ChainedValidator;

    public function nullOfNip(): ChainedValidator;

    public function nullOfNo(bool $useLocale = false): ChainedValidator;

    public function nullOfNoWhitespace(): ChainedValidator;

    public function nullOfNoneOf(Validatable $rule1, Validatable $rule2, Validatable ...$rules): ChainedValidator;

    public function nullOfNot(Validatable $rule): ChainedValidator;

    public function nullOfNotBlank(): ChainedValidator;

    public function nullOfNotEmoji(): ChainedValidator;

    public function nullOfNotEmpty(): ChainedValidator;

    public function nullOfNotOptional(): ChainedValidator;

    public function nullOfNullType(): ChainedValidator;

    public function nullOfNumber(): ChainedValidator;

    public function nullOfNumericVal(): ChainedValidator;

    public function nullOfObjectType(): ChainedValidator;

    public function nullOfOdd(): ChainedValidator;

    public function nullOfOneOf(Validatable $rule1, Validatable $rule2, Validatable ...$rules): ChainedValidator;

    public function nullOfPerfectSquare(): ChainedValidator;

    public function nullOfPesel(): ChainedValidator;

    public function nullOfPhone(?string $countryCode = null): ChainedValidator;

    public function nullOfPhpLabel(): ChainedValidator;

    public function nullOfPis(): ChainedValidator;

    public function nullOfPolishIdCard(): ChainedValidator;

    public function nullOfPortugueseNif(): ChainedValidator;

    public function nullOfPositive(): ChainedValidator;

    public function nullOfPostalCode(string $countryCode, bool $formatted = false): ChainedValidator;

    public function nullOfPrimeNumber(): ChainedValidator;

    public function nullOfPrintable(string ...$additionalChars): ChainedValidator;

    public function nullOfProperty(string $propertyName, Validatable $rule): ChainedValidator;

    public function nullOfPropertyExists(string $propertyName): ChainedValidator;

    public function nullOfPropertyOptional(string $propertyName, Validatable $rule): ChainedValidator;

    public function nullOfPublicDomainSuffix(): ChainedValidator;

    public function nullOfPunct(string ...$additionalChars): ChainedValidator;

    public function nullOfReadable(): ChainedValidator;

    public function nullOfRegex(string $regex): ChainedValidator;

    public function nullOfResourceType(): ChainedValidator;

    public function nullOfRoman(): ChainedValidator;

    public function nullOfScalarVal(): ChainedValidator;

    public function nullOfSize(string|int|null $minSize = null, string|int|null $maxSize = null): ChainedValidator;

    public function nullOfSlug(): ChainedValidator;

    public function nullOfSorted(string $direction): ChainedValidator;

    public function nullOfSpace(string ...$additionalChars): ChainedValidator;

    public function nullOfStartsWith(mixed $startValue, bool $identical = false): ChainedValidator;

    public function nullOfStringType(): ChainedValidator;

    public function nullOfStringVal(): ChainedValidator;

    public function nullOfSubdivisionCode(string $countryCode): ChainedValidator;

    /**
     * @param mixed[] $superset
     */
    public function nullOfSubset(array $superset): ChainedValidator;

    public function nullOfSymbolicLink(): ChainedValidator;

    public function nullOfTime(string $format = 'H:i:s'): ChainedValidator;

    public function nullOfTld(): ChainedValidator;

    public function nullOfTrueVal(): ChainedValidator;

    public function nullOfUnique(): ChainedValidator;

    public function nullOfUploaded(): ChainedValidator;

    public function nullOfUppercase(): ChainedValidator;

    public function nullOfUrl(): ChainedValidator;

    public function nullOfUuid(?int $version = null): ChainedValidator;

    public function nullOfVersion(): ChainedValidator;

    public function nullOfVideoUrl(?string $service = null): ChainedValidator;

    public function nullOfVowel(string ...$additionalChars): ChainedValidator;

    public function nullOfWhen(Validatable $when, Validatable $then, ?Validatable $else = null): ChainedValidator;

    public function nullOfWritable(): ChainedValidator;

    public function nullOfXdigit(string ...$additionalChars): ChainedValidator;

    public function nullOfYes(bool $useLocale = false): ChainedValidator;
}
