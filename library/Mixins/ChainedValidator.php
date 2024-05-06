<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Mixins;

use Respect\Validation\Validatable;

interface ChainedValidator extends
    Validatable,
    ChainedKey,
    ChainedLength,
    ChainedMax,
    ChainedMin,
    ChainedNot,
    ChainedNullOr,
    ChainedProperty,
    ChainedUndefOr
{
    public function allOf(Validatable $rule1, Validatable $rule2, Validatable ...$rules): ChainedValidator;

    public function alnum(string ...$additionalChars): ChainedValidator;

    public function alpha(string ...$additionalChars): ChainedValidator;

    public function alwaysInvalid(): ChainedValidator;

    public function alwaysValid(): ChainedValidator;

    public function anyOf(Validatable $rule1, Validatable $rule2, Validatable ...$rules): ChainedValidator;

    public function arrayType(): ChainedValidator;

    public function arrayVal(): ChainedValidator;

    public function base(
        int $base,
        string $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
    ): ChainedValidator;

    public function base64(): ChainedValidator;

    public function between(mixed $minValue, mixed $maxValue): ChainedValidator;

    public function betweenExclusive(mixed $minimum, mixed $maximum): ChainedValidator;

    public function boolType(): ChainedValidator;

    public function boolVal(): ChainedValidator;

    public function bsn(): ChainedValidator;

    public function call(callable $callable, Validatable $rule): ChainedValidator;

    public function callableType(): ChainedValidator;

    public function callback(callable $callback, mixed ...$arguments): ChainedValidator;

    public function charset(string $charset, string ...$charsets): ChainedValidator;

    public function cnh(): ChainedValidator;

    public function cnpj(): ChainedValidator;

    public function consecutive(Validatable $rule1, Validatable $rule2, Validatable ...$rules): ChainedValidator;

    public function consonant(string ...$additionalChars): ChainedValidator;

    public function contains(mixed $containsValue, bool $identical = false): ChainedValidator;

    /**
     * @param non-empty-array<mixed> $needles
     */
    public function containsAny(array $needles, bool $identical = false): ChainedValidator;

    public function control(string ...$additionalChars): ChainedValidator;

    public function countable(): ChainedValidator;

    /**
     * @param "alpha-2"|"alpha-3"|"numeric" $set
     */
    public function countryCode(string $set = 'alpha-2'): ChainedValidator;

    public function cpf(): ChainedValidator;

    public function creditCard(string $brand = 'Any'): ChainedValidator;

    /**
     * @param "alpha-3"|"numeric" $set
     */
    public function currencyCode(string $set = 'alpha-3'): ChainedValidator;

    public function date(string $format = 'Y-m-d'): ChainedValidator;

    public function dateTime(?string $format = null): ChainedValidator;

    public function decimal(int $decimals): ChainedValidator;

    public function digit(string ...$additionalChars): ChainedValidator;

    public function directory(): ChainedValidator;

    public function domain(bool $tldCheck = true): ChainedValidator;

    public function each(Validatable $rule): ChainedValidator;

    public function email(): ChainedValidator;

    public function endsWith(mixed $endValue, bool $identical = false): ChainedValidator;

    public function equals(mixed $compareTo): ChainedValidator;

    public function equivalent(mixed $compareTo): ChainedValidator;

    public function even(): ChainedValidator;

    public function executable(): ChainedValidator;

    public function exists(): ChainedValidator;

    public function extension(string $extension): ChainedValidator;

    public function factor(int $dividend): ChainedValidator;

    public function falseVal(): ChainedValidator;

    public function fibonacci(): ChainedValidator;

    public function file(): ChainedValidator;

    public function filterVar(int $filter, mixed $options = null): ChainedValidator;

    public function finite(): ChainedValidator;

    public function floatType(): ChainedValidator;

    public function floatVal(): ChainedValidator;

    public function graph(string ...$additionalChars): ChainedValidator;

    public function greaterThan(mixed $compareTo): ChainedValidator;

    public function greaterThanOrEqual(mixed $compareTo): ChainedValidator;

    public function hetu(): ChainedValidator;

    public function hexRgbColor(): ChainedValidator;

    public function iban(): ChainedValidator;

    public function identical(mixed $compareTo): ChainedValidator;

    public function image(): ChainedValidator;

    public function imei(): ChainedValidator;

    public function in(mixed $haystack, bool $compareIdentical = false): ChainedValidator;

    public function infinite(): ChainedValidator;

    /**
     * @param class-string $class
     */
    public function instance(string $class): ChainedValidator;

    public function intType(): ChainedValidator;

    public function intVal(): ChainedValidator;

    public function ip(string $range = '*', ?int $options = null): ChainedValidator;

    public function isbn(): ChainedValidator;

    public function iterableType(): ChainedValidator;

    public function iterableVal(): ChainedValidator;

    public function json(): ChainedValidator;

    public function key(string|int $key, Validatable $rule): ChainedValidator;

    public function keyExists(string|int $key): ChainedValidator;

    public function keyOptional(string|int $key, Validatable $rule): ChainedValidator;

    public function keySet(Validatable $rule, Validatable ...$rules): ChainedValidator;

    /**
     * @param "alpha-2"|"alpha-3" $set
     */
    public function languageCode(string $set = 'alpha-2'): ChainedValidator;

    /**
     * @param callable(mixed): Validatable $ruleCreator
     */
    public function lazy(callable $ruleCreator): ChainedValidator;

    public function leapDate(string $format): ChainedValidator;

    public function leapYear(): ChainedValidator;

    public function length(Validatable $rule): ChainedValidator;

    public function lessThan(mixed $compareTo): ChainedValidator;

    public function lessThanOrEqual(mixed $compareTo): ChainedValidator;

    public function lowercase(): ChainedValidator;

    public function luhn(): ChainedValidator;

    public function macAddress(): ChainedValidator;

    public function max(Validatable $rule): ChainedValidator;

    public function maxAge(int $age, ?string $format = null): ChainedValidator;

    public function mimetype(string $mimetype): ChainedValidator;

    public function min(Validatable $rule): ChainedValidator;

    public function minAge(int $age, ?string $format = null): ChainedValidator;

    public function multiple(int $multipleOf): ChainedValidator;

    public function negative(): ChainedValidator;

    public function nfeAccessKey(): ChainedValidator;

    public function nif(): ChainedValidator;

    public function nip(): ChainedValidator;

    public function no(bool $useLocale = false): ChainedValidator;

    public function noWhitespace(): ChainedValidator;

    public function noneOf(Validatable $rule1, Validatable $rule2, Validatable ...$rules): ChainedValidator;

    public function not(Validatable $rule): ChainedValidator;

    public function notBlank(): ChainedValidator;

    public function notEmoji(): ChainedValidator;

    public function notEmpty(): ChainedValidator;

    public function notOptional(): ChainedValidator;

    public function notUndef(): ChainedValidator;

    public function nullOr(Validatable $rule): ChainedValidator;

    public function nullType(): ChainedValidator;

    /**
     * @deprecated Use {@see nullOr()} instead.
     */
    public function nullable(Validatable $rule): ChainedValidator;

    public function number(): ChainedValidator;

    public function numericVal(): ChainedValidator;

    public function objectType(): ChainedValidator;

    public function odd(): ChainedValidator;

    public function oneOf(Validatable $rule1, Validatable $rule2, Validatable ...$rules): ChainedValidator;

    /**
     * @deprecated Use {@see undefOr()} instead.
     */
    public function optional(Validatable $rule): ChainedValidator;

    public function perfectSquare(): ChainedValidator;

    public function pesel(): ChainedValidator;

    public function phone(?string $countryCode = null): ChainedValidator;

    public function phpLabel(): ChainedValidator;

    public function pis(): ChainedValidator;

    public function polishIdCard(): ChainedValidator;

    public function portugueseNif(): ChainedValidator;

    public function positive(): ChainedValidator;

    public function postalCode(string $countryCode, bool $formatted = false): ChainedValidator;

    public function primeNumber(): ChainedValidator;

    public function printable(string ...$additionalChars): ChainedValidator;

    public function property(string $propertyName, Validatable $rule): ChainedValidator;

    public function propertyExists(string $propertyName): ChainedValidator;

    public function propertyOptional(string $propertyName, Validatable $rule): ChainedValidator;

    public function publicDomainSuffix(): ChainedValidator;

    public function punct(string ...$additionalChars): ChainedValidator;

    public function readable(): ChainedValidator;

    public function regex(string $regex): ChainedValidator;

    public function resourceType(): ChainedValidator;

    public function roman(): ChainedValidator;

    public function scalarVal(): ChainedValidator;

    public function size(string|int|null $minSize = null, string|int|null $maxSize = null): ChainedValidator;

    public function slug(): ChainedValidator;

    public function sorted(string $direction): ChainedValidator;

    public function space(string ...$additionalChars): ChainedValidator;

    public function startsWith(mixed $startValue, bool $identical = false): ChainedValidator;

    public function stringType(): ChainedValidator;

    public function stringVal(): ChainedValidator;

    public function subdivisionCode(string $countryCode): ChainedValidator;

    /**
     * @param mixed[] $superset
     */
    public function subset(array $superset): ChainedValidator;

    public function symbolicLink(): ChainedValidator;

    public function time(string $format = 'H:i:s'): ChainedValidator;

    public function tld(): ChainedValidator;

    public function trueVal(): ChainedValidator;

    public function undefOr(Validatable $rule): ChainedValidator;

    public function unique(): ChainedValidator;

    public function uploaded(): ChainedValidator;

    public function uppercase(): ChainedValidator;

    public function url(): ChainedValidator;

    public function uuid(?int $version = null): ChainedValidator;

    public function version(): ChainedValidator;

    public function videoUrl(?string $service = null): ChainedValidator;

    public function vowel(string ...$additionalChars): ChainedValidator;

    public function when(Validatable $when, Validatable $then, ?Validatable $else = null): ChainedValidator;

    public function writable(): ChainedValidator;

    public function xdigit(string ...$additionalChars): ChainedValidator;

    public function yes(bool $useLocale = false): ChainedValidator;
}
