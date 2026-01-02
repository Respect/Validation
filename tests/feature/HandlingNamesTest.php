<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

$input = ['email' => 'not an email'];

test('Results with a defined will display the name', catchMessage(
    fn() => v::named('Number', v::intType())->assert($input),
    fn(string $message) => expect($message)->toBe('Number must be an integer'),
));

test('Results with adjacent results defined will display the name', catchMessage(
    fn() => v::named('Numbers', v::length(v::greaterThan(2)))->assert($input),
    fn(string $message) => expect($message)->toBe('The length of Numbers must be greater than 2'),
));

test('Results with adjacent children results defined will display the name from its children', catchMessage(
    fn() => v::named('Numbers', v::positive()->intType()->greaterThan(5))->assert($input),
    fn(string $message) => expect($message)->toBe('Numbers must be a positive number'),
));

test('Results with a defined name cannot be overwritten by another name', catchMessage(
    fn() => v::named('Foo', v::key('email', v::named('Email', v::email())))->assert($input),
    fn(string $message) => expect($message)->toBe('Email must be a valid email address'),
));

test('Defining a name to a result with a path will add the path to the name', catchMessage(
    fn() => v::named('Email', v::key('email', v::email()))->assert($input),
    fn(string $message) => expect($message)->toBe('`.email` (<- Email) must be a valid email address'),
));

test('Results with a defined name will not be affected by a path', catchMessage(
    fn() => v::key('email', v::named('Email', v::email()))->assert($input),
    fn(string $message) => expect($message)->toBe('Email must be a valid email address'),
));

test('Not defining a name to a result with a path will display the path', catchMessage(
    fn() => v::key('email', v::email())->assert($input),
    fn(string $message) => expect($message)->toBe('`.email` must be a valid email address'),
));
