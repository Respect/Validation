<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Mixins;

use DateTimeImmutable;
use Respect\Validation\Validatable;

interface StaticValidator extends
    StaticKey,
    StaticLength,
    StaticMax,
    StaticMin,
    StaticNot,
    StaticNullOr,
    StaticProperty,
    StaticUndefOr
{
    public static function allOf(Validatable $rule1, Validatable $rule2, Validatable ...$rules): ChainedValidator;

    public static function alnum(string ...$additionalChars): ChainedValidator;

    public static function alpha(string ...$additionalChars): ChainedValidator;

    public static function alwaysInvalid(): ChainedValidator;

    public static function alwaysValid(): ChainedValidator;

    public static function anyOf(Validatable $rule1, Validatable $rule2, Validatable ...$rules): ChainedValidator;

    public static function arrayType(): ChainedValidator;

    public static function arrayVal(): ChainedValidator;

    public static function base(
        int $base,
        string $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
    ): ChainedValidator;

    public static function base64(): ChainedValidator;

    public static function between(mixed $minValue, mixed $maxValue): ChainedValidator;

    public static function betweenExclusive(mixed $minimum, mixed $maximum): ChainedValidator;

    public static function boolType(): ChainedValidator;

    public static function boolVal(): ChainedValidator;

    public static function bsn(): ChainedValidator;

    public static function call(callable $callable, Validatable $rule): ChainedValidator;

    public static function callableType(): ChainedValidator;

    public static function callback(callable $callback, mixed ...$arguments): ChainedValidator;

    public static function charset(string $charset, string ...$charsets): ChainedValidator;

    public static function cnh(): ChainedValidator;

    public static function cnpj(): ChainedValidator;

    public static function consecutive(
        Validatable $rule1,
        Validatable $rule2,
        Validatable ...$rules,
    ): ChainedValidator;

    public static function consonant(string ...$additionalChars): ChainedValidator;

    public static function contains(mixed $containsValue, bool $identical = false): ChainedValidator;

    /**
     * @param non-empty-array<mixed> $needles
     */
    public static function containsAny(array $needles, bool $identical = false): ChainedValidator;

    public static function control(string ...$additionalChars): ChainedValidator;

    public static function countable(): ChainedValidator;

    /**
     * @param "alpha-2"|"alpha-3"|"numeric" $set
     */
    public static function countryCode(string $set = 'alpha-2'): ChainedValidator;

    public static function cpf(): ChainedValidator;

    public static function creditCard(string $brand = 'Any'): ChainedValidator;

    /**
     * @param "alpha-3"|"numeric" $set
     */
    public static function currencyCode(string $set = 'alpha-3'): ChainedValidator;

    public static function date(string $format = 'Y-m-d'): ChainedValidator;

    public static function dateTime(?string $format = null): ChainedValidator;

    /**
     * @param "years"|"months"|"days"|"hours"|"minutes"|"seconds"|"microseconds" $type
     */
    public static function dateTimeDiff(
        string $type,
        Validatable $rule,
        ?string $format = null,
        ?DateTimeImmutable $now = null,
    ): ChainedValidator;

    public static function decimal(int $decimals): ChainedValidator;

    public static function digit(string ...$additionalChars): ChainedValidator;

    public static function directory(): ChainedValidator;

    public static function domain(bool $tldCheck = true): ChainedValidator;

    public static function each(Validatable $rule): ChainedValidator;

    public static function email(): ChainedValidator;

    public static function endsWith(mixed $endValue, bool $identical = false): ChainedValidator;

    public static function equals(mixed $compareTo): ChainedValidator;

    public static function equivalent(mixed $compareTo): ChainedValidator;

    public static function even(): ChainedValidator;

    public static function executable(): ChainedValidator;

    public static function exists(): ChainedValidator;

    public static function extension(string $extension): ChainedValidator;

    public static function factor(int $dividend): ChainedValidator;

    public static function falseVal(): ChainedValidator;

    public static function fibonacci(): ChainedValidator;

    public static function file(): ChainedValidator;

    public static function filterVar(int $filter, mixed $options = null): ChainedValidator;

    public static function finite(): ChainedValidator;

    public static function floatType(): ChainedValidator;

    public static function floatVal(): ChainedValidator;

    public static function graph(string ...$additionalChars): ChainedValidator;

    public static function greaterThan(mixed $compareTo): ChainedValidator;

    public static function greaterThanOrEqual(mixed $compareTo): ChainedValidator;

    public static function hetu(): ChainedValidator;

    public static function hexRgbColor(): ChainedValidator;

    public static function iban(): ChainedValidator;

    public static function identical(mixed $compareTo): ChainedValidator;

    public static function image(): ChainedValidator;

    public static function imei(): ChainedValidator;

    public static function in(mixed $haystack, bool $compareIdentical = false): ChainedValidator;

    public static function infinite(): ChainedValidator;

    /**
     * @param class-string $class
     */
    public static function instance(string $class): ChainedValidator;

    public static function intType(): ChainedValidator;

    public static function intVal(): ChainedValidator;

    public static function ip(string $range = '*', ?int $options = null): ChainedValidator;

    public static function isbn(): ChainedValidator;

    public static function iterableType(): ChainedValidator;

    public static function iterableVal(): ChainedValidator;

    public static function json(): ChainedValidator;

    public static function key(string|int $key, Validatable $rule): ChainedValidator;

    public static function keyExists(string|int $key): ChainedValidator;

    public static function keyOptional(string|int $key, Validatable $rule): ChainedValidator;

    public static function keySet(Validatable $rule, Validatable ...$rules): ChainedValidator;

    /**
     * @param "alpha-2"|"alpha-3" $set
     */
    public static function languageCode(string $set = 'alpha-2'): ChainedValidator;

    /**
     * @param callable(mixed): Validatable $ruleCreator
     */
    public static function lazy(callable $ruleCreator): ChainedValidator;

    public static function leapDate(string $format): ChainedValidator;

    public static function leapYear(): ChainedValidator;

    public static function length(Validatable $rule): ChainedValidator;

    public static function lessThan(mixed $compareTo): ChainedValidator;

    public static function lessThanOrEqual(mixed $compareTo): ChainedValidator;

    public static function lowercase(): ChainedValidator;

    public static function luhn(): ChainedValidator;

    public static function macAddress(): ChainedValidator;

    public static function max(Validatable $rule): ChainedValidator;

    public static function mimetype(string $mimetype): ChainedValidator;

    public static function min(Validatable $rule): ChainedValidator;

    public static function multiple(int $multipleOf): ChainedValidator;

    public static function negative(): ChainedValidator;

    public static function nfeAccessKey(): ChainedValidator;

    public static function nif(): ChainedValidator;

    public static function nip(): ChainedValidator;

    public static function no(bool $useLocale = false): ChainedValidator;

    public static function noWhitespace(): ChainedValidator;

    public static function noneOf(Validatable $rule1, Validatable $rule2, Validatable ...$rules): ChainedValidator;

    public static function not(Validatable $rule): ChainedValidator;

    public static function notBlank(): ChainedValidator;

    public static function notEmoji(): ChainedValidator;

    public static function notEmpty(): ChainedValidator;

    public static function notOptional(): ChainedValidator;

    public static function notUndef(): ChainedValidator;

    public static function nullOr(Validatable $rule): ChainedValidator;

    public static function nullType(): ChainedValidator;

    /**
     * @deprecated Use {@see nullOr()} instead.
     */
    public static function nullable(Validatable $rule): ChainedValidator;

    public static function number(): ChainedValidator;

    public static function numericVal(): ChainedValidator;

    public static function objectType(): ChainedValidator;

    public static function odd(): ChainedValidator;

    public static function oneOf(Validatable $rule1, Validatable $rule2, Validatable ...$rules): ChainedValidator;

    /**
     * @deprecated Use {@see undefOr()} instead.
     */
    public static function optional(Validatable $rule): ChainedValidator;

    public static function perfectSquare(): ChainedValidator;

    public static function pesel(): ChainedValidator;

    public static function phone(?string $countryCode = null): ChainedValidator;

    public static function phpLabel(): ChainedValidator;

    public static function pis(): ChainedValidator;

    public static function polishIdCard(): ChainedValidator;

    public static function portugueseNif(): ChainedValidator;

    public static function positive(): ChainedValidator;

    public static function postalCode(string $countryCode, bool $formatted = false): ChainedValidator;

    public static function primeNumber(): ChainedValidator;

    public static function printable(string ...$additionalChars): ChainedValidator;

    public static function property(string $propertyName, Validatable $rule): ChainedValidator;

    public static function propertyExists(string $propertyName): ChainedValidator;

    public static function propertyOptional(string $propertyName, Validatable $rule): ChainedValidator;

    public static function publicDomainSuffix(): ChainedValidator;

    public static function punct(string ...$additionalChars): ChainedValidator;

    public static function readable(): ChainedValidator;

    public static function regex(string $regex): ChainedValidator;

    public static function resourceType(): ChainedValidator;

    public static function roman(): ChainedValidator;

    public static function scalarVal(): ChainedValidator;

    public static function size(string|int|null $minSize = null, string|int|null $maxSize = null): ChainedValidator;

    public static function slug(): ChainedValidator;

    public static function sorted(string $direction): ChainedValidator;

    public static function space(string ...$additionalChars): ChainedValidator;

    public static function startsWith(mixed $startValue, bool $identical = false): ChainedValidator;

    public static function stringType(): ChainedValidator;

    public static function stringVal(): ChainedValidator;

    public static function subdivisionCode(string $countryCode): ChainedValidator;

    /**
     * @param mixed[] $superset
     */
    public static function subset(array $superset): ChainedValidator;

    public static function symbolicLink(): ChainedValidator;

    public static function time(string $format = 'H:i:s'): ChainedValidator;

    public static function tld(): ChainedValidator;

    public static function trueVal(): ChainedValidator;

    public static function undefOr(Validatable $rule): ChainedValidator;

    public static function unique(): ChainedValidator;

    public static function uploaded(): ChainedValidator;

    public static function uppercase(): ChainedValidator;

    public static function url(): ChainedValidator;

    public static function uuid(?int $version = null): ChainedValidator;

    public static function version(): ChainedValidator;

    public static function videoUrl(?string $service = null): ChainedValidator;

    public static function vowel(string ...$additionalChars): ChainedValidator;

    public static function when(Validatable $when, Validatable $then, ?Validatable $else = null): ChainedValidator;

    public static function writable(): ChainedValidator;

    public static function xdigit(string ...$additionalChars): ChainedValidator;

    public static function yes(bool $useLocale = false): ChainedValidator;
}
