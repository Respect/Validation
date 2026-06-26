<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 */

declare(strict_types=1);

namespace Respect\Validation\Test\Inference\StaticAssertions;

use DateTimeInterface;
use Respect\Validation\ValidatorBuilder as v;

use function PHPStan\Testing\assertType;

// Proves the generated src/Mixins
//
// PHPDoc narrows on its own (what IDEs such as DevSense read). One static-entry assertion
// per assured validator that narrows, followed by combinations and boundary cases.
//
// Not covered here: format(), formatted() (take a Formatter object).

// ============================================================================
// Per-validator: static entry narrowing
// ============================================================================

function allAssert(mixed $x): void
{
    v::all(v::intType())->assert($x);
    assertType('iterable<int>', $x);
}

function alnumAssert(mixed $x): void
{
    v::alnum()->assert($x);
    assertType('bool|float|int|string', $x);
}

function alphaAssert(mixed $x): void
{
    v::alpha()->assert($x);
    assertType('bool|float|int|string', $x);
}

function arrayTypeAssert(mixed $x): void
{
    v::arrayType()->assert($x);
    assertType('array', $x);
}

function arrayValAssert(mixed $x): void
{
    v::arrayVal()->assert($x);
    assertType('array|ArrayAccess', $x);
}

function attributesAssert(mixed $x): void
{
    v::attributes()->assert($x);
    assertType('object', $x);
}

function base64Assert(mixed $x): void
{
    v::base64()->assert($x);
    assertType('string', $x);
}

function boolTypeAssert(mixed $x): void
{
    v::boolType()->assert($x);
    assertType('bool', $x);
}

function boolValAssert(mixed $x): void
{
    v::boolVal()->assert($x);
    assertType('bool|float|int|string|null', $x);
}

function bsnAssert(mixed $x): void
{
    v::bsn()->assert($x);
    assertType('bool|float|int|string', $x);
}

function callableTypeAssert(mixed $x): void
{
    v::callableType()->assert($x);
    assertType('callable(): mixed', $x);
}

function charsetAssert(mixed $x): void
{
    v::charset('x')->assert($x);
    assertType('string', $x);
}

function cnhAssert(mixed $x): void
{
    v::cnh()->assert($x);
    assertType('bool|float|int|string', $x);
}

function cnpjAssert(mixed $x): void
{
    v::cnpj()->assert($x);
    assertType('bool|float|int|string', $x);
}

function consonantAssert(mixed $x): void
{
    v::consonant()->assert($x);
    assertType('bool|float|int|string', $x);
}

function containsAssert(mixed $x): void
{
    v::contains(1)->assert($x);
    assertType('array|bool|float|int|string', $x);
}

function containsAnyAssert(mixed $x): void
{
    v::containsAny([1, 2, 3])->assert($x);
    assertType('array|bool|float|int|string', $x);
}

function containsCountAssert(mixed $x): void
{
    v::containsCount(1, 1)->assert($x);
    assertType('array|bool|float|int|string', $x);
}

function controlAssert(mixed $x): void
{
    v::control()->assert($x);
    assertType('bool|float|int|string', $x);
}

function countableAssert(mixed $x): void
{
    v::countable()->assert($x);
    assertType('array|Countable', $x);
}

function countryCodeAssert(mixed $x): void
{
    v::countryCode()->assert($x);
    assertType('string', $x);
}

function cpfAssert(mixed $x): void
{
    v::cpf()->assert($x);
    assertType('string', $x);
}

function creditCardAssert(mixed $x): void
{
    v::creditCard()->assert($x);
    assertType('bool|float|int|string', $x);
}

function currencyCodeAssert(mixed $x): void
{
    v::currencyCode()->assert($x);
    assertType('string', $x);
}

function dateAssert(mixed $x): void
{
    v::date()->assert($x);
    assertType('bool|float|int|string', $x);
}

function dateTimeAssert(mixed $x): void
{
    v::dateTime()->assert($x);
    assertType('bool|DateTimeInterface|float|int|string', $x);
}

function dateTimeDiffAssert(mixed $x): void
{
    v::dateTimeDiff('years', v::intType())->assert($x);
    assertType('DateTimeInterface|string', $x);
}

