<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Mixins;

use DateTimeImmutable;
use Respect\Validation\Validator;

interface UndefOrChain
{
    public function undefOrAll(Validator $validator): Chain;

    public function undefOrAlnum(string ...$additionalChars): Chain;

    public function undefOrAlpha(string ...$additionalChars): Chain;

    public function undefOrAlwaysInvalid(): Chain;

    public function undefOrAlwaysValid(): Chain;

    public function undefOrArrayType(): Chain;

    public function undefOrArrayVal(): Chain;

    public function undefOrBase(
        int $base,
        string $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
    ): Chain;

    public function undefOrBase64(): Chain;

    public function undefOrBetween(mixed $minValue, mixed $maxValue): Chain;

    public function undefOrBetweenExclusive(mixed $minimum, mixed $maximum): Chain;

    public function undefOrBoolType(): Chain;

    public function undefOrBoolVal(): Chain;

    public function undefOrBsn(): Chain;

    public function undefOrCall(callable $callable, Validator $validator): Chain;

    public function undefOrCallableType(): Chain;

    public function undefOrCallback(callable $callback, mixed ...$arguments): Chain;

    public function undefOrCharset(string $charset, string ...$charsets): Chain;

    public function undefOrCircuit(Validator $validator1, Validator $validator2, Validator ...$validators): Chain;

    public function undefOrCnh(): Chain;

    public function undefOrCnpj(): Chain;

    public function undefOrConsonant(string ...$additionalChars): Chain;

    public function undefOrContains(mixed $containsValue, bool $identical = false): Chain;

    /** @param non-empty-array<mixed> $needles */
    public function undefOrContainsAny(array $needles, bool $identical = false): Chain;

    public function undefOrControl(string ...$additionalChars): Chain;

    public function undefOrCountable(): Chain;

    /** @param "alpha-2"|"alpha-3"|"numeric" $set */
    public function undefOrCountryCode(string $set = 'alpha-2'): Chain;

    public function undefOrCpf(): Chain;

    public function undefOrCreditCard(string $brand = 'Any'): Chain;

    /** @param "alpha-3"|"numeric" $set */
    public function undefOrCurrencyCode(string $set = 'alpha-3'): Chain;

    public function undefOrDate(string $format = 'Y-m-d'): Chain;

    public function undefOrDateTime(string|null $format = null): Chain;

    /** @param "years"|"months"|"days"|"hours"|"minutes"|"seconds"|"microseconds" $type */
    public function undefOrDateTimeDiff(
        string $type,
        Validator $validator,
        string|null $format = null,
        DateTimeImmutable|null $now = null,
    ): Chain;

    public function undefOrDecimal(int $decimals): Chain;

    public function undefOrDigit(string ...$additionalChars): Chain;

    public function undefOrDirectory(): Chain;

    public function undefOrDomain(bool $tldCheck = true): Chain;

    public function undefOrEach(Validator $validator): Chain;

    public function undefOrEmail(): Chain;

    public function undefOrEmoji(): Chain;

    public function undefOrEndsWith(mixed $endValue, bool $identical = false): Chain;

    public function undefOrEquals(mixed $compareTo): Chain;

    public function undefOrEquivalent(mixed $compareTo): Chain;

    public function undefOrEven(): Chain;

    public function undefOrExecutable(): Chain;

    public function undefOrExists(): Chain;

    public function undefOrExtension(string $extension): Chain;

    public function undefOrFactor(int $dividend): Chain;

    public function undefOrFalseVal(): Chain;

    public function undefOrFalsy(): Chain;

    public function undefOrFibonacci(): Chain;

    public function undefOrFile(): Chain;

    public function undefOrFilterVar(int $filter, mixed $options = null): Chain;

    public function undefOrFinite(): Chain;

    public function undefOrFloatType(): Chain;

    public function undefOrFloatVal(): Chain;

    public function undefOrGraph(string ...$additionalChars): Chain;

    public function undefOrGreaterThan(mixed $compareTo): Chain;

    public function undefOrGreaterThanOrEqual(mixed $compareTo): Chain;

    public function undefOrHetu(): Chain;

    public function undefOrHexRgbColor(): Chain;

    public function undefOrIban(): Chain;

    public function undefOrIdentical(mixed $compareTo): Chain;

    public function undefOrImage(): Chain;

    public function undefOrImei(): Chain;

    public function undefOrIn(mixed $haystack, bool $compareIdentical = false): Chain;

    public function undefOrInfinite(): Chain;

    /** @param class-string $class */
    public function undefOrInstance(string $class): Chain;

    public function undefOrIntType(): Chain;

    public function undefOrIntVal(): Chain;

    public function undefOrIp(string $range = '*', int|null $options = null): Chain;

    public function undefOrIsbn(): Chain;

    public function undefOrIterableType(): Chain;

    public function undefOrIterableVal(): Chain;

    public function undefOrJson(): Chain;

