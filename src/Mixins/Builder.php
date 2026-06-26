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
use Respect\StringFormatter\Formatter;
use Respect\Validation\Name;
use Respect\Validation\Validator;

interface Builder extends AllBuilder, KeyBuilder, LengthBuilder, MaxBuilder, MinBuilder, NotBuilder, NullOrBuilder, PropertyBuilder, UndefOrBuilder
{
    /** @return Chain<mixed> */
    public static function after(callable $callable, Validator $validator): Chain;

    /**
     * @template T
     * @param Chain<T> $validator
     * @return Chain<iterable<T>>
     */
    public static function all(Validator $validator): Chain;

    /** @return Chain<mixed> */
    public static function allOf(Validator $validator1, Validator $validator2, Validator ...$validators): Chain;

    /** @return Chain<scalar> */
    public static function alnum(string ...$additionalChars): Chain;

    /** @return Chain<scalar> */
    public static function alpha(string ...$additionalChars): Chain;

    /** @return Chain<mixed> */
    public static function alwaysInvalid(): Chain;

    /** @return Chain<mixed> */
    public static function alwaysValid(): Chain;

    /** @return Chain<mixed> */
    public static function anyOf(Validator $validator1, Validator $validator2, Validator ...$validators): Chain;

    /** @return Chain<array> */
    public static function arrayType(): Chain;

    /** @return Chain<array|\ArrayAccess|\SimpleXMLElement> */
    public static function arrayVal(): Chain;

    /** @return Chain<object> */
    public static function attributes(): Chain;