function decimalAssert(mixed $x): void
{
    v::decimal(1)->assert($x);
    assertType('float|int|numeric-string', $x);
}

function digitAssert(mixed $x): void
{
    v::digit()->assert($x);
    assertType('bool|float|int|string', $x);
}

function directoryAssert(mixed $x): void
{
    v::directory()->assert($x);
    assertType('SplFileInfo|string', $x);
}

function domainAssert(mixed $x): void
{
    v::domain()->assert($x);
    assertType('string', $x);
}

function eachAssert(mixed $x): void
{
    v::each(v::intType())->assert($x);
    assertType('iterable<int>', $x);
}

function emailAssert(mixed $x): void
{
    v::email()->assert($x);
    assertType('string', $x);
}

function emojiAssert(mixed $x): void
{
    v::emoji()->assert($x);
    assertType('string', $x);
}

function endsWithAssert(mixed $x): void
{
    v::endsWith(1)->assert($x);
    assertType('array|string', $x);
}

function evenAssert(mixed $x): void
{
    v::even()->assert($x);
    assertType('float|int|numeric-string', $x);
}

function executableAssert(mixed $x): void
{
    v::executable()->assert($x);
    assertType('SplFileInfo|string', $x);
}

function existsAssert(mixed $x): void
{
    v::exists()->assert($x);
    assertType('SplFileInfo|string', $x);
}

function extensionAssert(mixed $x): void
{
    v::extension('x')->assert($x);
    assertType('SplFileInfo|string', $x);
}

function falseValAssert(mixed $x): void
{
    v::falseVal()->assert($x);
    assertType('bool|float|int|string|null', $x);
}

function fileAssert(mixed $x): void
{
    v::file()->assert($x);
    assertType('SplFileInfo|string', $x);
}

function finiteAssert(mixed $x): void
{
    v::finite()->assert($x);
    assertType('float|int|numeric-string', $x);
}

function floatTypeAssert(mixed $x): void
{
    v::floatType()->assert($x);
    assertType('float', $x);
}

function floatValAssert(mixed $x): void
{
    v::floatVal()->assert($x);
    assertType('float|int|numeric-string|true', $x);
}

function graphAssert(mixed $x): void
{
    v::graph()->assert($x);
    assertType('bool|float|int|string', $x);
}

function hetuAssert(mixed $x): void
{
    v::hetu()->assert($x);
    assertType('string', $x);
}

function hexRgbColorAssert(mixed $x): void
{
    v::hexRgbColor()->assert($x);
    assertType('bool|float|int|string', $x);
}

function ibanAssert(mixed $x): void
{
    v::iban()->assert($x);
    assertType('string', $x);
}

function identicalAssert(mixed $x): void
{
    v::identical(42)->assert($x);
    assertType('int', $x);
}

function imageAssert(mixed $x): void
{
    v::image()->assert($x);
    assertType('SplFileInfo|string', $x);
}

function imeiAssert(mixed $x): void
{
    v::imei()->assert($x);
    assertType('bool|float|int|string', $x);
}

function infiniteAssert(mixed $x): void
{
    v::infinite()->assert($x);
    assertType('float|int|numeric-string', $x);
}

function instanceAssert(mixed $x): void
{
    v::instance(\DateTimeInterface::class)->assert($x);
    assertType('DateTimeInterface', $x);
}

function intTypeAssert(mixed $x): void
{
    v::intType()->assert($x);
    assertType('int', $x);
}

function intValAssert(mixed $x): void
{
    v::intVal()->assert($x);
    assertType('int|numeric-string', $x);
}

function ipAssert(mixed $x): void
{
    v::ip()->assert($x);
    assertType('string', $x);
}

function isbnAssert(mixed $x): void
{
    v::isbn()->assert($x);
    assertType('bool|float|int|string', $x);
}

function iterableTypeAssert(mixed $x): void
{
    v::iterableType()->assert($x);
    assertType('iterable', $x);
}

function iterableValAssert(mixed $x): void
{
    v::iterableVal()->assert($x);
    assertType('array|stdClass|Traversable', $x);
}

function jsonAssert(mixed $x): void
{
    v::json()->assert($x);
    assertType('string', $x);
}