    public function undefOrKey(string|int $key, Validator $validator): Chain;

    public function undefOrKeyExists(string|int $key): Chain;

    public function undefOrKeyOptional(string|int $key, Validator $validator): Chain;

    public function undefOrKeySet(Validator $validator, Validator ...$validators): Chain;

    /** @param "alpha-2"|"alpha-3" $set */
    public function undefOrLanguageCode(string $set = 'alpha-2'): Chain;

    /** @param callable(mixed): Validator $validatorCreator */
    public function undefOrLazy(callable $validatorCreator): Chain;

    public function undefOrLeapDate(string $format): Chain;

    public function undefOrLeapYear(): Chain;

    public function undefOrLength(Validator $validator): Chain;

    public function undefOrLessThan(mixed $compareTo): Chain;

    public function undefOrLessThanOrEqual(mixed $compareTo): Chain;

    public function undefOrLogicAnd(Validator $validator1, Validator $validator2, Validator ...$validators): Chain;

    public function undefOrLogicCond(Validator $logicCond, Validator $then, Validator|null $else = null): Chain;

    public function undefOrLogicNor(Validator $validator1, Validator $validator2, Validator ...$validators): Chain;

    public function undefOrLogicOr(Validator $validator1, Validator $validator2, Validator ...$validators): Chain;

    public function undefOrLogicXor(Validator $validator1, Validator $validator2, Validator ...$validators): Chain;

    public function undefOrLowercase(): Chain;

    public function undefOrLuhn(): Chain;

    public function undefOrMacAddress(): Chain;

    public function undefOrMax(Validator $validator): Chain;

    public function undefOrMimetype(string $mimetype): Chain;

    public function undefOrMin(Validator $validator): Chain;

    public function undefOrMultiple(int $multipleOf): Chain;

    public function undefOrNegative(): Chain;

    public function undefOrNfeAccessKey(): Chain;

    public function undefOrNif(): Chain;

    public function undefOrNip(): Chain;

    public function undefOrNot(Validator $validator): Chain;

    public function undefOrNullType(): Chain;

    public function undefOrNumber(): Chain;

    public function undefOrNumericVal(): Chain;

    public function undefOrObjectType(): Chain;

    public function undefOrOdd(): Chain;

    public function undefOrPerfectSquare(): Chain;

    public function undefOrPesel(): Chain;

    public function undefOrPhone(string|null $countryCode = null): Chain;

    public function undefOrPhpLabel(): Chain;

    public function undefOrPis(): Chain;

    public function undefOrPolishIdCard(): Chain;

    public function undefOrPortugueseNif(): Chain;

    public function undefOrPositive(): Chain;

    public function undefOrPostalCode(string $countryCode, bool $formatted = false): Chain;

    public function undefOrPrimeNumber(): Chain;

    public function undefOrPrintable(string ...$additionalChars): Chain;

    public function undefOrProperty(string $propertyName, Validator $validator): Chain;

    public function undefOrPropertyExists(string $propertyName): Chain;

    public function undefOrPropertyOptional(string $propertyName, Validator $validator): Chain;

    public function undefOrPublicDomainSuffix(): Chain;

    public function undefOrPunct(string ...$additionalChars): Chain;

    public function undefOrReadable(): Chain;

    public function undefOrRegex(string $regex): Chain;

    public function undefOrResourceType(): Chain;

    public function undefOrRoman(): Chain;

    public function undefOrScalarVal(): Chain;

    /** @param "B"|"KB"|"MB"|"GB"|"TB"|"PB"|"EB"|"ZB"|"YB" $unit */
    public function undefOrSize(string $unit, Validator $validator): Chain;

    public function undefOrSlug(): Chain;

    public function undefOrSorted(string $direction): Chain;

    public function undefOrSpace(string ...$additionalChars): Chain;

    public function undefOrSpaced(): Chain;

    public function undefOrStartsWith(mixed $startValue, bool $identical = false): Chain;

    public function undefOrStringType(): Chain;

    public function undefOrStringVal(): Chain;

    public function undefOrSubdivisionCode(string $countryCode): Chain;

    /** @param mixed[] $superset */
    public function undefOrSubset(array $superset): Chain;

    public function undefOrSymbolicLink(): Chain;

    public function undefOrTime(string $format = 'H:i:s'): Chain;

    public function undefOrTld(): Chain;

    public function undefOrTrueVal(): Chain;

    public function undefOrUnique(): Chain;

    public function undefOrUploaded(): Chain;

    public function undefOrUppercase(): Chain;

    public function undefOrUrl(): Chain;

    public function undefOrUuid(int|null $version = null): Chain;

    public function undefOrVersion(): Chain;

    public function undefOrVideoUrl(string|null $service = null): Chain;

    public function undefOrVowel(string ...$additionalChars): Chain;

    public function undefOrWritable(): Chain;

    public function undefOrXdigit(string ...$additionalChars): Chain;
}
