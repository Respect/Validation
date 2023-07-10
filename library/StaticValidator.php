<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation;

use finfo;

interface StaticValidator
{
    public static function allOf(Validatable ...$rule): ChainedValidator;

    public static function alnum(string ...$additionalChars): ChainedValidator;

    public static function alpha(string ...$additionalChars): ChainedValidator;

    public static function alwaysInvalid(): ChainedValidator;

    public static function alwaysValid(): ChainedValidator;

    public static function anyOf(Validatable ...$rule): ChainedValidator;

    public static function arrayType(): ChainedValidator;

    public static function arrayVal(): ChainedValidator;

    public static function attribute(
        string $reference,
        ?Validatable $validator = null,
        bool $mandatory = true
    ): ChainedValidator;

    public static function base(int $base, ?string $chars = null): ChainedValidator;

    public static function base64(): ChainedValidator;

    /**
     * @param mixed $minimum
     * @param mixed $maximum
     */
    public static function between($minimum, $maximum): ChainedValidator;

    public static function bic(string $countryCode): ChainedValidator;

    public static function boolType(): ChainedValidator;

    public static function boolVal(): ChainedValidator;

    public static function bsn(): ChainedValidator;

    public static function call(callable $callable, Validatable $rule): ChainedValidator;

    public static function callableType(): ChainedValidator;

    public static function callback(callable $callback): ChainedValidator;

    public static function charset(string ...$charset): ChainedValidator;

    public static function cnh(): ChainedValidator;

    public static function cnpj(): ChainedValidator;

    public static function control(string ...$additionalChars): ChainedValidator;

    public static function consonant(string ...$additionalChars): ChainedValidator;

    /**
     * @param mixed $containsValue
     */
    public static function contains($containsValue, bool $identical = false): ChainedValidator;

    /**
     * @param mixed[] $needles
     */
    public static function containsAny(array $needles, bool $strictCompareArray = false): ChainedValidator;

    public static function countable(): ChainedValidator;

    public static function countryCode(?string $set = null): ChainedValidator;

    public static function currencyCode(): ChainedValidator;

    public static function cpf(): ChainedValidator;

    public static function creditCard(?string $brand = null): ChainedValidator;

    public static function date(string $format = 'Y-m-d'): ChainedValidator;

    public static function dateTime(?string $format = null): ChainedValidator;

    public static function decimal(int $decimals): ChainedValidator;

    public static function digit(string ...$additionalChars): ChainedValidator;

    public static function directory(): ChainedValidator;

    public static function domain(bool $tldCheck = true): ChainedValidator;

    public static function each(Validatable $rule): ChainedValidator;

    public static function email(): ChainedValidator;

    /**
     * @param mixed $endValue
     */
    public static function endsWith($endValue, bool $identical = false): ChainedValidator;

    /**
     * @param mixed $compareTo
     */
    public static function equals($compareTo): ChainedValidator;

    /**
     * @param mixed $compareTo
     */
    public static function equivalent($compareTo): ChainedValidator;

    public static function even(): ChainedValidator;

    public static function executable(): ChainedValidator;

    public static function exists(): ChainedValidator;

    public static function extension(string $extension): ChainedValidator;

    public static function factor(int $dividend): ChainedValidator;

    public static function falseVal(): ChainedValidator;

    public static function fibonacci(): ChainedValidator;

    public static function file(): ChainedValidator;

    /**
     * @param mixed[]|int $options
     */
    public static function filterVar(int $filter, $options = null): ChainedValidator;

    public static function finite(): ChainedValidator;

    public static function floatVal(): ChainedValidator;

    public static function floatType(): ChainedValidator;

    public static function graph(string ...$additionalChars): ChainedValidator;

    /**
     * @param mixed $compareTo
     */
    public static function greaterThan($compareTo): ChainedValidator;

    public static function hexRgbColor(): ChainedValidator;

    public static function iban(): ChainedValidator;

    /**
     * @param mixed $compareTo
     */
    public static function identical($compareTo): ChainedValidator;

    public static function image(?finfo $fileInfo = null): ChainedValidator;

    public static function imei(): ChainedValidator;

    /**
     * @param mixed[]|mixed $haystack
     */
    public static function in($haystack, bool $compareIdentical = false): ChainedValidator;

    public static function infinite(): ChainedValidator;

    public static function instance(string $instanceName): ChainedValidator;

    public static function intVal(): ChainedValidator;

    public static function intType(): ChainedValidator;

    public static function ip(string $range = '*', ?int $options = null): ChainedValidator;

