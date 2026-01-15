<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Mixins;

use DateTimeImmutable;
use Respect\Validation\Name;
use Respect\Validation\Validator;
use Respect\Validation\ValidatorBuilder;

/** @mixin ValidatorBuilder */
interface Chain extends
    Validator,
    AllChain,
    KeyChain,
    LengthChain,
    MaxChain,
    MinChain,
    NotChain,
    NullOrChain,
    PropertyChain,
    UndefOrChain
{
    public function all(Validator $validator): Chain;

    public function allOf(Validator $validator1, Validator $validator2, Validator ...$validators): Chain;

    public function alnum(string ...$additionalChars): Chain;

    public function alpha(string ...$additionalChars): Chain;

    public function alwaysInvalid(): Chain;

    public function alwaysValid(): Chain;

    public function anyOf(Validator $validator1, Validator $validator2, Validator ...$validators): Chain;

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

    public function blank(): Chain;

    public function boolType(): Chain;

    public function boolVal(): Chain;

    public function bsn(): Chain;

    public function call(callable $callable, Validator $validator): Chain;

    public function callableType(): Chain;

    public function callback(callable $callback, mixed ...$arguments): Chain;

    public function charset(string $charset, string ...$charsets): Chain;

    public function circuit(Validator $validator1, Validator $validator2, Validator ...$validators): Chain;

    public function cnh(): Chain;

    public function cnpj(): Chain;

    public function consonant(string ...$additionalChars): Chain;

    public function contains(mixed $containsValue, bool $identical = false): Chain;

    /** @param non-empty-array<mixed> $needles */
    public function containsAny(array $needles, bool $identical = false): Chain;

    public function containsCount(mixed $containsValue, int $count, bool $identical = false): Chain;

    public function control(string ...$additionalChars): Chain;

    public function countable(): Chain;

    /** @param "alpha-2"|"alpha-3"|"numeric" $set */
    public function countryCode(string $set = 'alpha-2'): Chain;

    public function cpf(): Chain;

    public function creditCard(string $brand = 'Any'): Chain;

    /** @param "alpha-3"|"numeric" $set */
    public function currencyCode(string $set = 'alpha-3'): Chain;

    public function date(string $format = 'Y-m-d'): Chain;

    public function dateTime(string|null $format = null): Chain;

    /** @param "years"|"months"|"days"|"hours"|"minutes"|"seconds"|"microseconds" $type */
    public function dateTimeDiff(
        string $type,
        Validator $validator,
        string|null $format = null,
        DateTimeImmutable|null $now = null,
    ): Chain;

    public function decimal(int $decimals): Chain;

    public function digit(string ...$additionalChars): Chain;

    public function directory(): Chain;

    public function domain(bool $tldCheck = true): Chain;

    public function each(Validator $validator): Chain;

    public function email(): Chain;

    public function emoji(): Chain;

    public function endsWith(mixed $endValue, bool $identical = false): Chain;

    public function equals(mixed $compareTo): Chain;

    public function equivalent(mixed $compareTo): Chain;

    public function even(): Chain;

    public function executable(): Chain;

    public function exists(): Chain;

    public function extension(string $extension): Chain;

    public function factor(int $dividend): Chain;

    public function falseVal(): Chain;

    public function falsy(): Chain;

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

    /** @param class-string $class */
    public function instance(string $class): Chain;

    public function intType(): Chain;

    public function intVal(): Chain;

    public function ip(string $range = '*', int|null $options = null): Chain;

    public function isbn(): Chain;

    public function iterableType(): Chain;

    public function iterableVal(): Chain;

    public function json(): Chain;

    public function key(string|int $key, Validator $validator): Chain;

    public function keyExists(string|int $key): Chain;

    public function keyOptional(string|int $key, Validator $validator): Chain;

    public function keySet(Validator $validator, Validator ...$validators): Chain;

    /** @param "alpha-2"|"alpha-3" $set */
    public function languageCode(string $set = 'alpha-2'): Chain;

    /** @param callable(mixed): Validator $validatorCreator */
    public function lazy(callable $validatorCreator): Chain;

    public function leapDate(string $format): Chain;

    public function leapYear(): Chain;

    public function length(Validator $validator): Chain;

    public function lessThan(mixed $compareTo): Chain;

    public function lessThanOrEqual(mixed $compareTo): Chain;

    public function lowercase(): Chain;

    public function luhn(): Chain;

    public function macAddress(): Chain;

    public function max(Validator $validator): Chain;

    public function mimetype(string $mimetype): Chain;

    public function min(Validator $validator): Chain;

    public function multiple(int $multipleOf): Chain;

    public function named(Name|string $name, Validator $validator): Chain;

    public function negative(): Chain;

    public function nfeAccessKey(): Chain;

    public function nif(): Chain;

    public function nip(): Chain;

    public function noneOf(Validator $validator1, Validator $validator2, Validator ...$validators): Chain;

    public function not(Validator $validator): Chain;

    public function nullOr(Validator $validator): Chain;

    public function nullType(): Chain;

    public function number(): Chain;

    public function numericVal(): Chain;

    public function objectType(): Chain;

    public function odd(): Chain;

    public function oneOf(Validator $validator1, Validator $validator2, Validator ...$validators): Chain;

    public function perfectSquare(): Chain;

    public function pesel(): Chain;

    public function phone(string|null $countryCode = null): Chain;

    public function phpLabel(): Chain;

    public function pis(): Chain;

    public function polishIdCard(): Chain;

    public function portugueseNif(): Chain;

    public function positive(): Chain;

    public function postalCode(string $countryCode, bool $formatted = false): Chain;

    public function primeNumber(): Chain;

    public function printable(string ...$additionalChars): Chain;

    public function property(string $propertyName, Validator $validator): Chain;

    public function propertyExists(string $propertyName): Chain;

    public function propertyOptional(string $propertyName, Validator $validator): Chain;

    public function publicDomainSuffix(): Chain;

    public function punct(string ...$additionalChars): Chain;

    public function readable(): Chain;

    public function regex(string $regex): Chain;

    public function resourceType(): Chain;

    public function roman(): Chain;

    public function scalarVal(): Chain;

    /** @param "B"|"KB"|"MB"|"GB"|"TB"|"PB"|"EB"|"ZB"|"YB" $unit */
    public function size(string $unit, Validator $validator): Chain;

    public function slug(): Chain;

    public function sorted(string $direction): Chain;

    public function space(string ...$additionalChars): Chain;

    public function spaced(): Chain;

    public function startsWith(mixed $startValue, bool $identical = false): Chain;

    public function stringType(): Chain;

    public function stringVal(): Chain;

    public function subdivisionCode(string $countryCode): Chain;

    /** @param mixed[] $superset */
    public function subset(array $superset): Chain;

    public function symbolicLink(): Chain;

    /** @param array<string, mixed> $parameters */
    public function templated(string $template, Validator $validator, array $parameters = []): Chain;

    public function time(string $format = 'H:i:s'): Chain;

    public function tld(): Chain;

    public function trueVal(): Chain;

    public function undef(): Chain;

    public function undefOr(Validator $validator): Chain;

    public function unique(): Chain;

    public function uploaded(): Chain;

    public function uppercase(): Chain;

    public function url(): Chain;

    public function uuid(int|null $version = null): Chain;

    public function version(): Chain;

    public function videoUrl(string|null $service = null): Chain;

    public function vowel(string ...$additionalChars): Chain;

    public function when(Validator $when, Validator $then, Validator|null $else = null): Chain;

    public function writable(): Chain;

    public function xdigit(string ...$additionalChars): Chain;
}
