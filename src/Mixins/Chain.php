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
use Respect\Validation\ValidatorBuilder;

/**
 * @template-covariant TSure
 * @mixin ValidatorBuilder
 */
interface Chain extends Validator, AllChain, KeyChain, LengthChain, MaxChain, MinChain, NotChain, NullOrChain, PropertyChain, UndefOrChain
{
    /** @return Chain<TSure> */
    public function after(callable $callable, Validator $validator): Chain;

    /**
     * @template T
     * @param Chain<T> $validator
     * @return Chain<iterable<T>>
     */
    public function all(Validator $validator): Chain;

    /** @return Chain<TSure> */
    public function allOf(Validator $validator1, Validator $validator2, Validator ...$validators): Chain;

    /** @return Chain<TSure> */
    public function alnum(string ...$additionalChars): Chain;

    /** @return Chain<TSure> */
    public function alpha(string ...$additionalChars): Chain;

    /** @return Chain<TSure> */
    public function alwaysInvalid(): Chain;

    /** @return Chain<TSure> */
    public function alwaysValid(): Chain;

    /** @return Chain<TSure> */
    public function anyOf(Validator $validator1, Validator $validator2, Validator ...$validators): Chain;

    /** @return Chain<TSure> */
    public function arrayType(): Chain;

    /** @return Chain<TSure> */
    public function arrayVal(): Chain;

    /** @return Chain<TSure> */
    public function attributes(): Chain;