function keyExistsAssert(mixed $x): void
{
    v::keyExists(1)->assert($x);
    assertType('array|ArrayAccess', $x);
}

function keySetAssert(mixed $x): void
{
    v::keySet(v::intType())->assert($x);
    assertType('array', $x);
}

function languageCodeAssert(mixed $x): void
{
    v::languageCode()->assert($x);
    assertType('string', $x);
}

function leapDateAssert(mixed $x): void
{
    v::leapDate('x')->assert($x);
    assertType('bool|DateTimeInterface|float|int|string', $x);
}

function leapYearAssert(mixed $x): void
{
    v::leapYear()->assert($x);
    assertType('bool|DateTimeInterface|float|int|string', $x);
}

function lowercaseAssert(mixed $x): void
{
    v::lowercase()->assert($x);
    assertType('string', $x);
}

function luhnAssert(mixed $x): void
{
    v::luhn()->assert($x);
    assertType('bool|float|int|string', $x);
}

function macAddressAssert(mixed $x): void
{
    v::macAddress()->assert($x);
    assertType('string', $x);
}

function mimetypeAssert(mixed $x): void
{
    v::mimetype('x')->assert($x);
    assertType('SplFileInfo|string', $x);
}

function negativeAssert(mixed $x): void
{
    v::negative()->assert($x);
    assertType('float|int|numeric-string', $x);
}

function nfeAccessKeyAssert(mixed $x): void
{
    v::nfeAccessKey()->assert($x);
    assertType('string', $x);
}

function nifAssert(mixed $x): void
{
    v::nif()->assert($x);
    assertType('string', $x);
}

function nipAssert(mixed $x): void
{
    v::nip()->assert($x);
    assertType('bool|float|int|string', $x);
}

function nullTypeAssert(mixed $x): void
{
    v::nullType()->assert($x);
    assertType('null', $x);
}

function numberAssert(mixed $x): void
{
    v::number()->assert($x);
    assertType('float|int|numeric-string', $x);
}

function numericValAssert(mixed $x): void
{
    v::numericVal()->assert($x);
    assertType('float|int|numeric-string', $x);
}

function objectTypeAssert(mixed $x): void
{
    v::objectType()->assert($x);
    assertType('object', $x);
}

function oddAssert(mixed $x): void
{
    v::odd()->assert($x);
    assertType('float|int|numeric-string', $x);
}

function peselAssert(mixed $x): void
{
    v::pesel()->assert($x);
    assertType('bool|float|int|string', $x);
}

function phoneAssert(mixed $x): void
{
    v::phone()->assert($x);
    assertType('bool|float|int|string', $x);
}

function pisAssert(mixed $x): void
{
    v::pis()->assert($x);
    assertType('bool|float|int|string', $x);
}

function polishIdCardAssert(mixed $x): void
{
    v::polishIdCard()->assert($x);
    assertType('bool|float|int|string', $x);
}

function portugueseNifAssert(mixed $x): void
{
    v::portugueseNif()->assert($x);
    assertType('string', $x);
}

function positiveAssert(mixed $x): void
{
    v::positive()->assert($x);
    assertType('float|int|numeric-string', $x);
}

function postalCodeAssert(mixed $x): void
{
    v::postalCode('x')->assert($x);
    assertType('bool|float|int|string', $x);
}

function printableAssert(mixed $x): void
{
    v::printable()->assert($x);
    assertType('bool|float|int|string', $x);
}

function propertyExistsAssert(mixed $x): void
{
    v::propertyExists('x')->assert($x);
    assertType('object', $x);
}

function publicDomainSuffixAssert(mixed $x): void
{
    v::publicDomainSuffix()->assert($x);
    assertType('bool|float|int|string', $x);
}

function punctAssert(mixed $x): void
{
    v::punct()->assert($x);
    assertType('bool|float|int|string', $x);
}

function readableAssert(mixed $x): void
{
    v::readable()->assert($x);
    assertType('Psr\Http\Message\StreamInterface|SplFileInfo|string', $x);
}

function regexAssert(mixed $x): void
{
    v::regex('x')->assert($x);
    assertType('bool|float|int|string', $x);
}

function resourceTypeAssert(mixed $x): void
{
    v::resourceType()->assert($x);
    assertType('resource', $x);
}

