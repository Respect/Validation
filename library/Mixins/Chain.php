<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Mixins;

use DateTimeImmutable;
use Respect\Validation\Rule;
use Respect\Validation\Validator;

/**
 * @mixin Validator
 */
interface Chain extends
    Rule,
    KeyChain,
    LengthChain,
    MaxChain,
    MinChain,
    NotChain,
    NullOrChain,
    PropertyChain,
    UndefOrChain
{
    public function allOf(Rule $rule1, Rule $rule2, Rule ...$rules): Chain;

    public function alnum(string ...$additionalChars): Chain;

    public function alpha(string ...$additionalChars): Chain;

    public function alwaysInvalid(): Chain;

    public function alwaysValid(): Chain;

    public function anyOf(Rule $rule1, Rule $rule2, Rule ...$rules): Chain;

    public function arrayType(): Chain;

    public function arrayVal(): Chain;

    public function attributes(): Chain;

    public function base(
        int $base,
        string $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
    ): Chain;

    public function base64(): Chain;

    public function between(mixed $minValue, mixed $maxValue): Chain;

    public function betweenExclusive(mixed $minimum, mixed $maximum): Chain;

    public function boolType(): Chain;

    public function boolVal(): Chain;

    public function bsn(): Chain;

    public function call(callable $callable, Rule $rule): Chain;

    public function callableType(): Chain;

    public function callback(callable $callback, mixed ...$arguments): Chain;

    public function charset(string $charset, string ...$charsets): Chain;

    public function circuit(Rule $rule1, Rule $rule2, Rule ...$rules): Chain;

    public function cnh(): Chain;

    public function cnpj(): Chain;

    public function consonant(string ...$additionalChars): Chain;

    public function contains(mixed $containsValue, bool $identical = false): Chain;

    /**
     * @param non-empty-array<mixed> $needles
     */
    public function containsAny(array $needles, bool $identical = false): Chain;

    public function control(string ...$additionalChars): Chain;

    public function countable(): Chain;

    /**
     * @param "alpha-2"|"alpha-3"|"numeric" $set
     */
    public function countryCode(string $set = 'alpha-2'): Chain;

    public function cpf(): Chain;

    public function creditCard(string $brand = 'Any'): Chain;

    /**
     * @param "alpha-3"|"numeric" $set
     */
    public function currencyCode(string $set = 'alpha-3'): Chain;

    public function date(string $format = 'Y-m-d'): Chain;

    public function dateTime(?string $format = null): Chain;

    /**
     * @param "years"|"months"|"days"|"hours"|"minutes"|"seconds"|"microseconds" $type
     */
    public function dateTimeDiff(
        string $type,
        Rule $rule,
        ?string $format = null,
        ?DateTimeImmutable $now = null,
    ): Chain;

    public function decimal(int $decimals): Chain;

    public function digit(string ...$additionalChars): Chain;

    public function directory(): Chain;

    public function domain(bool $tldCheck = true): Chain;

    public function each(Rule $rule): Chain;

    public function email(): Chain;

    public function endsWith(mixed $endValue, bool $identical = false): Chain;

    public function equals(mixed $compareTo): Chain;

    public function equivalent(mixed $compareTo): Chain;

    public function even(): Chain;

    public function executable(): Chain;

    public function exists(): Chain;

    public function extension(string $extension): Chain;

    public function factor(int $dividend): Chain;

    public function falseVal(): Chain;

    public function fibonacci(): Chain;

    public function file(): Chain;

    public function filterVar(int $filter, mixed $options = null): Chain;

    public function finite(): Chain;

    public function floatType(): Chain;

    public function floatVal(): Chain;

    public function graph(string ...$additionalChars): Chain;

    public function greaterThan(mixed $compareTo): Chain;

    public function greaterThanOrEqual(mixed $compareTo): Chain;

    public function hetu(): Chain;

    public function hexRgbColor(): Chain;

    public function iban(): Chain;

    public function identical(mixed $compareTo): Chain;

    public function image(): Chain;

    public function imei(): Chain;

    public function in(mixed $haystack, bool $compareIdentical = false): Chain;

    public function infinite(): Chain;

    /**
     * @param class-string $class
     */
    public function instance(string $class): Chain;

    public function intType(): Chain;

    public function intVal(): Chain;

    public function ip(string $range = '*', ?int $options = null): Chain;

    public function isbn(): Chain;

    public function iterableType(): Chain;

    public function iterableVal(): Chain;

    public function json(): Chain;

    public function key(string|int $key, Rule $rule): Chain;

    public function keyExists(string|int $key): Chain;

    public function keyOptional(string|int $key, Rule $rule): Chain;

    public function keySet(Rule $rule, Rule ...$rules): Chain;

    /**
     * @param "alpha-2"|"alpha-3" $set
     */
    public function languageCode(string $set = 'alpha-2'): Chain;

    /**
     * @param callable(mixed): Rule $ruleCreator
     */
    public function lazy(callable $ruleCreator): Chain;

    public function leapDate(string $format): Chain;

    public function leapYear(): Chain;

    public function length(Rule $rule): Chain;

    public function lessThan(mixed $compareTo): Chain;

    public function lessThanOrEqual(mixed $compareTo): Chain;

    public function lowercase(): Chain;

    public function luhn(): Chain;

    public function macAddress(): Chain;

    public function max(Rule $rule): Chain;

    public function mimetype(string $mimetype): Chain;

    public function min(Rule $rule): Chain;

    public function multiple(int $multipleOf): Chain;

    public function named(Rule $rule, string $name): Chain;

    public function negative(): Chain;

    public function nfeAccessKey(): Chain;

    public function nif(): Chain;

    public function nip(): Chain;

    public function no(bool $useLocale = false): Chain;

    public function noWhitespace(): Chain;

    public function noneOf(Rule $rule1, Rule $rule2, Rule ...$rules): Chain;

    public function not(Rule $rule): Chain;

    public function notBlank(): Chain;

    public function notEmoji(): Chain;

    public function notEmpty(): Chain;

    public function notOptional(): Chain;

    public function notUndef(): Chain;

    public function nullOr(Rule $rule): Chain;

    public function nullType(): Chain;

    /**
     * @deprecated Use {@see nullOr()} instead.
     */
    public function nullable(Rule $rule): Chain;

    public function number(): Chain;

    public function numericVal(): Chain;

    public function objectType(): Chain;

    public function odd(): Chain;

    public function oneOf(Rule $rule1, Rule $rule2, Rule ...$rules): Chain;

    /**
     * @deprecated Use {@see undefOr()} instead.
     */
    public function optional(Rule $rule): Chain;

    public function perfectSquare(): Chain;

    public function pesel(): Chain;

    public function phone(?string $countryCode = null): Chain;

    public function phpLabel(): Chain;

    public function pis(): Chain;

    public function polishIdCard(): Chain;

    public function portugueseNif(): Chain;

    public function positive(): Chain;

    public function postalCode(string $countryCode, bool $formatted = false): Chain;

    public function primeNumber(): Chain;

    public function printable(string ...$additionalChars): Chain;

    public function property(string $propertyName, Rule $rule): Chain;

    public function propertyExists(string $propertyName): Chain;

    public function propertyOptional(string $propertyName, Rule $rule): Chain;

    public function publicDomainSuffix(): Chain;

    public function punct(string ...$additionalChars): Chain;

    public function readable(): Chain;

    public function regex(string $regex): Chain;

    public function resourceType(): Chain;

    public function roman(): Chain;

    public function scalarVal(): Chain;

    /**
     * @param "B"|"KB"|"MB"|"GB"|"TB"|"PB"|"EB"|"ZB"|"YB" $unit
     */
    public function size(string $unit, Rule $rule): Chain;

    public function slug(): Chain;

    public function sorted(string $direction): Chain;

    public function space(string ...$additionalChars): Chain;

    public function startsWith(mixed $startValue, bool $identical = false): Chain;

    public function stringType(): Chain;

    public function stringVal(): Chain;

    public function subdivisionCode(string $countryCode): Chain;

    /**
     * @param mixed[] $superset
     */
    public function subset(array $superset): Chain;

    public function symbolicLink(): Chain;

    /**
     * @param array<string, mixed> $parameters
     */
    public function templated(Rule $rule, string $template, array $parameters = []): Chain;

    public function time(string $format = 'H:i:s'): Chain;

    public function tld(): Chain;

    public function trueVal(): Chain;

    public function undefOr(Rule $rule): Chain;

    public function unique(): Chain;

    public function uploaded(): Chain;

    public function uppercase(): Chain;

    public function url(): Chain;

    public function uuid(?int $version = null): Chain;

    public function version(): Chain;

    public function videoUrl(?string $service = null): Chain;

    public function vowel(string ...$additionalChars): Chain;

    public function when(Rule $when, Rule $then, ?Rule $else = null): Chain;

    public function writable(): Chain;

    public function xdigit(string ...$additionalChars): Chain;

    public function yes(bool $useLocale = false): Chain;
}
