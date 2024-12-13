<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

$input = ['email' => 'not an email'];

test('Scenario #1', expectMessage(
    fn() => v::key('email', v::email()->setName('Email'))->setName('Foo')->assert($input),
    'Email must be a valid email address',
));

test('Scenario #2', expectMessage(
    fn() => v::key('email', v::email())->setName('Email')->assert($input),
    'email must be a valid email address',
));

test('Scenario #3', expectMessage(
    fn() => v::key('email', v::email())->assert($input),
    'email must be a valid email address',
));
