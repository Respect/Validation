<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Mixins;

use DateTimeImmutable;
use Respect\Validation\Rule;

interface NotChain
{
    public function notAllOf(Rule $rule1, Rule $rule2, Rule ...$rules): Chain;

    public function notAlnum(string ...$additionalChars): Chain;

    public function notAlpha(string ...$additionalChars): Chain;

    public function notAlwaysInvalid(): Chain;

    public function notAlwaysValid(): Chain;

    public function notAnyOf(Rule $rule1, Rule $rule2, Rule ...$rules): Chain;

    public function notArrayType(): Chain;

    public function notArrayVal(): Chain;

    public function notBase(
        int $base,
        string $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
    ): Chain;

    public function notBase64(): Chain;

    public function notBetween(mixed $minValue, mixed $maxValue): Chain;

    public function notBetweenExclusive(mixed $minimum, mixed $maximum): Chain;

    public function notBoolType(): Chain;

    public function notBoolVal(): Chain;

    public function notBsn(): Chain;

    public function notCall(callable $callable, Rule $rule): Chain;

    public function notCallableType(): Chain;

    public function notCallback(callable $callback, mixed ...$arguments): Chain;

    public function notCharset(string $charset, string ...$charsets): Chain;

    public function notCnh(): Chain;

    public function notCnpj(): Chain;

    public function notConsecutive(Rule $rule1, Rule $rule2, Rule ...$rules): Chain;

    public function notConsonant(string ...$additionalChars): Chain;

    public function notContains(mixed $containsValue, bool $identical = false): Chain;

    /**
     * @param non-empty-array<mixed> $needles
     */
    public function notContainsAny(array $needles, bool $identical = false): Chain;

    public function notControl(string ...$additionalChars): Chain;

    public function notCountable(): Chain;

    /**
     * @param "alpha-2"|"alpha-3"|"numeric" $set
     */
    public function notCountryCode(string $set = 'alpha-2'): Chain;

    public function notCpf(): Chain;

    public function notCreditCard(string $brand = 'Any'): Chain;

    /**
     * @param "alpha-3"|"numeric" $set
     */
    public function notCurrencyCode(string $set = 'alpha-3'): Chain;

    public function notDate(string $format = 'Y-m-d'): Chain;

    public function notDateTime(?string $format = null): Chain;

    /**
     * @param "years"|"months"|"days"|"hours"|"minutes"|"seconds"|"microseconds" $type
     */
    public function notDateTimeDiff(
        string $type,
        Rule $rule,
        ?string $format = null,
        ?DateTimeImmutable $now = null,
    ): Chain;

    public function notDecimal(int $decimals): Chain;

    public function notDigit(string ...$additionalChars): Chain;

    public function notDirectory(): Chain;

    public function notDomain(bool $tldCheck = true): Chain;

    public function notEach(Rule $rule): Chain;

    public function notEmail(): Chain;

    public function notEndsWith(mixed $endValue, bool $identical = false): Chain;

    public function notEquals(mixed $compareTo): Chain;

    public function notEquivalent(mixed $compareTo): Chain;

    public function notEven(): Chain;

    public function notExecutable(): Chain;

    public function notExists(): Chain;

    public function notExtension(string $extension): Chain;

    public function notFactor(int $dividend): Chain;

    public function notFalseVal(): Chain;

    public function notFibonacci(): Chain;

    public function notFile(): Chain;

    public function notFilterVar(int $filter, mixed $options = null): Chain;

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

    public function notIn(mixed $haystack, bool $compareIdentical = false): Chain;

    public function notInfinite(): Chain;

    /**
     * @param class-string $class
     */
    public function notInstance(string $class): Chain;

    public function notIntType(): Chain;

    public function notIntVal(): Chain;

    public function notIp(string $range = '*', ?int $options = null): Chain;

    public function notIsbn(): Chain;

    public function notIterableType(): Chain;

    public function notIterableVal(): Chain;

    public function notJson(): Chain;

    public function notKey(string|int $key, Rule $rule): Chain;

    public function notKeyExists(string|int $key): Chain;

