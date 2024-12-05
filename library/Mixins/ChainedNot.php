<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Mixins;

use DateTimeImmutable;
use Respect\Validation\Rule;

interface ChainedNot
{
    public function notAllOf(Rule $rule1, Rule $rule2, Rule ...$rules): ChainedValidator;

    public function notAlnum(string ...$additionalChars): ChainedValidator;

    public function notAlpha(string ...$additionalChars): ChainedValidator;

    public function notAlwaysInvalid(): ChainedValidator;

    public function notAlwaysValid(): ChainedValidator;

    public function notAnyOf(Rule $rule1, Rule $rule2, Rule ...$rules): ChainedValidator;

    public function notArrayType(): ChainedValidator;

    public function notArrayVal(): ChainedValidator;

    public function notBase(
        int $base,
        string $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
    ): ChainedValidator;

    public function notBase64(): ChainedValidator;

    public function notBetween(mixed $minValue, mixed $maxValue): ChainedValidator;

    public function notBetweenExclusive(mixed $minimum, mixed $maximum): ChainedValidator;

    public function notBoolType(): ChainedValidator;

    public function notBoolVal(): ChainedValidator;

    public function notBsn(): ChainedValidator;

    public function notCall(callable $callable, Rule $rule): ChainedValidator;

    public function notCallableType(): ChainedValidator;

    public function notCallback(callable $callback, mixed ...$arguments): ChainedValidator;

    public function notCharset(string $charset, string ...$charsets): ChainedValidator;

    public function notCnh(): ChainedValidator;

    public function notCnpj(): ChainedValidator;

    public function notConsecutive(Rule $rule1, Rule $rule2, Rule ...$rules): ChainedValidator;

    public function notConsonant(string ...$additionalChars): ChainedValidator;

    public function notContains(mixed $containsValue, bool $identical = false): ChainedValidator;

    /**
     * @param non-empty-array<mixed> $needles
     */
    public function notContainsAny(array $needles, bool $identical = false): ChainedValidator;

    public function notControl(string ...$additionalChars): ChainedValidator;

    public function notCountable(): ChainedValidator;

    /**
     * @param "alpha-2"|"alpha-3"|"numeric" $set
     */
    public function notCountryCode(string $set = 'alpha-2'): ChainedValidator;

    public function notCpf(): ChainedValidator;

    public function notCreditCard(string $brand = 'Any'): ChainedValidator;

    /**
     * @param "alpha-3"|"numeric" $set
     */
    public function notCurrencyCode(string $set = 'alpha-3'): ChainedValidator;

    public function notDate(string $format = 'Y-m-d'): ChainedValidator;

    public function notDateTime(?string $format = null): ChainedValidator;

    /**
     * @param "years"|"months"|"days"|"hours"|"minutes"|"seconds"|"microseconds" $type
     */
    public function notDateTimeDiff(
        string $type,
        Rule $rule,
        ?string $format = null,
        ?DateTimeImmutable $now = null,
    ): ChainedValidator;

    public function notDecimal(int $decimals): ChainedValidator;

    public function notDigit(string ...$additionalChars): ChainedValidator;

    public function notDirectory(): ChainedValidator;

    public function notDomain(bool $tldCheck = true): ChainedValidator;

    public function notEach(Rule $rule): ChainedValidator;

    public function notEmail(): ChainedValidator;

    public function notEndsWith(mixed $endValue, bool $identical = false): ChainedValidator;

    public function notEquals(mixed $compareTo): ChainedValidator;

    public function notEquivalent(mixed $compareTo): ChainedValidator;

    public function notEven(): ChainedValidator;

    public function notExecutable(): ChainedValidator;

    public function notExists(): ChainedValidator;

    public function notExtension(string $extension): ChainedValidator;

    public function notFactor(int $dividend): ChainedValidator;

    public function notFalseVal(): ChainedValidator;

    public function notFibonacci(): ChainedValidator;

    public function notFile(): ChainedValidator;

    public function notFilterVar(int $filter, mixed $options = null): ChainedValidator;

    public function notFinite(): ChainedValidator;

    public function notFloatType(): ChainedValidator;

    public function notFloatVal(): ChainedValidator;

    public function notGraph(string ...$additionalChars): ChainedValidator;

    public function notGreaterThan(mixed $compareTo): ChainedValidator;

    public function notGreaterThanOrEqual(mixed $compareTo): ChainedValidator;

    public function notHetu(): ChainedValidator;

    public function notHexRgbColor(): ChainedValidator;

    public function notIban(): ChainedValidator;

    public function notIdentical(mixed $compareTo): ChainedValidator;

    public function notImage(): ChainedValidator;

    public function notImei(): ChainedValidator;

    public function notIn(mixed $haystack, bool $compareIdentical = false): ChainedValidator;

    public function notInfinite(): ChainedValidator;

    /**
     * @param class-string $class
     */
    public function notInstance(string $class): ChainedValidator;

    public function notIntType(): ChainedValidator;

    public function notIntVal(): ChainedValidator;

    public function notIp(string $range = '*', ?int $options = null): ChainedValidator;

