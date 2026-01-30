<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Test;

use Generator;
use Respect\Validation\Validator;
use Respect\Validation\Validators as vs;
use stdClass;

use function fopen;

use const INF;

trait SmokeTestProvider
{
    public static function provideValidatorInput(): Generator
    {
        yield 'All' => [new vs\All(new vs\IntVal()), [1, 2, 3]];
        yield 'AllOf' => [new vs\AllOf(new vs\IntVal(), new vs\GreaterThan(0)), 5];
        yield 'Alnum' => [new vs\Alnum(), 'abc123'];
        yield 'Alpha' => [new vs\Alpha(), 'abc'];
        yield 'AlwaysInvalid' => [new vs\Not(new vs\AlwaysInvalid()), 'whatever'];
        yield 'AlwaysValid' => [new vs\AlwaysValid(), 'whatever'];
        yield 'AnyOf' => [new vs\AnyOf(new vs\IntVal(), new vs\StringVal()), 5];
        yield 'ArrayType' => [new vs\ArrayType(), []];
        yield 'ArrayVal' => [new vs\ArrayVal(), []];
        yield 'Attributes' => [new vs\Attributes(), (object) ['required' => true]];
        yield 'Base' => [new vs\Base(2), '001001'];
        yield 'Base64' => [new vs\Base64(), 'U29tZSBCYXNlNjQgU3RyaW5n'];
        yield 'Between' => [new vs\Between(1, 10), 5];
        yield 'BetweenExclusive' => [new vs\BetweenExclusive(1, 10), 5];
        yield 'Blank' => [new vs\Blank(), ''];
        yield 'BoolType' => [new vs\BoolType(), true];
        yield 'BoolVal' => [new vs\BoolVal(), true];
        yield 'Bsn' => [new vs\Bsn(), '612890053'];
        yield 'Call' => [new vs\Call('array_keys', new vs\Each(new vs\StringType())), ['a' => 'b']];
        yield 'CallableType' => [new vs\CallableType(), [static::class, 'callableTarget']];
        yield 'Callback' => [new vs\Callback('is_string'), 'valid'];
        yield 'Charset' => [new vs\Charset('UTF-8'), 'example'];
        yield 'Circuit' => [new vs\Circuit(new vs\IntVal(), new vs\GreaterThan(0)), 5];
        yield 'Cnh' => [new vs\Cnh(), '02650306461'];
        yield 'Cnpj' => [new vs\Cnpj(), '11444777000161'];
        yield 'Consonant' => [new vs\Consonant(), 'bcdf'];
        yield 'Contains' => [new vs\Contains('needle'), 'haystack needle'];
        yield 'ContainsAny' => [new vs\ContainsAny(['a', 'b']), 'abc'];
        yield 'ContainsCount' => [new vs\ContainsCount('foo', 2), 'foo bar foo'];
        yield 'Control' => [new vs\Control(), "\n\r"];
        yield 'Countable' => [new vs\Countable(), []];
        yield 'CountryCode' => [new vs\CountryCode(), 'US'];
        yield 'Cpf' => [new vs\Cpf(), '11598647644'];
        yield 'CreditCard' => [new vs\CreditCard(), '4111111111111111'];
        yield 'CurrencyCode' => [new vs\CurrencyCode(), 'USD'];
        yield 'Date' => [new vs\Date(), '2020-01-01'];
        yield 'DateTime' => [new vs\DateTime(), '2020-01-01 12:00:00'];
        yield 'DateTimeDiff' => [new vs\DateTimeDiff('years', new vs\GreaterThan(18), 'd/m/Y'), '09/12/1990'];
        yield 'Decimal' => [new vs\Decimal(2), '1.23'];
        yield 'Digit' => [new vs\Digit(), '7'];
        yield 'Directory' => [new vs\Directory(), 'tests/fixtures'];
        yield 'Domain' => [new vs\Domain(), 'example.com'];
        yield 'Each' => [new vs\Each(new vs\StringType()), ['a', 'b']];
        yield 'Email' => [new vs\Email(), 'bob@example.com'];
        yield 'Emoji' => [new vs\Emoji(), '😀'];
        yield 'EndsWith' => [new vs\EndsWith('.com'), 'example.com'];
        yield 'Equals' => [new vs\Equals('x'), 'x'];
        yield 'Equivalent' => [new vs\Equivalent(123), 123.0];
        yield 'Even' => [new vs\Even(), 2];
        yield 'Executable' => [new vs\Executable(), 'tests/fixtures/executable'];
        yield 'Exists' => [new vs\Exists(), 'tests/fixtures/valid-image.png'];
        yield 'Extension' => [new vs\Extension('png'), 'image.png'];
        yield 'Factor' => [new vs\Factor(0), 36];
        yield 'FalseVal' => [new vs\FalseVal(), false];
        yield 'Falsy' => [new vs\Falsy(), 0];
        yield 'File' => [new vs\File(), __FILE__];
        yield 'Finite' => [new vs\Finite(), 1.23];
        yield 'FloatType' => [new vs\FloatType(), 1.23];
        yield 'FloatVal' => [new vs\FloatVal(), 1.23];
        yield 'Graph' => [new vs\Graph(), 'abc123!@#'];
        yield 'GreaterThan' => [new vs\GreaterThan(0), 1];
        yield 'GreaterThanOrEqual' => [new vs\GreaterThanOrEqual(1), 1];
        yield 'Hetu' => [new vs\Hetu(), '010106A9012'];
        yield 'HexRgbColor' => [new vs\HexRgbColor(), '#FFAABB'];
        yield 'Iban' => [new vs\Iban(), 'SE35 5000 0000 0549 1000 0003'];
        yield 'Identical' => [new vs\Identical(123), 123];
        yield 'Image' => [new vs\Image(), 'tests/fixtures/valid-image.png'];
        yield 'Imei' => [new vs\Imei(), '490154203237518'];
        yield 'In' => [new vs\In(['a', 'b']), 'a'];
        yield 'Infinite' => [new vs\Infinite(), INF];
        yield 'Instance' => [new vs\Instance(stdClass::class), new stdClass()];
        yield 'IntType' => [new vs\IntType(), 123];
        yield 'IntVal' => [new vs\IntVal(), 123];
        yield 'Ip' => [new vs\Ip(), '127.0.0.1'];
        yield 'Isbn' => [new vs\Isbn(), '9783161484100'];
        yield 'IterableType' => [new vs\IterableType(), []];
        yield 'IterableVal' => [new vs\IterableVal(), []];
        yield 'Json' => [new vs\Json(), '{"key":"value"}'];
        yield 'Key' => [new vs\Key('name', new vs\StringType()), ['name' => 'value']];
        yield 'KeyExists' => [new vs\KeyExists('name'), ['name' => 'value']];
        yield 'KeyOptional' => [new vs\KeyOptional('missing', new vs\StringType()), ['name' => 'value']];
        yield 'KeySet' => [new vs\KeySet(new vs\Key('name', new vs\StringType())), ['name' => 'value']];
        yield 'LanguageCode' => [new vs\LanguageCode(), 'en'];
        yield 'Dynamic' => [new vs\Dynamic([static::class, 'callableDynamic']), 123];
        yield 'LeapDate' => [new vs\LeapDate('Y-m-d'), '2020-02-29'];
        yield 'LeapYear' => [new vs\LeapYear(), 2020];
        yield 'Length' => [new vs\Length(new vs\Equals(4)), 'abcd'];
        yield 'LessThan' => [new vs\LessThan(10), 5];
        yield 'LessThanOrEqual' => [new vs\LessThanOrEqual(10), 10];
        yield 'Lowercase' => [new vs\Lowercase(), 'abc'];
        yield 'Luhn' => [new vs\Luhn(), '2222400041240011'];
        yield 'MacAddress' => [new vs\MacAddress(), '00:11:22:33:44:55'];
        yield 'Masked' => [new vs\Masked('1-', new vs\IntVal()), 123];
        yield 'Max' => [new vs\Max(new vs\Equals(30)), [10, 20, 30]];
        yield 'Min' => [new vs\Min(new vs\Equals(10)), [10, 20, 30]];
        yield 'Mimetype' => [new vs\Mimetype('image/png'), 'tests/fixtures/valid-image.png'];
        yield 'Multiple' => [new vs\Multiple(3), 9];
        yield 'Named' => [new vs\Named('MyValidator', new vs\IntVal()), 123];
        yield 'Negative' => [new vs\Negative(), -1];
        yield 'NfeAccessKey' => [new vs\NfeAccessKey(), '52060433009911002506550120000007800267301615'];
        yield 'Nif' => [new vs\Nif(), '12345678Z'];
        yield 'Nip' => [new vs\Nip(), '1645865777'];
        yield 'NoneOf' => [new vs\NoneOf(new vs\IntVal(), new vs\FloatVal()), 'foo'];
        yield 'Not' => [new vs\Not(new vs\TrueVal()), false];
        yield 'NullOr' => [new vs\NullOr(new vs\IntVal()), null];
        yield 'Number' => [new vs\Number(), '123'];
        yield 'NullType' => [new vs\NullType(), null];
        yield 'NumericVal' => [new vs\NumericVal(), '123'];
        yield 'ObjectType' => [new vs\ObjectType(), new stdClass()];
        yield 'Odd' => [new vs\Odd(), 3];
        yield 'OneOf' => [new vs\OneOf(new vs\Digit(), new vs\Alpha()), 'AB'];
        yield 'Pesel' => [new vs\Pesel(), '21120209256'];
        yield 'Phone' => [new vs\Phone(), '+1 650 253 00 00'];
        yield 'Pis' => [new vs\Pis(), '120.0340.678-8'];
        yield 'PolishIdCard' => [new vs\PolishIdCard(), 'AYW036733'];
        yield 'PortugueseNif' => [new vs\PortugueseNif(), '123456789'];
        yield 'Positive' => [new vs\Positive(), 1];
        yield 'PostalCode' => [new vs\PostalCode('US'), '12345'];
        yield 'Printable' => [new vs\Printable(), 'abc123!@#'];
        yield 'Property' => [new vs\Property('age', new vs\IntVal()), (object) ['age' => 18]];
        yield 'PropertyExists' => [new vs\PropertyExists('age'), (object) ['age' => 18]];
        yield 'PropertyOptional' => [new vs\PropertyOptional('missing', new vs\Email()), (object) []];
        yield 'PublicDomainSuffix' => [new vs\PublicDomainSuffix(), 'co.uk'];
        yield 'Punct' => [new vs\Punct(), '!@#'];
        yield 'Readable' => [new vs\Readable(), 'tests/fixtures/valid-image.png'];
        yield 'Regex' => [new vs\Regex('/^[a-z]+$/'), 'abc'];
        yield 'ResourceType' => [new vs\ResourceType(), fopen('php://temp', 'r')];
        yield 'Roman' => [new vs\Roman(), 'XIV'];
        yield 'ScalarVal' => [new vs\ScalarVal(), 'example'];
        yield 'Size' => [new vs\Size('KB', new vs\Between(1, 1000)), 'tests/fixtures/valid-image.png'];
        yield 'Slug' => [new vs\Slug(), 'a-valid-slug'];
        yield 'Sorted' => [new vs\Sorted('ASC'), [1, 2, 3]];
        yield 'Space' => [new vs\Space(), " \t\n"];
        yield 'Spaced' => [new vs\Spaced(), 'a b c'];
        yield 'StartsWith' => [new vs\StartsWith('ex'), 'example'];
        yield 'StringType' => [new vs\StringType(), 'example'];
        yield 'StringVal' => [new vs\StringVal(), 'example'];
        yield 'SubdivisionCode' => [new vs\SubdivisionCode('US'), 'CA'];
        yield 'Subset' => [new vs\Subset(['a', 'b', 'c']), ['a', 'b']];
        yield 'SymbolicLink' => [new vs\SymbolicLink(), 'tests/fixtures/symbolic-link'];
        yield 'Templated' => [new vs\Templated('Foo', new vs\StringVal()), 'foo'];
        yield 'Time' => [new vs\Time(), '12:34:56'];
        yield 'Tld' => [new vs\Tld(), 'com'];
        yield 'TrueVal' => [new vs\TrueVal(), true];
        yield 'Undef' => [new vs\Undef(), null];
        yield 'UndefOr' => [new vs\UndefOr(new vs\IntVal()), null];
        yield 'Unique' => [new vs\Unique(), [1, 2, 3]];
        yield 'Uppercase' => [new vs\Uppercase(), 'ABC'];
        yield 'Url' => [new vs\Url(), 'https://example.com'];
        yield 'Uuid' => [new vs\Uuid(), '123e4567-e89b-12d3-a456-426655440000'];
        yield 'Version' => [new vs\Version(), '1.2.3'];
        yield 'Vowel' => [new vs\Vowel(), 'aeiou'];
        yield 'When' => [new vs\When(new vs\IntVal(), new vs\AlwaysValid(), new vs\AlwaysInvalid()), 5];
        yield 'Writable' => [new vs\Writable(), 'tests/fixtures/valid-image.png'];
        yield 'Xdigit' => [new vs\Xdigit(), 'AF'];
    }

    public static function callableTarget(): true
    {
        return true;
    }

    public static function callableDynamic(): Validator
    {
        return new vs\IntVal();
    }
}