    public function notKeyOptional(string|int $key, Rule $rule): Chain;

    public function notKeySet(Rule $rule, Rule ...$rules): Chain;

    /**
     * @param "alpha-2"|"alpha-3" $set
     */
    public function notLanguageCode(string $set = 'alpha-2'): Chain;

    /**
     * @param callable(mixed): Rule $ruleCreator
     */
    public function notLazy(callable $ruleCreator): Chain;

    public function notLeapDate(string $format): Chain;

    public function notLeapYear(): Chain;

    public function notLength(Rule $rule): Chain;

    public function notLessThan(mixed $compareTo): Chain;

    public function notLessThanOrEqual(mixed $compareTo): Chain;

    public function notLowercase(): Chain;

    public function notLuhn(): Chain;

    public function notMacAddress(): Chain;

    public function notMax(Rule $rule): Chain;

    public function notMimetype(string $mimetype): Chain;

    public function notMin(Rule $rule): Chain;

    public function notMultiple(int $multipleOf): Chain;

    public function notNegative(): Chain;

    public function notNfeAccessKey(): Chain;

    public function notNif(): Chain;

    public function notNip(): Chain;

    public function notNo(bool $useLocale = false): Chain;

    public function notNoWhitespace(): Chain;

    public function notNoneOf(Rule $rule1, Rule $rule2, Rule ...$rules): Chain;

    public function notNullType(): Chain;

    public function notNumber(): Chain;

    public function notNumericVal(): Chain;

    public function notObjectType(): Chain;

    public function notOdd(): Chain;

    public function notOneOf(Rule $rule1, Rule $rule2, Rule ...$rules): Chain;

    public function notPerfectSquare(): Chain;

    public function notPesel(): Chain;

    public function notPhone(?string $countryCode = null): Chain;

    public function notPhpLabel(): Chain;

    public function notPis(): Chain;

    public function notPolishIdCard(): Chain;

    public function notPortugueseNif(): Chain;

    public function notPositive(): Chain;

    public function notPostalCode(string $countryCode, bool $formatted = false): Chain;

    public function notPrimeNumber(): Chain;

    public function notPrintable(string ...$additionalChars): Chain;

    public function notProperty(string $propertyName, Rule $rule): Chain;

    public function notPropertyExists(string $propertyName): Chain;

    public function notPropertyOptional(string $propertyName, Rule $rule): Chain;

    public function notPublicDomainSuffix(): Chain;

    public function notPunct(string ...$additionalChars): Chain;

    public function notReadable(): Chain;

    public function notRegex(string $regex): Chain;

    public function notResourceType(): Chain;

    public function notRoman(): Chain;

    public function notScalarVal(): Chain;

    /**
     * @param "B"|"KB"|"MB"|"GB"|"TB"|"PB"|"EB"|"ZB"|"YB" $unit
     */
    public function notSize(string $unit, Rule $rule): Chain;

    public function notSlug(): Chain;

    public function notSorted(string $direction): Chain;

    public function notSpace(string ...$additionalChars): Chain;

    public function notStartsWith(mixed $startValue, bool $identical = false): Chain;

    public function notStringType(): Chain;

    public function notStringVal(): Chain;

    public function notSubdivisionCode(string $countryCode): Chain;

    /**
     * @param mixed[] $superset
     */
    public function notSubset(array $superset): Chain;

    public function notSymbolicLink(): Chain;

    public function notTime(string $format = 'H:i:s'): Chain;

    public function notTld(): Chain;

    public function notTrueVal(): Chain;

    public function notUnique(): Chain;

    public function notUploaded(): Chain;

    public function notUppercase(): Chain;

    public function notUrl(): Chain;

    public function notUuid(?int $version = null): Chain;

    public function notVersion(): Chain;

    public function notVideoUrl(?string $service = null): Chain;

    public function notVowel(string ...$additionalChars): Chain;

    public function notWhen(Rule $when, Rule $then, ?Rule $else = null): Chain;

    public function notWritable(): Chain;

    public function notXdigit(string ...$additionalChars): Chain;

    public function notYes(bool $useLocale = false): Chain;
}