function romanAssert(mixed $x): void
{
    v::roman()->assert($x);
    assertType('string', $x);
}

function scalarValAssert(mixed $x): void
{
    v::scalarVal()->assert($x);
    assertType('bool|float|int|string', $x);
}

function sizeAssert(mixed $x): void
{
    v::size('B', v::intType())->assert($x);
    assertType('Psr\Http\Message\StreamInterface|Psr\Http\Message\UploadedFileInterface|SplFileInfo|string', $x);
}

function slugAssert(mixed $x): void
{
    v::slug()->assert($x);
    assertType('string', $x);
}

function sortedAssert(mixed $x): void
{
    v::sorted('ASC')->assert($x);
    assertType('array|string', $x);
}

function spaceAssert(mixed $x): void
{
    v::space()->assert($x);
    assertType('bool|float|int|string', $x);
}

function spacedAssert(mixed $x): void
{
    v::spaced()->assert($x);
    assertType('string', $x);
}

function startsWithAssert(mixed $x): void
{
    v::startsWith(1)->assert($x);
    assertType('array|string', $x);
}

function stringTypeAssert(mixed $x): void
{
    v::stringType()->assert($x);
    assertType('string', $x);
}

function stringValAssert(mixed $x): void
{
    v::stringVal()->assert($x);
    assertType('bool|float|int|string|Stringable', $x);
}

function subdivisionCodeAssert(mixed $x): void
{
    v::subdivisionCode('US')->assert($x);
    assertType('bool|float|int|string|null', $x);
}

function subsetAssert(mixed $x): void
{
    v::subset([1, 2, 3])->assert($x);
    assertType('array', $x);
}

function symbolicLinkAssert(mixed $x): void
{
    v::symbolicLink()->assert($x);
    assertType('SplFileInfo|string', $x);
}

function timeAssert(mixed $x): void
{
    v::time()->assert($x);
    assertType('bool|float|int|string', $x);
}

function tldAssert(mixed $x): void
{
    v::tld()->assert($x);
    assertType('string', $x);
}

function trimmedAssert(mixed $x): void
{
    v::trimmed()->assert($x);
    assertType('string', $x);
}

function trueValAssert(mixed $x): void
{
    v::trueVal()->assert($x);
    assertType('bool|float|int|string', $x);
}

function undefAssert(mixed $x): void
{
    v::undef()->assert($x);
    assertType("''|null", $x);
}

function uniqueAssert(mixed $x): void
{
    v::unique()->assert($x);
    assertType('array', $x);
}

function uppercaseAssert(mixed $x): void
{
    v::uppercase()->assert($x);
    assertType('string', $x);
}

function urlAssert(mixed $x): void
{
    v::url()->assert($x);
    assertType('string', $x);
}

function uuidAssert(mixed $x): void
{
    v::uuid()->assert($x);
    assertType('Ramsey\Uuid\UuidInterface|string', $x);
}

function versionAssert(mixed $x): void
{
    v::version()->assert($x);
    assertType('string', $x);
}

function vowelAssert(mixed $x): void
{
    v::vowel()->assert($x);
    assertType('bool|float|int|string', $x);
}

function writableAssert(mixed $x): void
{
    v::writable()->assert($x);
    assertType('Psr\Http\Message\StreamInterface|SplFileInfo|string', $x);
}

function xdigitAssert(mixed $x): void
{
    v::xdigit()->assert($x);
    assertType('bool|float|int|string', $x);
}

// ============================================================================
// Combinations: the first rule (the type) wins; later rules only constrain it
// ============================================================================

function chainTypeThenConstraints(mixed $x): void
{
    v::intType()->positive()->between(1, 10)->assert($x);
    assertType('int', $x);
}

function chainTypeThenFormat(mixed $x): void
{
    v::stringType()->email()->assert($x);
    assertType('string', $x);
}

function chainResetRuleMidChain(mixed $x): void
{
    // a non-expressible rule (in()) mid-chain preserves the entry type, not mixed
    v::intType()->in([1, 2, 3])->assert($x);
    assertType('int', $x);
}

function chainElementOnType(mixed $x): void
{
    // each() refines the element type even after a container type rule
    v::arrayType()->each(v::intType())->assert($x);
    assertType('iterable<int>', $x);
}

