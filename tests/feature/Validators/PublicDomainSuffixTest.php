<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 */

declare(strict_types=1);

test('rejects non-public suffix values', catchMessage(
    fn() => v::publicDomainSuffix()->assert('invalid.com'),
    fn(string $message) => expect($message)->toBe('"invalid.com" must be a public domain suffix'),
));

test('accepts exact PSL rules', catchMessage(
    fn() => v::not(v::publicDomainSuffix())->assert('co.uk'),
    fn(string $message) => expect($message)->toBe('"co.uk" must not be a public domain suffix'),
));

test('accepts PSL rules case-insensitively', catchMessage(
    fn() => v::not(v::publicDomainSuffix())->assert('CO.UK'),
    fn(string $message) => expect($message)->toBe('"CO.UK" must not be a public domain suffix'),
));

test('accepts wildcard matches with one additional label', catchFullMessage(
    fn() => v::not(v::publicDomainSuffix())->assert('co.ck'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "co.ck" must not be a public domain suffix'),
));

test('rejects wildcard exceptions from the list', catchFullMessage(
    fn() => v::publicDomainSuffix()->assert('www.ck'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "www.ck" must be a public domain suffix'),
));

test('accepts private suffix entries from the PSL', catchMessage(
    fn() => v::not(v::publicDomainSuffix())->assert('blogspot.com'),
    fn(string $message) => expect($message)->toBe('"blogspot.com" must not be a public domain suffix'),
));

test('does not treat TLD-only values as public suffixes', catchMessage(
    fn() => v::publicDomainSuffix()->assert('tk'),
    fn(string $message) => expect($message)->toBe('"tk" must be a public domain suffix'),
));

test('accepts IDN PSL rules', catchMessage(
    fn() => v::not(v::publicDomainSuffix())->assert('個人.香港'),
    fn(string $message) => expect($message)->toBe('"個人.香港" must not be a public domain suffix'),
));
