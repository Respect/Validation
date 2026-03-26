<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 */

declare(strict_types=1);

namespace Respect\Validation\Test\Inference\Assertions;

use DateTimeInterface;
use Respect\Validation\ValidatorBuilder as v;

use function PHPStan\Testing\assertType;

// --- Type validators (assert) ---

function intTypeAssert(mixed $x): void
{
    v::intType()->assert($x);
    assertType('int', $x);
}

function stringTypeAssert(mixed $x): void
{
    v::stringType()->assert($x);
    assertType('string', $x);
}

function floatTypeAssert(mixed $x): void
{
    v::floatType()->assert($x);
    assertType('float', $x);
}

function boolTypeAssert(mixed $x): void
{
    v::boolType()->assert($x);
    assertType('bool', $x);
}

function nullTypeAssert(mixed $x): void
{
    v::nullType()->assert($x);
    assertType('null', $x);
}

function arrayTypeAssert(mixed $x): void
{
    v::arrayType()->assert($x);
    assertType('array', $x);
}

function objectTypeAssert(mixed $x): void
{
    v::objectType()->assert($x);
    assertType('object', $x);
}

// --- Instance (dynamic) ---

function instanceAssert(mixed $x): void
{
    v::instance(DateTimeInterface::class)->assert($x);
    assertType('DateTimeInterface', $x);
}

// --- Val validators ---

function intValAssert(mixed $x): void
{
    v::intVal()->assert($x);
    assertType('int|numeric-string', $x);
}

function numericValAssert(mixed $x): void
{
    v::numericVal()->assert($x);
    assertType('float|int|numeric-string', $x);
}

function scalarValAssert(mixed $x): void
{
    v::scalarVal()->assert($x);
    assertType('bool|float|int|string', $x);
}

// --- Composable prefixes ---

function nullOrIntTypeAssert(mixed $x): void
{
    v::nullOrIntType()->assert($x);
    assertType('int|null', $x);
}

function notIntTypeAssert(int|string $x): void
{
    v::notIntType()->assert($x);
    assertType('string', $x);
}

// --- Chain intersection ---

function chainIntersection(mixed $x): void
{
    v::intType()->positive()->assert($x);
    assertType('int', $x);
}

// --- check() works too ---

function checkNarrowing(mixed $x): void
{
    v::stringType()->check($x);
    assertType('string', $x);
}

// --- isValid() type guard ---

function isValidGuard(mixed $x): void
{
    if (!v::intType()->isValid($x)) {
        return;
    }

    assertType('int', $x);
}

function isValidFalsey(int|string $x): void
{
    if (v::intType()->isValid($x)) {
        return;
    }

    assertType('string', $x);
}

// --- P0: String format validators ---

function emailAssert(mixed $x): void
{
    v::email()->assert($x);
    assertType('string', $x);
}

function uuidAssert(mixed $x): void
{
    v::uuid()->assert($x);
    assertType('string', $x);
}

function urlAssert(mixed $x): void
{
    v::url()->assert($x);
    assertType('string', $x);
}

function jsonAssert(mixed $x): void
{
    v::json()->assert($x);
    assertType('string', $x);
}

function alphaAssert(mixed $x): void
{
    v::alpha()->assert($x);
    assertType('string', $x);
}

function digitAssert(mixed $x): void
{
    v::digit()->assert($x);
    assertType('string', $x);
}

// --- P0: Filesystem validators ---

function fileAssert(mixed $x): void
{
    v::file()->assert($x);
    assertType('SplFileInfo|string', $x);
}

function directoryAssert(mixed $x): void
{
    v::directory()->assert($x);
    assertType('SplFileInfo|string', $x);
}

// --- P0: Array validators ---

function sortedAssert(mixed $x): void
{
    v::sorted('ASC')->assert($x);
    assertType('array|string', $x);
}

function uniqueAssert(mixed $x): void
{
    v::unique()->assert($x);
    assertType('array', $x);
}

// --- P0: Numeric validators ---

function multipleAssert(mixed $x): void
{
    v::multiple(3)->assert($x);
    assertType('int', $x);
}

// --- P0: DateTime ---

function dateTimeAssert(mixed $x): void
{
    v::dateTime()->assert($x);
    assertType('DateTimeInterface|string', $x);
}

// --- P0: Composable prefix + new narrowing ---

function nullOrEmailAssert(mixed $x): void
{
    v::nullOrEmail()->assert($x);
    assertType('string|null', $x);
}

// --- P0: Chain with string format ---

function stringTypeEmailChain(mixed $x): void
{
    v::stringType()->email()->assert($x);
    assertType('string', $x);
}

// --- Identical (value mode) ---

function identicalIntAssert(mixed $x): void
{
    v::identical(42)->assert($x);
    assertType('42', $x);
}

function identicalStringAssert(mixed $x): void
{
    v::identical('foo')->assert($x);
    assertType("'foo'", $x);
}

