<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::email()->assert('batman'),
    '"batman" must be a valid email address',
));

test('Scenario #2', expectMessage(
    fn() => v::not(v::email())->assert('bruce.wayne@gothancity.com'),
    '"bruce.wayne@gothancity.com" must not be an email address',
));

test('Scenario #3', expectFullMessage(
    fn() => v::email()->assert('bruce wayne'),
    '- "bruce wayne" must be a valid email address',
));

test('Scenario #4', expectFullMessage(
    fn() => v::not(v::email())->assert('iambatman@gothancity.com'),
    '- "iambatman@gothancity.com" must not be an email address',
));