    /** @return Chain<mixed> */
    public static function base(int $base, string $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'): Chain;

    /** @return Chain<string> */
    public static function base64(): Chain;

    /** @return Chain<mixed> */
    public static function between(mixed $minValue, mixed $maxValue): Chain;

    /** @return Chain<mixed> */
    public static function betweenExclusive(mixed $minimum, mixed $maximum): Chain;

    /** @return Chain<mixed> */
    public static function blank(): Chain;

    /** @return Chain<bool> */
    public static function boolType(): Chain;

    /** @return Chain<scalar|null> */
    public static function boolVal(): Chain;

    /** @return Chain<scalar> */
    public static function bsn(): Chain;

    /** @return Chain<callable> */
    public static function callableType(): Chain;

    /** @return Chain<string> */
    public static function charset(string $charset, string ...$charsets): Chain;

    /** @return Chain<scalar> */
    public static function cnh(): Chain;

    /** @return Chain<scalar> */
    public static function cnpj(): Chain;

    /** @return Chain<scalar> */
    public static function consonant(string ...$additionalChars): Chain;

    /** @return Chain<scalar|array> */
    public static function contains(mixed $containsValue): Chain;

    /**
     * @param non-empty-array<mixed> $needles
     * @return Chain<scalar|array>
     */
    public static function containsAny(array $needles): Chain;

    /** @return Chain<scalar|array> */
    public static function containsCount(mixed $containsValue, int $count): Chain;

    /** @return Chain<scalar> */
    public static function control(string ...$additionalChars): Chain;

    /** @return Chain<array|\Countable> */
    public static function countable(): Chain;

    /**
     * @param "alpha-2"|"alpha-3"|"numeric" $set
     * @return Chain<string>
     */
    public static function countryCode(string $set = 'alpha-2'): Chain;

    /** @return Chain<string> */
    public static function cpf(): Chain;

    /** @return Chain<scalar> */
    public static function creditCard(string $brand = 'Any'): Chain;

    /**
     * @param "alpha-3"|"numeric" $set
     * @return Chain<string>
     */
    public static function currencyCode(string $set = 'alpha-3'): Chain;

    /** @return Chain<scalar> */
    public static function date(string $format = 'Y-m-d'): Chain;

    /** @return Chain<scalar|\DateTimeInterface> */
    public static function dateTime(string|null $format = null): Chain;

    /**
     * @param "years"|"months"|"days"|"hours"|"minutes"|"seconds"|"microseconds" $type
     * @return Chain<string|\DateTimeInterface>
     */
    public static function dateTimeDiff(string $type, Validator $validator, string|null $format = null, DateTimeImmutable|null $now = null): Chain;

    /** @return Chain<int|float|numeric-string> */
    public static function decimal(int $decimals): Chain;

    /** @return Chain<scalar> */
    public static function digit(string ...$additionalChars): Chain;

    /** @return Chain<string|\SplFileInfo> */
    public static function directory(): Chain;

    /** @return Chain<string> */
    public static function domain(bool $tldCheck = true): Chain;

    /**
     * @template T
     * @param Chain<T> $validator
     * @return Chain<iterable<T>>
     */
    public static function each(Validator $validator): Chain;

    /** @return Chain<mixed> */
    public static function eachKey(Validator $validator): Chain;

    /** @return Chain<string> */
    public static function email(): Chain;

    /** @return Chain<string> */
    public static function emoji(): Chain;

    /** @return Chain<array|string> */
    public static function endsWith(mixed $endValue, mixed ...$endValues): Chain;

    /** @return Chain<mixed> */
    public static function equals(mixed $compareTo): Chain;

    /** @return Chain<mixed> */
    public static function equivalent(mixed $compareTo): Chain;

    /** @return Chain<int|float|numeric-string> */
    public static function even(): Chain;

    /** @return Chain<string|\SplFileInfo> */
    public static function executable(): Chain;

    /** @return Chain<string|\SplFileInfo> */
    public static function exists(): Chain;

    /** @return Chain<string|\SplFileInfo> */
    public static function extension(string $extension): Chain;

    /** @return Chain<mixed> */
    public static function factor(int $dividend): Chain;

    /**
     * @param callable(mixed): Validator $factory
     * @return Chain<mixed>
     */
    public static function factory(callable $factory): Chain;

    /** @return Chain<scalar|null> */
    public static function falseVal(): Chain;

    /** @return Chain<mixed> */
    public static function falsy(): Chain;

    /** @return Chain<string|\SplFileInfo> */
    public static function file(): Chain;

    /** @return Chain<int|float|numeric-string> */
    public static function finite(): Chain;

    /** @return Chain<float> */
    public static function floatType(): Chain;

    /** @return Chain<int|float|numeric-string|true> */
    public static function floatVal(): Chain;

    /** @return Chain<scalar|\Stringable> */
    public static function format(Formatter $formatter): Chain;

    /** @return Chain<scalar|\Stringable> */
    public static function formatted(Formatter $formatter, Validator $validator): Chain;

    /** @return Chain<mixed> */
    public static function given(Validator $when, Validator $then): Chain;

    /** @return Chain<scalar> */
    public static function graph(string ...$additionalChars): Chain;

    /** @return Chain<mixed> */
    public static function greaterThan(mixed $compareTo): Chain;

    /** @return Chain<mixed> */
    public static function greaterThanOrEqual(mixed $compareTo): Chain;

    /** @return Chain<string> */
    public static function hetu(): Chain;

    /** @return Chain<scalar> */
    public static function hexRgbColor(): Chain;

    /** @return Chain<string> */
    public static function iban(): Chain;

    /**
     * @template T
     * @param T $compareTo
     * @return Chain<T>
     */
    public static function identical(mixed $compareTo): Chain;

    /** @return Chain<string|\SplFileInfo> */
    public static function image(): Chain;

    /** @return Chain<scalar> */
    public static function imei(): Chain;

    /** @return Chain<mixed> */
    public static function in(mixed $haystack): Chain;

    /** @return Chain<int|float|numeric-string> */
    public static function infinite(): Chain;

    /**
     * @template T of object
     * @param class-string<T> $class
     * @return Chain<T>
     */
    public static function instance(string $class): Chain;

    /** @return Chain<int> */
    public static function intType(): Chain;

    /** @return Chain<int|numeric-string> */
    public static function intVal(): Chain;

    /** @return Chain<string> */
    public static function ip(string $range = '*', int|null $options = null): Chain;

    /** @return Chain<scalar> */
    public static function isbn(): Chain;

    /** @return Chain<iterable> */
    public static function iterableType(): Chain;

    /** @return Chain<array|\stdClass|\Traversable> */
    public static function iterableVal(): Chain;

    /** @return Chain<string> */
    public static function json(): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function key(int|string $key, Validator $validator): Chain;

    /** @return Chain<array|\ArrayAccess> */
    public static function keyExists(int|string $key): Chain;

    /** @return Chain<mixed> */
    public static function keyOptional(int|string $key, Validator $validator): Chain;

    /** @return Chain<array> */
    public static function keySet(Validator $validator, Validator ...$validators): Chain;

    /**
     * @param "alpha-2"|"alpha-3" $set
     * @return Chain<string>
     */
    public static function languageCode(string $set = 'alpha-2'): Chain;

    /** @return Chain<scalar|\DateTimeInterface> */
    public static function leapDate(string $format): Chain;

    /** @return Chain<scalar|\DateTimeInterface> */
    public static function leapYear(): Chain;

    /** @return Chain<string|array|\Countable> */
    public static function length(Validator $validator): Chain;

    /** @return Chain<mixed> */
    public static function lessThan(mixed $compareTo): Chain;

    /** @return Chain<mixed> */
    public static function lessThanOrEqual(mixed $compareTo): Chain;

    /** @return Chain<string> */
    public static function lowercase(): Chain;

    /** @return Chain<scalar> */
    public static function luhn(): Chain;

    /** @return Chain<string> */
    public static function macAddress(): Chain;

    /** @return Chain<iterable> */
    public static function max(Validator $validator): Chain;

    /** @return Chain<string|\SplFileInfo> */
    public static function mimetype(string $mimetype): Chain;

    /** @return Chain<iterable> */
    public static function min(Validator $validator): Chain;

    /** @return Chain<mixed> */
    public static function multiple(int $multipleOf): Chain;

    /** @return Chain<mixed> */
    public static function named(Name|string $name, Validator $validator): Chain;

    /** @return Chain<int|float|numeric-string> */
    public static function negative(): Chain;

    /** @return Chain<string> */
    public static function nfeAccessKey(): Chain;

    /** @return Chain<string> */
    public static function nif(): Chain;

    /** @return Chain<scalar> */
    public static function nip(): Chain;

    /** @return Chain<mixed> */
    public static function noneOf(Validator $validator1, Validator $validator2, Validator ...$validators): Chain;

    /** @return Chain<mixed> */
    public static function not(Validator $validator): Chain;

    /** @return Chain<mixed> */
    public static function nullOr(Validator $validator): Chain;

    /** @return Chain<null> */
    public static function nullType(): Chain;

    /** @return Chain<int|float|numeric-string> */
    public static function number(): Chain;

    /** @return Chain<int|float|numeric-string> */
    public static function numericVal(): Chain;

    /** @return Chain<object> */
    public static function objectType(): Chain;

    /** @return Chain<int|float|numeric-string> */
    public static function odd(): Chain;

    /** @return Chain<mixed> */
    public static function oneOf(Validator $validator1, Validator $validator2, Validator ...$validators): Chain;

    /** @return Chain<scalar> */
    public static function pesel(): Chain;

    /** @return Chain<scalar> */
    public static function phone(string|null $countryCode = null): Chain;

    /** @return Chain<scalar> */
    public static function pis(): Chain;

    /** @return Chain<scalar> */
    public static function polishIdCard(): Chain;

    /** @return Chain<string> */
    public static function portugueseNif(): Chain;

    /** @return Chain<int|float|numeric-string> */
    public static function positive(): Chain;

    /** @return Chain<scalar> */
    public static function postalCode(string $countryCode, bool $formatted = false): Chain;

    /** @return Chain<scalar> */
    public static function printable(string ...$additionalChars): Chain;

    /** @return Chain<object> */
    public static function property(string $propertyName, Validator $validator): Chain;

    /** @return Chain<object> */
    public static function propertyExists(string $propertyName): Chain;

    /** @return Chain<mixed> */
    public static function propertyOptional(string $propertyName, Validator $validator): Chain;

    /** @return Chain<scalar> */
    public static function publicDomainSuffix(): Chain;

    /** @return Chain<scalar> */
    public static function punct(string ...$additionalChars): Chain;

    /** @return Chain<string|\SplFileInfo|\Psr\Http\Message\StreamInterface> */
    public static function readable(): Chain;

    /** @return Chain<scalar> */
    public static function regex(string $regex): Chain;

    /** @return Chain<resource> */
    public static function resourceType(): Chain;

    /** @return Chain<string> */
    public static function roman(): Chain;

    /** @return Chain<mixed> */
    public static function satisfies(callable $callback, mixed ...$arguments): Chain;

    /** @return Chain<int|float|bool|string> */
    public static function scalarVal(): Chain;

    /** @return Chain<mixed> */
    public static function shortCircuit(Validator ...$validators): Chain;

    /**
     * @param "B"|"KB"|"MB"|"GB"|"TB"|"PB"|"EB"|"ZB"|"YB" $unit
     * @return Chain<string|\SplFileInfo|\Psr\Http\Message\UploadedFileInterface|\Psr\Http\Message\StreamInterface>
     */
    public static function size(string $unit, Validator $validator): Chain;

    /** @return Chain<string> */
    public static function slug(): Chain;

    /** @return Chain<array|string> */
    public static function sorted(string $direction): Chain;

    /** @return Chain<scalar> */
    public static function space(string ...$additionalChars): Chain;

    /** @return Chain<string> */
    public static function spaced(): Chain;

    /** @return Chain<array|string> */
    public static function startsWith(mixed $startValue, mixed ...$startValues): Chain;

    /** @return Chain<string> */
    public static function stringType(): Chain;

    /** @return Chain<scalar|\Stringable> */
    public static function stringVal(): Chain;

    /** @return Chain<scalar|null> */
    public static function subdivisionCode(string $countryCode): Chain;

    /**
     * @param mixed[] $superset
     * @return Chain<array>
     */
    public static function subset(array $superset): Chain;

    /** @return Chain<string|\SplFileInfo> */
    public static function symbolicLink(): Chain;

    /**
     * @param array<string, mixed> $parameters
     * @return Chain<mixed>
     */
    public static function templated(string $template, Validator $validator, array $parameters = []): Chain;

    /** @return Chain<scalar> */
    public static function time(string $format = 'H:i:s'): Chain;

    /** @return Chain<string> */
    public static function tld(): Chain;

    /** @return Chain<string> */
    public static function trimmed(string ...$trimValues): Chain;

    /** @return Chain<scalar> */
    public static function trueVal(): Chain;

    /** @return Chain<null|''> */
    public static function undef(): Chain;

    /** @return Chain<mixed> */
    public static function undefOr(Validator $validator): Chain;

    /** @return Chain<array> */
    public static function unique(): Chain;

    /** @return Chain<string> */
    public static function uppercase(): Chain;

    /** @return Chain<string> */
    public static function url(): Chain;

    /** @return Chain<string|\Ramsey\Uuid\UuidInterface> */
    public static function uuid(int|null $version = null): Chain;

    /** @return Chain<string> */
    public static function version(): Chain;

    /** @return Chain<scalar> */
    public static function vowel(string ...$additionalChars): Chain;

    /** @return Chain<mixed> */
    public static function when(Validator $when, Validator $then, Validator|null $else = null): Chain;

    /** @return Chain<string|\SplFileInfo|\Psr\Http\Message\StreamInterface> */
    public static function writable(): Chain;

    /** @return Chain<scalar> */
    public static function xdigit(string ...$additionalChars): Chain;
}