// --- In (member mode) ---

function inArrayAssert(mixed $x): void
{
    v::in(['active', 'inactive', 'pending'])->assert($x);
    assertType("'active'|'inactive'|'pending'", $x);
}

function inIntArrayAssert(mixed $x): void
{
    v::in([1, 2, 3])->assert($x);
    assertType('1|2|3', $x);
}

// --- AnyOf (children union) ---

function anyOfAssert(mixed $x): void
{
    v::anyOf(v::intType(), v::stringType())->assert($x);
    assertType('int|string', $x);
}

// --- AllOf (children intersect) ---

function allOfAssert(mixed $x): void
{
    v::allOf(v::intType(), v::positive())->assert($x);
    assertType('int', $x);
}

// --- Each (elements) ---

function eachAssert(mixed $x): void
{
    v::each(v::intType())->assert($x);
    assertType('array<int>', $x);
}

function eachStringAssert(mixed $x): void
{
    v::each(v::email())->assert($x);
    assertType('array<string>', $x);
}

// --- When (childrenRange) ---

function whenAssert(mixed $x): void
{
    v::when(v::intType(), v::intType(), v::stringType())->assert($x);
    assertType('int|string', $x);
}

// --- NoneOf (children union + remove) ---

function noneOfAssert(int|string|float $x): void
{
    v::noneOf(v::intType(), v::stringType())->assert($x);
    assertType('float', $x);
}

// --- Additional type validators ---

function callableTypeAssert(mixed $x): void
{
    v::callableType()->assert($x);
    assertType('callable(): mixed', $x);
}

function resourceTypeAssert(mixed $x): void
{
    v::resourceType()->assert($x);
    assertType('resource', $x);
}

function iterableTypeAssert(mixed $x): void
{
    v::iterableType()->assert($x);
    assertType('iterable', $x);
}

// --- Bool variants ---

function trueValAssert(mixed $x): void
{
    v::trueVal()->assert($x);
    assertType('true', $x);
}

function falseValAssert(mixed $x): void
{
    v::falseVal()->assert($x);
    assertType('false', $x);
}

function boolValAssert(mixed $x): void
{
    v::boolVal()->assert($x);
    assertType('bool', $x);
}

// --- Val variants ---

function floatValAssert(mixed $x): void
{
    v::floatVal()->assert($x);
    assertType('float|int|numeric-string', $x);
}

function stringValAssert(mixed $x): void
{
    v::stringVal()->assert($x);
    assertType('bool|float|int|string|Stringable', $x);
}

function arrayValAssert(mixed $x): void
{
    v::arrayVal()->assert($x);
    assertType('array|ArrayAccess', $x);
}

function iterableValAssert(mixed $x): void
{
    v::iterableVal()->assert($x);
    assertType('array|stdClass|Traversable', $x);
}

// --- Collection ---

function countableAssert(mixed $x): void
{
    v::countable()->assert($x);
    assertType('array|Countable', $x);
}

// --- Numeric ---

function positiveAssert(mixed $x): void
{
    v::positive()->assert($x);
    assertType('float|int|numeric-string', $x);
}

function negativeAssert(mixed $x): void
{
    v::negative()->assert($x);
    assertType('float|int|numeric-string', $x);
}

function evenAssert(mixed $x): void
{
    v::even()->assert($x);
    assertType('int', $x);
}

function oddAssert(mixed $x): void
{
    v::odd()->assert($x);
    assertType('int', $x);
}

function factorAssert(mixed $x): void
{
    v::factor(10)->assert($x);
    assertType('int', $x);
}

function finiteAssert(mixed $x): void
{
    v::finite()->assert($x);
    assertType('float|int|numeric-string', $x);
}

function infiniteAssert(mixed $x): void
{
    v::infinite()->assert($x);
    assertType('float|int|numeric-string', $x);
}

function numberAssert(mixed $x): void
{
    v::number()->assert($x);
    assertType('float|int|numeric-string', $x);
}

// --- Date/Time ---

function dateAssert(mixed $x): void
{
    v::date()->assert($x);
    assertType('string', $x);
}

function timeAssert(mixed $x): void
{
    v::time()->assert($x);
    assertType('string', $x);
}

function leapYearAssert(mixed $x): void
{
    v::leapYear()->assert($x);
    assertType('int|string', $x);
}

// --- Composites ---

function oneOfAssert(mixed $x): void
{
    v::oneOf(v::intType(), v::stringType())->assert($x);
    assertType('int|string', $x);
}

function allAssert(mixed $x): void
{
    v::all(v::intType())->assert($x);
    assertType('array<int>', $x);
}

// --- Modifier: undefOr ---

function undefOrIntTypeAssert(mixed $x): void
{
    v::undefOrIntType()->assert($x);
    assertType('int|null', $x);
}
