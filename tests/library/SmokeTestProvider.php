<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Test;

use Generator;
use Respect\Validation\Mixins\Chain;
use Respect\Validation\ValidatorBuilder as v;
use stdClass;

use function fopen;

use const FILTER_VALIDATE_EMAIL;
use const INF;

trait SmokeTestProvider
{
    public static function provideValidatorInput(): Generator
    {
        yield 'All' => [v::all(v::intVal()), [1, 2, 3]];
        yield 'AllOf' => [v::allOf(v::intVal(), v::greaterThan(0)), 5];
        yield 'Alnum' => [v::alnum(), 'abc123'];
        yield 'Alpha' => [v::alpha(), 'abc'];
        yield 'AlwaysInvalid' => [v::not(v::alwaysInvalid()), 'whatever'];
        yield 'AlwaysValid' => [v::alwaysValid(), 'whatever'];
        yield 'AnyOf' => [v::anyOf(v::intVal(), v::stringVal()), 5];
        yield 'ArrayType' => [v::arrayType(), []];
        yield 'ArrayVal' => [v::arrayVal(), []];
        yield 'Attributes' => [v::attributes(), (object) ['required' => true]];
        yield 'Base' => [v::base(2), '001001'];
        yield 'Base64' => [v::base64(), 'U29tZSBCYXNlNjQgU3RyaW5n'];
        yield 'Between' => [v::between(1, 10), 5];
        yield 'BetweenExclusive' => [v::betweenExclusive(1, 10), 5];
        yield 'Blank' => [v::blank(), ''];
        yield 'BoolType' => [v::boolType(), true];
        yield 'BoolVal' => [v::boolVal(), true];
        yield 'Bsn' => [v::bsn(), '612890053'];
        yield 'Call' => [v::call('array_keys', v::each(v::stringType())), ['a' => 'b']];
        yield 'CallableType' => [v::callableType(), [static::class, 'callableTarget']];
        yield 'Callback' => [v::callback('is_string'), 'valid'];
        yield 'Charset' => [v::charset('UTF-8'), 'example'];
        yield 'Circuit' => [v::circuit(v::intVal(), v::greaterThan(0)), 5];
        yield 'Cnh' => [v::cnh(), '02650306461'];
        yield 'Cnpj' => [v::cnpj(), '11444777000161'];
        yield 'Consonant' => [v::consonant(), 'bcdf'];
        yield 'Contains' => [v::contains('needle'), 'haystack needle'];
        yield 'ContainsAny' => [v::containsAny(['a', 'b']), 'abc'];
        yield 'ContainsCount' => [v::containsCount('foo', 2), 'foo bar foo'];
        yield 'Control' => [v::control(), "\n\r"];
        yield 'Countable' => [v::countable(), []];
        yield 'CountryCode' => [v::countryCode(), 'US'];
        yield 'Cpf' => [v::cpf(), '11598647644'];
        yield 'CreditCard' => [v::creditCard(), '4111111111111111'];
        yield 'CurrencyCode' => [v::currencyCode(), 'USD'];
        yield 'Date' => [v::date(), '2020-01-01'];
        yield 'DateTime' => [v::dateTime(), '2020-01-01 12:00:00'];
        yield 'DateTimeDiff' => [v::dateTimeDiff('years', v::greaterThan(18), 'd/m/Y'), '09/12/1990'];
        yield 'Decimal' => [v::decimal(2), '1.23'];
        yield 'Digit' => [v::digit(), '7'];
        yield 'Directory' => [v::directory(), 'tests/fixtures'];
        yield 'Domain' => [v::domain(), 'example.com'];
        yield 'Each' => [v::each(v::stringType()), ['a', 'b']];
        yield 'Email' => [v::email(), 'bob@example.com'];
        yield 'Emoji' => [v::emoji(), '😀'];
        yield 'EndsWith' => [v::endsWith('.com'), 'example.com'];
        yield 'Equals' => [v::equals('x'), 'x'];
        yield 'Equivalent' => [v::equivalent(123), 123.0];
        yield 'Even' => [v::even(), 2];
        yield 'Executable' => [v::executable(), 'tests/fixtures/executable'];
        yield 'Exists' => [v::exists(), 'tests/fixtures/valid-image.png'];
        yield 'Extension' => [v::extension('png'), 'image.png'];
        yield 'Factor' => [v::factor(0), 36];
        yield 'FalseVal' => [v::falseVal(), false];
        yield 'Falsy' => [v::falsy(), 0];
        yield 'Fibonacci' => [v::fibonacci(), 13];
        yield 'File' => [v::file(), __FILE__];
        yield 'FilterVar' => [v::filterVar(FILTER_VALIDATE_EMAIL), 'bob@example.com'];
        yield 'Finite' => [v::finite(), 1.23];
        yield 'FloatType' => [v::floatType(), 1.23];
        yield 'FloatVal' => [v::floatVal(), 1.23];
        yield 'Graph' => [v::graph(), 'abc123!@#'];
        yield 'GreaterThan' => [v::greaterThan(0), 1];
        yield 'GreaterThanOrEqual' => [v::greaterThanOrEqual(1), 1];
        yield 'Hetu' => [v::hetu(), '010106A9012'];
        yield 'HexRGBColor' => [v::hexRgbColor(), '#FFAABB'];
        yield 'Iban' => [v::iban(), 'SE35 5000 0000 0549 1000 0003'];
        yield 'Identical' => [v::identical(123), 123];
        yield 'Imei' => [v::imei(), '490154203237518'];
        yield 'In' => [v::in(['a', 'b']), 'a'];
        yield 'Infinite' => [v::infinite(), INF];
        yield 'Instance' => [v::instance(stdClass::class), new stdClass()];
        yield 'IntType' => [v::intType(), 123];
        yield 'IntVal' => [v::intVal(), 123];
        yield 'Ip' => [v::ip(), '127.0.0.1'];
        yield 'Isbn' => [v::isbn(), '9783161484100'];
        yield 'IterableType' => [v::iterableType(), []];
        yield 'IterableVal' => [v::iterableVal(), []];
        yield 'Json' => [v::json(), '{"key":"value"}'];
        yield 'Key' => [v::key('name', v::stringType()), ['name' => 'value']];
        yield 'KeyExists' => [v::keyExists('name'), ['name' => 'value']];
        yield 'KeyOptional' => [v::keyOptional('missing', v::stringType()), ['name' => 'value']];
        yield 'KeySet' => [v::keySet(v::key('name', v::stringType())), ['name' => 'value']];
        yield 'LanguageCode' => [v::languageCode(), 'en'];
        yield 'Lazy' => [v::lazy([static::class, 'callableLazy']), 123];
        yield 'LeapDate' => [v::leapDate('Y-m-d'), '2020-02-29'];
        yield 'LeapYear' => [v::leapYear(), 2020];
        yield 'Length' => [v::length(v::equals(4)), 'abcd'];
        yield 'LessThan' => [v::lessThan(10), 5];
        yield 'LessThanOrEqual' => [v::lessThanOrEqual(10), 10];
        yield 'Lowercase' => [v::lowercase(), 'abc'];
        yield 'Luhn' => [v::luhn(), '2222400041240011'];
        yield 'MacAddress' => [v::macAddress(), '00:11:22:33:44:55'];
        yield 'Max' => [v::max(v::equals(30)), [10, 20, 30]];
        yield 'Min' => [v::min(v::equals(10)), [10, 20, 30]];
        yield 'Multiple' => [v::multiple(3), 9];
        yield 'Named' => [v::named('MyValidator', v::intVal()), 123];
        yield 'Negative' => [v::negative(), -1];
        yield 'NfeAccessKey' => [v::nfeAccessKey(), '52060433009911002506550120000007800267301615'];
        yield 'Nif' => [v::nif(), '12345678Z'];
        yield 'Nip' => [v::nip(), '1645865777'];
        yield 'Not' => [v::not(v::trueVal()), false];
        yield 'NullOr' => [v::nullOr(v::intVal()), null];
        yield 'Number' => [v::number(), '123'];
        yield 'NullType' => [v::nullType(), null];
        yield 'NumericVal' => [v::numericVal(), '123'];
        yield 'Odd' => [v::odd(), 3];
        yield 'OneOf' => [v::oneOf(v::digit(), v::alpha()), 'AB'];
        yield 'PerfectSquare' => [v::perfectSquare(), 16];
        yield 'Pesel' => [v::pesel(), '21120209256'];
        yield 'Phone' => [v::phone(), '+1 650 253 00 00'];
        yield 'PhpLabel' => [v::phpLabel(), 'valid_label'];
        yield 'Pis' => [v::pis(), '120.0340.678-8'];
        yield 'PolishIdCard' => [v::polishIdCard(), 'AYW036733'];
        yield 'PortugueseNif' => [v::portugueseNif(), '123456789'];
        yield 'Positive' => [v::positive(), 1];
        yield 'PostalCode' => [v::postalCode('US'), '12345'];
        yield 'PrimeNumber' => [v::primeNumber(), 7];
        yield 'Printable' => [v::printable(), 'abc123!@#'];
        yield 'Property' => [v::property('email', v::endsWith('@example.com')), (object) ['email' => 'a@example.com']];
        yield 'PropertyExists' => [v::propertyExists('email'), (object) ['email' => 'a@example.com']];
        yield 'PropertyOptional' => [v::propertyOptional('missing', v::email()), (object) ['email' => 'a@example.com']];
        yield 'PublicDomainSuffix' => [v::publicDomainSuffix(), 'co.uk'];
        yield 'Punct' => [v::punct(), '!@#'];
        yield 'Readable' => [v::readable(), 'tests/fixtures/valid-image.png'];
        yield 'Regex' => [v::regex('/^[a-z]+$/'), 'abc'];
        yield 'ResourceType' => [v::resourceType(), fopen('php://temp', 'r')];
        yield 'Roman' => [v::roman(), 'XIV'];
        yield 'ScalarVal' => [v::scalarVal(), 'example'];
        yield 'Slug' => [v::slug(), 'a-valid-slug'];
        yield 'Sorted' => [v::sorted('ASC'), [1, 2, 3]];
        yield 'Space' => [v::space(), " \t\n"];
        yield 'Spaced' => [v::spaced(), 'a b c'];
        yield 'StartsWith' => [v::startsWith('ex'), 'example'];
        yield 'StringType' => [v::stringType(), 'example'];
        yield 'StringVal' => [v::stringVal(), 'example'];
        yield 'SubdivisionCode' => [v::subdivisionCode('US'), 'CA'];
        yield 'Subset' => [v::subset(['a', 'b', 'c']), ['a', 'b']];
        yield 'SymbolicLink' => [v::symbolicLink(), 'tests/fixtures/symbolic-link'];
        yield 'Time' => [v::time(), '12:34:56'];
        yield 'Tld' => [v::tld(), 'com'];
        yield 'TrueVal' => [v::trueVal(), true];
        yield 'Undef' => [v::undef(), null];
        yield 'UndefOr' => [v::undefOr(v::intVal()), null];
        yield 'Unique' => [v::unique(), [1, 2, 3]];
        yield 'Uppercase' => [v::uppercase(), 'ABC'];
        yield 'Uuid' => [v::uuid(), '123e4567-e89b-12d3-a456-426655440000'];
        yield 'Version' => [v::version(), '1.2.3'];
        yield 'VideoUrl' => [v::videoUrl(), 'https://www.youtube.com/watch?v=dQw4w9WgXcQ'];
        yield 'Vowel' => [v::vowel(), 'aeiou'];
        yield 'When' => [v::when(v::intVal(), v::alwaysValid(), v::alwaysInvalid()), 5];
        yield 'Writable' => [v::writable(), 'tests/fixtures/valid-image.png'];
        yield 'Xdigit' => [v::xdigit(), 'AF'];
    }

    public static function callableTarget(): true
    {
        return true;
    }

    public static function callableLazy(): v|Chain
    {
        return v::intVal();
    }
}
