<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Mixins;

use DateTimeImmutable;
use Respect\Validation\Name;
use Respect\Validation\Validator;

interface Builder extends AllBuilder, KeyBuilder, LengthBuilder, MaxBuilder, MinBuilder, NotBuilder, NullOrBuilder, PropertyBuilder, UndefOrBuilder
{
    public static function after(callable $callable, Validator $validator): Chain;

    public static function all(Validator $validator): Chain;

    public static function allOf(Validator $validator1, Validator $validator2, Validator ...$validators): Chain;

    public static function alnum(string ...$additionalChars): Chain;

    public static function alpha(string ...$additionalChars): Chain;

    public static function alwaysInvalid(): Chain;

    public static function alwaysValid(): Chain;

    public static function anyOf(Validator $validator1, Validator $validator2, Validator ...$validators): Chain;

    public static function arrayType(): Chain;

    public static function arrayVal(): Chain;

    public static function attributes(): Chain;

    public static function base(int $base, string $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'): Chain;

    public static function base64(): Chain;

    public static function between(mixed $minValue, mixed $maxValue): Chain;

    public static function betweenExclusive(mixed $minimum, mixed $maximum): Chain;

    public static function blank(): Chain;

    public static function boolType(): Chain;

    public static function boolVal(): Chain;

    public static function bsn(): Chain;

    public static function callableType(): Chain;

    public static function charset(string $charset, string ...$charsets): Chain;

    public static function circuit(Validator $validator1, Validator $validator2, Validator ...$validators): Chain;

    public static function cnh(): Chain;

    public static function cnpj(): Chain;

    public static function consonant(string ...$additionalChars): Chain;

    public static function contains(mixed $containsValue): Chain;

    /** @param non-empty-array<mixed> $needles */
    public static function containsAny(array $needles): Chain;

    public static function containsCount(mixed $containsValue, int $count): Chain;

    public static function control(string ...$additionalChars): Chain;

    public static function countable(): Chain;

    /** @param "alpha-2"|"alpha-3"|"numeric" $set */
    public static function countryCode(string $set = 'alpha-2'): Chain;

    public static function cpf(): Chain;

    public static function creditCard(string $brand = 'Any'): Chain;

    /** @param "alpha-3"|"numeric" $set */
    public static function currencyCode(string $set = 'alpha-3'): Chain;

    public static function date(string $format = 'Y-m-d'): Chain;

    public static function dateTime(string|null $format = null): Chain;

    /** @param "years"|"months"|"days"|"hours"|"minutes"|"seconds"|"microseconds" $type */
    public static function dateTimeDiff(string $type, Validator $validator, string|null $format = null, DateTimeImmutable|null $now = null): Chain;

    public static function decimal(int $decimals): Chain;

    public static function digit(string ...$additionalChars): Chain;

    public static function directory(): Chain;

    public static function domain(bool $tldCheck = true): Chain;

    public static function each(Validator $validator): Chain;

    public static function email(): Chain;

    public static function emoji(): Chain;

    public static function endsWith(mixed $endValue): Chain;

    public static function equals(mixed $compareTo): Chain;

    public static function equivalent(mixed $compareTo): Chain;

    public static function even(): Chain;

    public static function executable(): Chain;

    public static function exists(): Chain;

    public static function extension(string $extension): Chain;

    public static function factor(int $dividend): Chain;

    /** @param callable(mixed): Validator $factory */
    public static function factory(callable $factory): Chain;

    public static function falseVal(): Chain;

    public static function falsy(): Chain;

    public static function file(): Chain;

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

    public static function in(mixed $haystack): Chain;

    public static function infinite(): Chain;

    /** @param class-string $class */
    public static function instance(string $class): Chain;

    public static function intType(): Chain;

    public static function intVal(): Chain;

    public static function ip(string $range = '*', int|null $options = null): Chain;

    public static function isbn(): Chain;

    public static function iterableType(): Chain;

    public static function iterableVal(): Chain;

    public static function json(): Chain;

    public static function key(string|int $key, Validator $validator): Chain;

    public static function keyExists(string|int $key): Chain;

    public static function keyOptional(string|int $key, Validator $validator): Chain;

    public static function keySet(Validator $validator, Validator ...$validators): Chain;

    /** @param "alpha-2"|"alpha-3" $set */
    public static function languageCode(string $set = 'alpha-2'): Chain;

    public static function leapDate(string $format): Chain;

    public static function leapYear(): Chain;

    public static function length(Validator $validator): Chain;

    public static function lessThan(mixed $compareTo): Chain;

    public static function lessThanOrEqual(mixed $compareTo): Chain;

    public static function lowercase(): Chain;

    public static function luhn(): Chain;

    public static function macAddress(): Chain;

    public static function masked(string $range, Validator $validator, string $replacement = '*'): Chain;

    public static function max(Validator $validator): Chain;

    public static function mimetype(string $mimetype): Chain;

    public static function min(Validator $validator): Chain;

    public static function multiple(int $multipleOf): Chain;

    public static function named(Name|string $name, Validator $validator): Chain;

    public static function negative(): Chain;

    public static function nfeAccessKey(): Chain;

    public static function nif(): Chain;

    public static function nip(): Chain;

    public static function noneOf(Validator $validator1, Validator $validator2, Validator ...$validators): Chain;

    public static function not(Validator $validator): Chain;

    public static function nullOr(Validator $validator): Chain;

    public static function nullType(): Chain;

    public static function number(): Chain;

    public static function numericVal(): Chain;

    public static function objectType(): Chain;

    public static function odd(): Chain;

    public static function oneOf(Validator $validator1, Validator $validator2, Validator ...$validators): Chain;

    public static function pesel(): Chain;

    public static function phone(string|null $countryCode = null): Chain;

    public static function pis(): Chain;

    public static function polishIdCard(): Chain;

    public static function portugueseNif(): Chain;

    public static function positive(): Chain;

    public static function postalCode(string $countryCode, bool $formatted = false): Chain;

    public static function printable(string ...$additionalChars): Chain;

    public static function property(string $propertyName, Validator $validator): Chain;

    public static function propertyExists(string $propertyName): Chain;

    public static function propertyOptional(string $propertyName, Validator $validator): Chain;

    public static function publicDomainSuffix(): Chain;

    public static function punct(string ...$additionalChars): Chain;

    public static function readable(): Chain;

    public static function regex(string $regex): Chain;

    public static function resourceType(): Chain;

    public static function roman(): Chain;

    public static function satisfies(callable $callback, mixed ...$arguments): Chain;

    public static function scalarVal(): Chain;

    /** @param "B"|"KB"|"MB"|"GB"|"TB"|"PB"|"EB"|"ZB"|"YB" $unit */
    public static function size(string $unit, Validator $validator): Chain;

    public static function slug(): Chain;

    public static function sorted(string $direction): Chain;

    public static function space(string ...$additionalChars): Chain;

    public static function spaced(): Chain;

    public static function startsWith(mixed $startValue): Chain;

    public static function stringType(): Chain;

    public static function stringVal(): Chain;

    public static function subdivisionCode(string $countryCode): Chain;

    /** @param mixed[] $superset */
    public static function subset(array $superset): Chain;

    public static function symbolicLink(): Chain;

    /** @param array<string, mixed> $parameters */
    public static function templated(string $template, Validator $validator, array $parameters = []): Chain;

    public static function time(string $format = 'H:i:s'): Chain;

    public static function tld(): Chain;

    public static function trueVal(): Chain;

    public static function undef(): Chain;

    public static function undefOr(Validator $validator): Chain;

    public static function unique(): Chain;

    public static function uppercase(): Chain;

    public static function url(): Chain;

    public static function uuid(int|null $version = null): Chain;

    public static function version(): Chain;

    public static function vowel(string ...$additionalChars): Chain;

    public static function when(Validator $when, Validator $then, Validator|null $else = null): Chain;

    public static function writable(): Chain;

    public static function xdigit(string ...$additionalChars): Chain;
}
