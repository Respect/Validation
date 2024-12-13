<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::printable()->assert(''),
    '"" must contain only printable characters',
));

test('Scenario #2', expectMessage(
    fn() => v::not(v::printable())->assert('abc'),
    '"abc" must not contain printable characters',
));

test('Scenario #3', expectFullMessage(
    fn() => v::printable()->assert('foo' . chr(10) . 'bar'),
    '- "foo\\nbar" must contain only printable characters',
));

test('Scenario #4', expectFullMessage(
    fn() => v::not(v::printable())->assert('$%asd'),
    '- "$%asd" must not contain printable characters',
));