    public function notIsbn(): ChainedValidator;

    public function notIterableType(): ChainedValidator;

    public function notIterableVal(): ChainedValidator;

    public function notJson(): ChainedValidator;

    public function notKey(string|int $key, Rule $rule): ChainedValidator;

    public function notKeyExists(string|int $key): ChainedValidator;

    public function notKeyOptional(string|int $key, Rule $rule): ChainedValidator;

    public function notKeySet(Rule $rule, Rule ...$rules): ChainedValidator;

    /**
     * @param "alpha-2"|"alpha-3" $set
     */
    public function notLanguageCode(string $set = 'alpha-2'): ChainedValidator;

    /**
     * @param callable(mixed): Rule $ruleCreator
     */
    public function notLazy(callable $ruleCreator): ChainedValidator;

    public function notLeapDate(string $format): ChainedValidator;

    public function notLeapYear(): ChainedValidator;

    public function notLength(Rule $rule): ChainedValidator;

    public function notLessThan(mixed $compareTo): ChainedValidator;

    public function notLessThanOrEqual(mixed $compareTo): ChainedValidator;

    public function notLowercase(): ChainedValidator;

    public function notLuhn(): ChainedValidator;

    public function notMacAddress(): ChainedValidator;

    public function notMax(Rule $rule): ChainedValidator;

    public function notMimetype(string $mimetype): ChainedValidator;

    public function notMin(Rule $rule): ChainedValidator;

    public function notMultiple(int $multipleOf): ChainedValidator;

    public function notNegative(): ChainedValidator;

    public function notNfeAccessKey(): ChainedValidator;

    public function notNif(): ChainedValidator;

    public function notNip(): ChainedValidator;

    public function notNo(bool $useLocale = false): ChainedValidator;

    public function notNoWhitespace(): ChainedValidator;

    public function notNoneOf(Rule $rule1, Rule $rule2, Rule ...$rules): ChainedValidator;

    public function notNullType(): ChainedValidator;

    public function notNumber(): ChainedValidator;

    public function notNumericVal(): ChainedValidator;

    public function notObjectType(): ChainedValidator;

    public function notOdd(): ChainedValidator;

    public function notOneOf(Rule $rule1, Rule $rule2, Rule ...$rules): ChainedValidator;

    public function notPerfectSquare(): ChainedValidator;

    public function notPesel(): ChainedValidator;

    public function notPhone(?string $countryCode = null): ChainedValidator;

    public function notPhpLabel(): ChainedValidator;

    public function notPis(): ChainedValidator;

    public function notPolishIdCard(): ChainedValidator;

    public function notPortugueseNif(): ChainedValidator;

    public function notPositive(): ChainedValidator;

    public function notPostalCode(string $countryCode, bool $formatted = false): ChainedValidator;

    public function notPrimeNumber(): ChainedValidator;

    public function notPrintable(string ...$additionalChars): ChainedValidator;

    public function notProperty(string $propertyName, Rule $rule): ChainedValidator;

    public function notPropertyExists(string $propertyName): ChainedValidator;

    public function notPropertyOptional(string $propertyName, Rule $rule): ChainedValidator;

    public function notPublicDomainSuffix(): ChainedValidator;

    public function notPunct(string ...$additionalChars): ChainedValidator;

    public function notReadable(): ChainedValidator;

    public function notRegex(string $regex): ChainedValidator;

    public function notResourceType(): ChainedValidator;

    public function notRoman(): ChainedValidator;

    public function notScalarVal(): ChainedValidator;

    public function notSize(string|int|null $minSize = null, string|int|null $maxSize = null): ChainedValidator;

    public function notSlug(): ChainedValidator;

    public function notSorted(string $direction): ChainedValidator;

    public function notSpace(string ...$additionalChars): ChainedValidator;

    public function notStartsWith(mixed $startValue, bool $identical = false): ChainedValidator;

    public function notStringType(): ChainedValidator;

    public function notStringVal(): ChainedValidator;

    public function notSubdivisionCode(string $countryCode): ChainedValidator;

    /**
     * @param mixed[] $superset
     */
    public function notSubset(array $superset): ChainedValidator;

    public function notSymbolicLink(): ChainedValidator;

    public function notTime(string $format = 'H:i:s'): ChainedValidator;

    public function notTld(): ChainedValidator;

    public function notTrueVal(): ChainedValidator;

    public function notUnique(): ChainedValidator;

    public function notUploaded(): ChainedValidator;

    public function notUppercase(): ChainedValidator;

    public function notUrl(): ChainedValidator;

    public function notUuid(?int $version = null): ChainedValidator;

    public function notVersion(): ChainedValidator;

    public function notVideoUrl(?string $service = null): ChainedValidator;

    public function notVowel(string ...$additionalChars): ChainedValidator;

    public function notWhen(Rule $when, Rule $then, ?Rule $else = null): ChainedValidator;

    public function notWritable(): ChainedValidator;

    public function notXdigit(string ...$additionalChars): ChainedValidator;

    public function notYes(bool $useLocale = false): ChainedValidator;
}
