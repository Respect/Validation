<?php

declare(strict_types=1);

namespace Respect\Validation\Benchmarks;

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

use Generator;
use PhpBench\Attributes as Bench;
use Respect\Validation\Validator;
use Respect\Validation\ValidatorBuilder as v;

class ValidatorBench
{
    /** @param array<Validator, mixed> $params */    #[Bench\Iterations(10)]
    #[Bench\RetryThreshold(10)]
    #[Bench\Revs(5)]
    #[Bench\ParamProviders(['provideValidatorInput'])]
    public function benchValidate(array $params): void
    {
        [$v, $input] = $params;
        $v->validate($input);
    }

    public function provideValidatorInput(): Generator
    {
        yield 'AllOf' => [v::allOf(v::intVal(), v::greaterThan(0)), 5];
        yield 'Alnum' => [v::alnum(), 'abc123'];
        yield 'Alpha' => [v::alpha(), 'abc'];
        yield 'AnyOf' => [v::anyOf(v::intVal(), v::stringVal()), 5];
        yield 'ArrayType' => [v::arrayType(), []];
        yield 'ArrayVal' => [v::arrayVal(), []];
        yield 'Between' => [v::between(1, 10), 5];
        yield 'BetweenExclusive' => [v::betweenExclusive(1, 10), 5];
        yield 'BoolType' => [v::boolType(), true];
        yield 'BoolVal' => [v::boolVal(), true];
        yield 'Bsn' => [v::bsn(), '612890053'];
        yield 'Call' => [v::call('array_keys', v::each(v::stringType())), ['a' => 'b']];
        yield 'Charset' => [v::charset('UTF-8'), 'example'];
        yield 'Circuit' => [v::circuit(v::intVal(), v::trueVal()), 123];
        yield 'Cnpj' => [v::cnpj(), '11444777000161'];
        yield 'Consonant' => [v::consonant(), 'bcdf'];
        yield 'Contains' => [v::contains('needle'), 'haystack needle'];
        yield 'ContainsAny' => [v::containsAny(['a', 'b']), 'abc'];
        yield 'ContainsCount' => [v::containsCount('a', 3), 'banana'];
        yield 'Control' => [v::control(), "\n\r"];
        yield 'Countable' => [v::countable(), []];
        yield 'CountryCode' => [v::countryCode(), 'US'];
        yield 'Cpf' => [v::cpf(), '11598647644'];
        yield 'CurrencyCode' => [v::currencyCode(), 'USD'];
        yield 'Date' => [v::date(), '2020-01-01'];
        yield 'DateTime' => [v::dateTime(), '2020-01-01 12:00:00'];
        yield 'Decimal' => [v::decimal(2), '1.23'];
        yield 'Digit' => [v::digit(), '7'];
        yield 'Domain' => [v::domain(), 'example.com'];
        yield 'Each' => [v::each(v::stringType()), ['a', 'b']];
        yield 'Email' => [v::email(), 'bob@example.com'];
        yield 'EndsWith' => [v::endsWith('.com'), 'example.com'];
        yield 'Equals' => [v::equals('x'), 'x'];
        yield 'Even' => [v::even(), 2];
        yield 'Executable' => [v::executable(), 'tests/fixtures/executable'];
        yield 'Exists' => [v::exists(), 'tests/fixtures/valid-image.png'];
        yield 'FalseVal' => [v::falseVal(), false];
        yield 'Fibonacci' => [v::fibonacci(), 13];
        yield 'File' => [v::file(), __FILE__];
        yield 'FloatType' => [v::floatType(), 1.23];
        yield 'FloatVal' => [v::floatVal(), 1.23];
        yield 'GreaterThan' => [v::greaterThan(0), 1];
        yield 'GreaterThanOrEqual' => [v::greaterThanOrEqual(1), 1];
        yield 'Hetu' => [v::hetu(), '010106A9012'];
        yield 'Iban' => [v::iban(), 'SE35 5000 0000 0549 1000 0003'];
        yield 'Identical' => [v::identical(123), 123];
        yield 'In' => [v::in(['a', 'b']), 'a'];
        yield 'IntType' => [v::intType(), 123];
        yield 'IntVal' => [v::intVal(), 123];
        yield 'Ip' => [v::ip(), '127.0.0.1'];
        yield 'IterableVal' => [v::iterableVal(), []];
        yield 'LanguageCode' => [v::languageCode(), 'en'];
        yield 'LessThan' => [v::lessThan(10), 5];
        yield 'LessThanOrEqual' => [v::lessThanOrEqual(10), 10];
        yield 'Lowercase' => [v::lowercase(), 'abc'];
        yield 'Luhn' => [v::luhn(), '2222400041240011'];
        yield 'MacAddress' => [v::macAddress(), '00:11:22:33:44:55'];
        yield 'Negative' => [v::negative(), -1];
        yield 'Nip' => [v::nip(), '1645865777'];
        yield 'Not' => [v::not(v::trueVal()), false];
        yield 'NullType' => [v::nullType(), null];
        yield 'NumericVal' => [v::numericVal(), '123'];
        yield 'Odd' => [v::odd(), 3];
        yield 'PerfectSquare' => [v::perfectSquare(), 16];
        yield 'Pesel' => [v::pesel(), '21120209256'];
        yield 'Property' => [v::property('email', v::endsWith('@example.com')), (object) ['email' => 'a@example.com']];
        yield 'PropertyExists' => [v::propertyExists('email'), (object) ['email' => 'a@example.com']];
        yield 'PropertyOptional' => [v::propertyOptional('missing', v::email()), (object) ['email' => 'a@example.com']];
        yield 'Readable' => [v::readable(), 'tests/fixtures/valid-image.png'];
        yield 'ScalarVal' => [v::scalarVal(), 'example'];
        yield 'Slug' => [v::slug(), 'a-valid-slug'];
        yield 'StartsWith' => [v::startsWith('ex'), 'example'];
        yield 'StringType' => [v::stringType(), 'example'];
        yield 'StringVal' => [v::stringVal(), 'example'];
        yield 'SymbolicLink' => [v::symbolicLink(), 'tests/fixtures/symbolic-link'];
        yield 'Time' => [v::time(), '12:34:56'];
        yield 'TrueVal' => [v::trueVal(), true];
        yield 'Unique' => [v::unique(), [1, 2, 3]];
        yield 'Uppercase' => [v::uppercase(), 'ABC'];
        yield 'Uuid' => [v::uuid(), '123e4567-e89b-12d3-a456-426655440000'];
        yield 'When' => [v::when(v::trueVal(), v::intVal()), 123];
        yield 'Writable' => [v::writable(), 'tests/fixtures/valid-image.png'];
        yield 'Xdigit' => [v::xdigit(), 'AF'];
    }
}
