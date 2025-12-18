<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

$input = ['email' => 'not an email'];

test('Scenario #1', catchMessage(
    fn() => v::key('email', v::email()->setName('Email'))->setName('Foo')->assert($input),
    fn(string $message) => expect($message)->toBe('Email must be a valid email address')
));

test('Scenario #2', catchMessage(
    fn() => v::key('email', v::email())->setName('Email')->assert($input),
    fn(string $message) => expect($message)->toBe('Email must be a valid email address')
));

test('Scenario #3', catchMessage(
    fn() => v::key('email', v::email())->assert($input),
    fn(string $message) => expect($message)->toBe('`.email` must be a valid email address')
));