    public static function isbn(): ChainedValidator;

    public static function iterableType(): ChainedValidator;

    public static function json(): ChainedValidator;

    public static function key(
        string $reference,
        ?Validatable $referenceValidator = null,
        bool $mandatory = true
    ): ChainedValidator;

    public static function keyNested(
        string $reference,
        ?Validatable $referenceValidator = null,
        bool $mandatory = true
    ): ChainedValidator;

    public static function keySet(Validatable ...$rule): ChainedValidator;

    public static function keyValue(string $comparedKey, string $ruleName, string $baseKey): ChainedValidator;

    public static function languageCode(?string $set = null): ChainedValidator;

    public static function leapDate(string $format): ChainedValidator;

    public static function leapYear(): ChainedValidator;

    public static function length(?int $min = null, ?int $max = null, bool $inclusive = true): ChainedValidator;

    public static function lowercase(): ChainedValidator;

    /**
     * @param mixed $compareTo
     */
    public static function lessThan($compareTo): ChainedValidator;

    public static function luhn(): ChainedValidator;

    public static function macAddress(): ChainedValidator;

    /**
     * @param mixed $compareTo
     */
    public static function max($compareTo): ChainedValidator;

    public static function maxAge(int $age, ?string $format = null): ChainedValidator;

    public static function mimetype(string $mimetype): ChainedValidator;

    /**
     * @param mixed $compareTo
     */
    public static function min($compareTo): ChainedValidator;

    public static function minAge(int $age, ?string $format = null): ChainedValidator;

    public static function multiple(int $multipleOf): ChainedValidator;

    public static function negative(): ChainedValidator;

    public static function nfeAccessKey(): ChainedValidator;

    public static function nif(): ChainedValidator;

    public static function nip(): ChainedValidator;

    public static function no(bool $useLocale = false): ChainedValidator;

    public static function noneOf(Validatable ...$rule): ChainedValidator;

    public static function not(Validatable $rule): ChainedValidator;

    public static function notBlank(): ChainedValidator;

    public static function notEmoji(): ChainedValidator;

    public static function notEmpty(): ChainedValidator;

    public static function notOptional(): ChainedValidator;

    public static function noWhitespace(): ChainedValidator;

    public static function nullable(Validatable $rule): ChainedValidator;

    public static function nullType(): ChainedValidator;

    public static function number(): ChainedValidator;

    public static function numericVal(): ChainedValidator;

    public static function objectType(): ChainedValidator;

    public static function odd(): ChainedValidator;

    public static function oneOf(Validatable ...$rule): ChainedValidator;

    public static function optional(Validatable $rule): ChainedValidator;

    public static function perfectSquare(): ChainedValidator;

    public static function pesel(): ChainedValidator;

    public static function phone(): ChainedValidator;

    public static function phpLabel(): ChainedValidator;

    public static function pis(): ChainedValidator;

    public static function polishIdCard(): ChainedValidator;

    public static function positive(): ChainedValidator;

    public static function postalCode(string $countryCode): ChainedValidator;

    public static function primeNumber(): ChainedValidator;

    public static function printable(string ...$additionalChars): ChainedValidator;

    public static function punct(string ...$additionalChars): ChainedValidator;

    public static function readable(): ChainedValidator;

    public static function regex(string $regex): ChainedValidator;

    public static function resourceType(): ChainedValidator;

    public static function roman(): ChainedValidator;

    public static function scalarVal(): ChainedValidator;

    public static function size(?string $minSize = null, ?string $maxSize = null): ChainedValidator;

    public static function slug(): ChainedValidator;

    public static function sorted(string $direction): ChainedValidator;

    public static function space(string ...$additionalChars): ChainedValidator;

    /**
     * @param mixed $startValue
     */
    public static function startsWith($startValue, bool $identical = false): ChainedValidator;

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

    public static function type(string $type): ChainedValidator;

    public static function unique(): ChainedValidator;

    public static function uploaded(): ChainedValidator;

    public static function uppercase(): ChainedValidator;

    public static function url(): ChainedValidator;

    public static function uuid(?int $version = null): ChainedValidator;

    public static function version(): ChainedValidator;

    public static function videoUrl(?string $service = null): ChainedValidator;

    public static function vowel(string ...$additionalChars): ChainedValidator;

    public static function when(Validatable $if, Validatable $then, ?Validatable $else = null): ChainedValidator;

    public static function writable(): ChainedValidator;

    public static function xdigit(string ...$additionalChars): ChainedValidator;

    public static function yes(bool $useLocale = false): ChainedValidator;
}