// ============================================================================
// Container subject: the input is narrowed to the container type (key/property/
// length/max/min), and the prefixed form narrows identically.
// ============================================================================

function keyNarrowsToContainer(mixed $x): void
{
    v::key('a', v::intType())->assert($x);
    assertType('array|ArrayAccess', $x);
}

function propertyNarrowsToContainer(mixed $x): void
{
    v::property('id', v::intType())->assert($x);
    assertType('object', $x);
}

function lengthNarrowsToContainer(mixed $x): void
{
    v::length(v::between(1, 5))->assert($x);
    assertType('array|Countable|string', $x);
}

function maxNarrowsToIterable(mixed $x): void
{
    v::max(v::intType())->assert($x);
    assertType('iterable', $x);
}

function keyPrefixNarrowsToContainer(mixed $x): void
{
    v::keyIntType('a')->assert($x);
    assertType('array|ArrayAccess', $x);
}

// ============================================================================
// Wrap PREFIX composition: the concrete inner type unioned with the bypass set.
// (The nullOr()/undefOr() ARG-forms stay mixed -- see the boundary section.)
// ============================================================================

function nullOrPrefixNarrows(mixed $x): void
{
    v::nullOrIntType()->assert($x);
    assertType('int|null', $x);
}

function undefOrPrefixNarrows(mixed $x): void
{
    v::undefOrIntType()->assert($x);
    assertType("''|int|null", $x);
}

function nullOrPrefixDedupesBypass(mixed $x): void
{
    // nullOrNullType(): the inner type already admits null, so the union must not be null|null.
    v::nullOrNullType()->assert($x);
    assertType('null', $x);
}

function nullOrPrefixDedupesWithinUnion(mixed $x): void
{
    // nullOrBoolVal(): inner 'scalar|null' + 'null' bypass collapses to scalar|null.
    v::nullOrBoolVal()->assert($x);
    assertType('bool|float|int|string|null', $x);
}

function chainTypeThenNullOr(mixed $x): void
{
    // first-wins: a leading type rule survives a later nullOr() (instance preserves TSure,
    // and the instance method carries no Chain<T> parameter, so a raw validator is fine too).
    v::stringType()->nullOr(v::intType())->assert($x);
    assertType('string', $x);
}

// ============================================================================
// Boundary: rules whose assurance is not statically expressible stay mixed
// (extension-only); they must not narrow unsoundly. The argument-wrapping forms
// (nullOr/undefOr arg-form, anyOf/oneOf/allOf/named/templated) are here on purpose:
// narrowing them would retype their Validator parameter to Chain<T> and reject raw
// (non-fluent) Validator arguments.
// ============================================================================

function notDoesNotNarrow(mixed $x): void
{
    v::not(v::intType())->assert($x);
    assertType('mixed', $x);
}

function inDoesNotNarrow(mixed $x): void
{
    v::in([1, 2, 3])->assert($x);
    assertType('mixed', $x);
}

function whenDoesNotNarrow(mixed $x): void
{
    v::when(v::intType(), v::positive(), v::negative())->assert($x);
    assertType('mixed', $x);
}

function nullOrArgFormDoesNotNarrow(mixed $x): void
{
    v::nullOr(v::intType())->assert($x);
    assertType('mixed', $x);
}

function anyOfDoesNotNarrow(mixed $x): void
{
    v::anyOf(v::intType(), v::stringType())->assert($x);
    assertType('mixed', $x);
}

function allOfDoesNotNarrow(mixed $x): void
{
    v::allOf(v::intType(), v::positive())->assert($x);
    assertType('mixed', $x);
}

function namedDoesNotNarrow(mixed $x): void
{
    v::named('n', v::intType())->assert($x);
    assertType('mixed', $x);
}

// ============================================================================
// Soundness: isValid() must not narrow the false branch of an inexact rule;
// check() narrows like assert()
// ============================================================================

function isValidFalseBranchStaysSound(string $x): void
{
    if (v::email()->isValid($x)) {
        return;
    }

    assertType('string', $x);
}

function checkNarrowsLikeAssert(mixed $x): void
{
    v::stringType()->check($x);
    assertType('string', $x);
}