    /** @return Chain<TSure> */
    public function base(int $base, string $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'): Chain;

    /** @return Chain<TSure> */
    public function base64(): Chain;

    /** @return Chain<TSure> */
    public function between(mixed $minValue, mixed $maxValue): Chain;

    /** @return Chain<TSure> */
    public function betweenExclusive(mixed $minimum, mixed $maximum): Chain;

    /** @return Chain<TSure> */
    public function blank(): Chain;

    /** @return Chain<TSure> */
    public function boolType(): Chain;

    /** @return Chain<TSure> */
    public function boolVal(): Chain;

    /** @return Chain<TSure> */
    public function bsn(): Chain;

    /** @return Chain<TSure> */
    public function callableType(): Chain;

    /** @return Chain<TSure> */
    public function charset(string $charset, string ...$charsets): Chain;

    /** @return Chain<TSure> */
    public function cnh(): Chain;

    /** @return Chain<TSure> */
    public function cnpj(): Chain;

    /** @return Chain<TSure> */
    public function consonant(string ...$additionalChars): Chain;

    /** @return Chain<TSure> */
    public function contains(mixed $containsValue): Chain;

    /**
     * @param non-empty-array<mixed> $needles
     * @return Chain<TSure>
     */
    public function containsAny(array $needles): Chain;

    /** @return Chain<TSure> */
    public function containsCount(mixed $containsValue, int $count): Chain;

    /** @return Chain<TSure> */
    public function control(string ...$additionalChars): Chain;

    /** @return Chain<TSure> */
    public function countable(): Chain;

    /**
     * @param "alpha-2"|"alpha-3"|"numeric" $set
     * @return Chain<TSure>
     */
    public function countryCode(string $set = 'alpha-2'): Chain;

    /** @return Chain<TSure> */
    public function cpf(): Chain;

    /** @return Chain<TSure> */
    public function creditCard(string $brand = 'Any'): Chain;

    /**
     * @param "alpha-3"|"numeric" $set
     * @return Chain<TSure>
     */
    public function currencyCode(string $set = 'alpha-3'): Chain;

    /** @return Chain<TSure> */
    public function date(string $format = 'Y-m-d'): Chain;

    /** @return Chain<TSure> */
    public function dateTime(string|null $format = null): Chain;

    /**
     * @param "years"|"months"|"days"|"hours"|"minutes"|"seconds"|"microseconds" $type
     * @return Chain<TSure>
     */
    public function dateTimeDiff(string $type, Validator $validator, string|null $format = null, DateTimeImmutable|null $now = null): Chain;

    /** @return Chain<TSure> */
    public function decimal(int $decimals): Chain;

    /** @return Chain<TSure> */
    public function digit(string ...$additionalChars): Chain;

    /** @return Chain<TSure> */
    public function directory(): Chain;

    /** @return Chain<TSure> */
    public function domain(bool $tldCheck = true): Chain;

    /**
     * @template T
     * @param Chain<T> $validator
     * @return Chain<iterable<T>>
     */
    public function each(Validator $validator): Chain;

    /** @return Chain<TSure> */
    public function eachKey(Validator $validator): Chain;

    /** @return Chain<TSure> */
    public function email(): Chain;

    /** @return Chain<TSure> */
    public function emoji(): Chain;

    /** @return Chain<TSure> */
    public function endsWith(mixed $endValue, mixed ...$endValues): Chain;

    /** @return Chain<TSure> */
    public function equals(mixed $compareTo): Chain;

    /** @return Chain<TSure> */
    public function equivalent(mixed $compareTo): Chain;

    /** @return Chain<TSure> */
    public function even(): Chain;

    /** @return Chain<TSure> */
    public function executable(): Chain;

    /** @return Chain<TSure> */
    public function exists(): Chain;

    /** @return Chain<TSure> */
    public function extension(string $extension): Chain;

    /** @return Chain<TSure> */
    public function factor(int $dividend): Chain;

    /**
     * @param callable(mixed): Validator $factory
     * @return Chain<TSure>
     */
    public function factory(callable $factory): Chain;

    /** @return Chain<TSure> */
    public function falseVal(): Chain;

    /** @return Chain<TSure> */
    public function falsy(): Chain;

    /** @return Chain<TSure> */
    public function file(): Chain;

    /** @return Chain<TSure> */
    public function finite(): Chain;

    /** @return Chain<TSure> */
    public function floatType(): Chain;

    /** @return Chain<TSure> */
    public function floatVal(): Chain;

    /** @return Chain<TSure> */
    public function format(Formatter $formatter): Chain;

    /** @return Chain<TSure> */
    public function formatted(Formatter $formatter, Validator $validator): Chain;

    /** @return Chain<TSure> */
    public function given(Validator $when, Validator $then): Chain;

    /** @return Chain<TSure> */
    public function graph(string ...$additionalChars): Chain;

    /** @return Chain<TSure> */
    public function greaterThan(mixed $compareTo): Chain;

    /** @return Chain<TSure> */
    public function greaterThanOrEqual(mixed $compareTo): Chain;

    /** @return Chain<TSure> */
    public function hetu(): Chain;

    /** @return Chain<TSure> */
    public function hexRgbColor(): Chain;

    /** @return Chain<TSure> */
    public function iban(): Chain;

    /** @return Chain<TSure> */
    public function identical(mixed $compareTo): Chain;

    /** @return Chain<TSure> */
    public function image(): Chain;

    /** @return Chain<TSure> */
    public function imei(): Chain;

    /** @return Chain<TSure> */
    public function in(mixed $haystack): Chain;

    /** @return Chain<TSure> */
    public function infinite(): Chain;

    /**
     * @param class-string $class
     * @return Chain<TSure>
     */
    public function instance(string $class): Chain;

    /** @return Chain<TSure> */
    public function intType(): Chain;

    /** @return Chain<TSure> */
    public function intVal(): Chain;

    /** @return Chain<TSure> */
    public function ip(string $range = '*', int|null $options = null): Chain;

    /** @return Chain<TSure> */
    public function isbn(): Chain;

    /** @return Chain<TSure> */
    public function iterableType(): Chain;

    /** @return Chain<TSure> */
    public function iterableVal(): Chain;

    /** @return Chain<TSure> */
    public function json(): Chain;

    /** @return Chain<TSure> */
    public function key(int|string $key, Validator $validator): Chain;

    /** @return Chain<TSure> */
    public function keyExists(int|string $key): Chain;

    /** @return Chain<TSure> */
    public function keyOptional(int|string $key, Validator $validator): Chain;

    /** @return Chain<TSure> */
    public function keySet(Validator $validator, Validator ...$validators): Chain;

    /**
     * @param "alpha-2"|"alpha-3" $set
     * @return Chain<TSure>
     */
    public function languageCode(string $set = 'alpha-2'): Chain;

    /** @return Chain<TSure> */
    public function leapDate(string $format): Chain;

    /** @return Chain<TSure> */
    public function leapYear(): Chain;

    /** @return Chain<TSure> */
    public function length(Validator $validator): Chain;

    /** @return Chain<TSure> */
    public function lessThan(mixed $compareTo): Chain;

    /** @return Chain<TSure> */
    public function lessThanOrEqual(mixed $compareTo): Chain;

    /** @return Chain<TSure> */
    public function lowercase(): Chain;

    /** @return Chain<TSure> */
    public function luhn(): Chain;

    /** @return Chain<TSure> */
    public function macAddress(): Chain;

    /** @return Chain<TSure> */
    public function max(Validator $validator): Chain;

    /** @return Chain<TSure> */
    public function mimetype(string $mimetype): Chain;

    /** @return Chain<TSure> */
    public function min(Validator $validator): Chain;

    /** @return Chain<TSure> */
    public function multiple(int $multipleOf): Chain;

    /** @return Chain<TSure> */
    public function named(Name|string $name, Validator $validator): Chain;

    /** @return Chain<TSure> */
    public function negative(): Chain;

    /** @return Chain<TSure> */
    public function nfeAccessKey(): Chain;

    /** @return Chain<TSure> */
    public function nif(): Chain;

    /** @return Chain<TSure> */
    public function nip(): Chain;

    /** @return Chain<TSure> */
    public function noneOf(Validator $validator1, Validator $validator2, Validator ...$validators): Chain;

    /** @return Chain<TSure> */
    public function not(Validator $validator): Chain;

    /** @return Chain<TSure> */
    public function nullOr(Validator $validator): Chain;

    /** @return Chain<TSure> */
    public function nullType(): Chain;

    /** @return Chain<TSure> */
    public function number(): Chain;

    /** @return Chain<TSure> */
    public function numericVal(): Chain;

    /** @return Chain<TSure> */
    public function objectType(): Chain;

    /** @return Chain<TSure> */
    public function odd(): Chain;

    /** @return Chain<TSure> */
    public function oneOf(Validator $validator1, Validator $validator2, Validator ...$validators): Chain;

    /** @return Chain<TSure> */
    public function pesel(): Chain;

    /** @return Chain<TSure> */
    public function phone(string|null $countryCode = null): Chain;

    /** @return Chain<TSure> */
    public function pis(): Chain;

    /** @return Chain<TSure> */
    public function polishIdCard(): Chain;

    /** @return Chain<TSure> */
    public function portugueseNif(): Chain;

    /** @return Chain<TSure> */
    public function positive(): Chain;

    /** @return Chain<TSure> */
    public function postalCode(string $countryCode, bool $formatted = false): Chain;

    /** @return Chain<TSure> */
    public function printable(string ...$additionalChars): Chain;

    /** @return Chain<TSure> */
    public function property(string $propertyName, Validator $validator): Chain;

    /** @return Chain<TSure> */
    public function propertyExists(string $propertyName): Chain;

    /** @return Chain<TSure> */
    public function propertyOptional(string $propertyName, Validator $validator): Chain;

    /** @return Chain<TSure> */
    public function publicDomainSuffix(): Chain;

    /** @return Chain<TSure> */
    public function punct(string ...$additionalChars): Chain;

    /** @return Chain<TSure> */
    public function readable(): Chain;

    /** @return Chain<TSure> */
    public function regex(string $regex): Chain;

    /** @return Chain<TSure> */
    public function resourceType(): Chain;

    /** @return Chain<TSure> */
    public function roman(): Chain;

    /** @return Chain<TSure> */
    public function satisfies(callable $callback, mixed ...$arguments): Chain;

    /** @return Chain<TSure> */
    public function scalarVal(): Chain;

    /** @return Chain<TSure> */
    public function shortCircuit(Validator ...$validators): Chain;

    /**
     * @param "B"|"KB"|"MB"|"GB"|"TB"|"PB"|"EB"|"ZB"|"YB" $unit
     * @return Chain<TSure>
     */
    public function size(string $unit, Validator $validator): Chain;

    /** @return Chain<TSure> */
    public function slug(): Chain;

    /** @return Chain<TSure> */
    public function sorted(string $direction): Chain;

    /** @return Chain<TSure> */
    public function space(string ...$additionalChars): Chain;

    /** @return Chain<TSure> */
    public function spaced(): Chain;

    /** @return Chain<TSure> */
    public function startsWith(mixed $startValue, mixed ...$startValues): Chain;

    /** @return Chain<TSure> */
    public function stringType(): Chain;

    /** @return Chain<TSure> */
    public function stringVal(): Chain;

    /** @return Chain<TSure> */
    public function subdivisionCode(string $countryCode): Chain;

    /**
     * @param mixed[] $superset
     * @return Chain<TSure>
     */
    public function subset(array $superset): Chain;

    /** @return Chain<TSure> */
    public function symbolicLink(): Chain;

    /**
     * @param array<string, mixed> $parameters
     * @return Chain<TSure>
     */
    public function templated(string $template, Validator $validator, array $parameters = []): Chain;

    /** @return Chain<TSure> */
    public function time(string $format = 'H:i:s'): Chain;

    /** @return Chain<TSure> */
    public function tld(): Chain;

    /** @return Chain<TSure> */
    public function trimmed(string ...$trimValues): Chain;

    /** @return Chain<TSure> */
    public function trueVal(): Chain;

    /** @return Chain<TSure> */
    public function undef(): Chain;

    /** @return Chain<TSure> */
    public function undefOr(Validator $validator): Chain;

    /** @return Chain<TSure> */
    public function unique(): Chain;

    /** @return Chain<TSure> */
    public function uppercase(): Chain;

    /** @return Chain<TSure> */
    public function url(): Chain;

    /** @return Chain<TSure> */
    public function uuid(int|null $version = null): Chain;

    /** @return Chain<TSure> */
    public function version(): Chain;

    /** @return Chain<TSure> */
    public function vowel(string ...$additionalChars): Chain;

    /** @return Chain<TSure> */
    public function when(Validator $when, Validator $then, Validator|null $else = null): Chain;

    /** @return Chain<TSure> */
    public function writable(): Chain;

    /** @return Chain<TSure> */
    public function xdigit(string ...$additionalChars): Chain;

    /**
     * @phpstan-assert TSure $input
     * @psalm-assert TSure $input
     */
    public function assert(mixed $input, mixed $template = null): void;

    /**
     * @phpstan-assert TSure $input
     * @psalm-assert TSure $input
     */
    public function check(mixed $input, mixed $template = null): void;

    public function isValid(mixed $input): bool;
}
