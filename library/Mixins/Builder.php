<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Mixins;

use DateTimeImmutable;
use Respect\Validation\Rule;

interface Builder extends
    KeyBuilder,
    LengthBuilder,
    MaxBuilder,
    MinBuilder,
    NotBuilder,
    NullOrBuilder,
    PropertyBuilder,
    UndefOrBuilder
{
    public static function allOf(Rule $rule1, Rule $rule2, Rule ...$rules): Chain;

    public static function alnum(string ...$additionalChars): Chain;

    public static function alpha(string ...$additionalChars): Chain;

    public static function alwaysInvalid(): Chain;

    public static function alwaysValid(): Chain;

    public static function anyOf(Rule $rule1, Rule $rule2, Rule ...$rules): Chain;

    public static function arrayType(): Chain;

    public static function arrayVal(): Chain;

    public static function attributes(): Chain;

    public static function base(
        int $base,
        string $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
    ): Chain;

    public static function base64(): Chain;

    public static function between(mixed $minValue, mixed $maxValue): Chain;

    public static function betweenExclusive(mixed $minimum, mixed $maximum): Chain;

    public static function boolType(): Chain;

    public static function boolVal(): Chain;

    public static function bsn(): Chain;

    public static function call(callable $callable, Rule $rule): Chain;

    public static function callableType(): Chain;

    public static function callback(callable $callback, mixed ...$arguments): Chain;

    public static function charset(string $charset, string ...$charsets): Chain;

    public static function circuit(Rule $rule1, Rule $rule2, Rule ...$rules): Chain;

    public static function cnh(): Chain;

    public static function cnpj(): Chain;

    public static function consonant(string ...$additionalChars): Chain;

    public static function contains(mixed $containsValue, bool $identical = false): Chain;

    /**
     * @param non-empty-array<mixed> $needles
     */
    public static function containsAny(array $needles, bool $identical = false): Chain;

    public static function control(string ...$additionalChars): Chain;

    public static function countable(): Chain;

    /**
     * @param "alpha-2"|"alpha-3"|"numeric" $set
     */
    public static function countryCode(string $set = 'alpha-2'): Chain;

    public static function cpf(): Chain;

    public static function creditCard(string $brand = 'Any'): Chain;

    /**
     * @param "alpha-3"|"numeric" $set
     */
    public static function currencyCode(string $set = 'alpha-3'): Chain;

    public static function date(string $format = 'Y-m-d'): Chain;

    public static function dateTime(?string $format = null): Chain;

    /**
     * @param "years"|"months"|"days"|"hours"|"minutes"|"seconds"|"microseconds" $type
     */
    public static function dateTimeDiff(
        string $type,
        Rule $rule,
        ?string $format = null,
        ?DateTimeImmutable $now = null,
    ): Chain;

    public static function decimal(int $decimals): Chain;

    public static function digit(string ...$additionalChars): Chain;

    public static function directory(): Chain;

    public static function domain(bool $tldCheck = true): Chain;

    public static function each(Rule $rule): Chain;

    public static function email(): Chain;

    public static function endsWith(mixed $endValue, bool $identical = false): Chain;

    public static function equals(mixed $compareTo): Chain;

    public static function equivalent(mixed $compareTo): Chain;

    public static function even(): Chain;

    public static function executable(): Chain;

    public static function exists(): Chain;

    public static function extension(string $extension): Chain;

    public static function factor(int $dividend): Chain;

    public static function falseVal(): Chain;

    public static function fibonacci(): Chain;

    public static function file(): Chain;

    public static function filterVar(int $filter, mixed $options = null): Chain;

    public static function finite(): Chain;

    public static function floatType(): Chain;

    public static function floatVal(): Chain;

    public static function graph(string ...$additionalChars): Chain;

    public static function greaterThan(mixed $compareTo): Chain;

    public static function greaterThanOrEqual(mixed $compareTo): Chain;

    public static function hetu(): Chain;

    public static function hexRgbColor(): Chain;

    public static function iban(): Chain;

    public static function identical(mixed $compareTo): Chain;

    public static function image(): Chain;

    public static function imei(): Chain;

    public static function in(mixed $haystack, bool $compareIdentical = false): Chain;

    public static function infinite(): Chain;

    /**
     * @param class-string $class
     */
    public static function instance(string $class): Chain;

    public static function intType(): Chain;

    public static function intVal(): Chain;

    public static function ip(string $range = '*', ?int $options = null): Chain;

    public static function isbn(): Chain;

    public static function iterableType(): Chain;

    public static function iterableVal(): Chain;

    public static function json(): Chain;

    public static function key(string|int $key, Rule $rule): Chain;

    public static function keyExists(string|int $key): Chain;

    public static function keyOptional(string|int $key, Rule $rule): Chain;

    public static function keySet(Rule $rule, Rule ...$rules): Chain;

    /**
     * @param "alpha-2"|"alpha-3" $set
     */
    public static function languageCode(string $set = 'alpha-2'): Chain;

    /**
     * @param callable(mixed): Rule $ruleCreator
     */
    public static function lazy(callable $ruleCreator): Chain;

    public static function leapDate(string $format): Chain;

    public static function leapYear(): Chain;

    public static function length(Rule $rule): Chain;

    public static function lessThan(mixed $compareTo): Chain;

    public static function lessThanOrEqual(mixed $compareTo): Chain;

    public static function lowercase(): Chain;

    public static function luhn(): Chain;

    public static function macAddress(): Chain;

    public static function max(Rule $rule): Chain;

    public static function mimetype(string $mimetype): Chain;

    public static function min(Rule $rule): Chain;

    public static function multiple(int $multipleOf): Chain;

    public static function named(Rule $rule, string $name): Chain;

    public static function negative(): Chain;

    public static function nfeAccessKey(): Chain;

    public static function nif(): Chain;

    public static function nip(): Chain;

    public static function no(bool $useLocale = false): Chain;

    public static function noWhitespace(): Chain;

    public static function noneOf(Rule $rule1, Rule $rule2, Rule ...$rules): Chain;

    public static function not(Rule $rule): Chain;

    public static function notBlank(): Chain;

    public static function notEmoji(): Chain;

    public static function notEmpty(): Chain;

    public static function notOptional(): Chain;

    public static function notUndef(): Chain;

    public static function nullOr(Rule $rule): Chain;

    public static function nullType(): Chain;

    /**
     * @deprecated Use {@see nullOr()} instead.
     */
    public static function nullable(Rule $rule): Chain;

    public static function number(): Chain;

    public static function numericVal(): Chain;

    public static function objectType(): Chain;

    public static function odd(): Chain;

    public static function oneOf(Rule $rule1, Rule $rule2, Rule ...$rules): Chain;

    /**
     * @deprecated Use {@see undefOr()} instead.
     */
    public static function optional(Rule $rule): Chain;

    public static function perfectSquare(): Chain;

    public static function pesel(): Chain;

    public static function phone(?string $countryCode = null): Chain;

    public static function phpLabel(): Chain;

    public static function pis(): Chain;

    public static function polishIdCard(): Chain;

    public static function portugueseNif(): Chain;

    public static function positive(): Chain;

    public static function postalCode(string $countryCode, bool $formatted = false): Chain;

    public static function primeNumber(): Chain;

    public static function printable(string ...$additionalChars): Chain;

    public static function property(string $propertyName, Rule $rule): Chain;

    public static function propertyExists(string $propertyName): Chain;

    public static function propertyOptional(string $propertyName, Rule $rule): Chain;

    public static function publicDomainSuffix(): Chain;

    public static function punct(string ...$additionalChars): Chain;

    public static function readable(): Chain;

    public static function regex(string $regex): Chain;

    public static function resourceType(): Chain;

    public static function roman(): Chain;

    public static function scalarVal(): Chain;

    /**
     * @param "B"|"KB"|"MB"|"GB"|"TB"|"PB"|"EB"|"ZB"|"YB" $unit
     */
    public static function size(string $unit, Rule $rule): Chain;

    public static function slug(): Chain;

    public static function sorted(string $direction): Chain;

    public static function space(string ...$additionalChars): Chain;

    public static function startsWith(mixed $startValue, bool $identical = false): Chain;

    public static function stringType(): Chain;

    public static function stringVal(): Chain;

    public static function subdivisionCode(string $countryCode): Chain;

    /**
     * @param mixed[] $superset
     */
    public static function subset(array $superset): Chain;

    public static function symbolicLink(): Chain;

    /**
     * @param array<string, mixed> $parameters
     */
    public static function templated(Rule $rule, string $template, array $parameters = []): Chain;

    public static function time(string $format = 'H:i:s'): Chain;

    public static function tld(): Chain;

    public static function trueVal(): Chain;

    public static function undefOr(Rule $rule): Chain;

    public static function unique(): Chain;

    public static function uploaded(): Chain;

    public static function uppercase(): Chain;

    public static function url(): Chain;

    public static function uuid(?int $version = null): Chain;

    public static function version(): Chain;

    public static function videoUrl(?string $service = null): Chain;

    public static function vowel(string ...$additionalChars): Chain;

    public static function when(Rule $when, Rule $then, ?Rule $else = null): Chain;

    public static function writable(): Chain;

    public static function xdigit(string ...$additionalChars): Chain;

    public static function yes(bool $useLocale = false): Chain;
}
