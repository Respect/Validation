<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::cpf()->assert('this thing'),
    '"this thing" must be a valid CPF number',
));

test('Scenario #2', expectMessage(
    fn() => v::not(v::cpf())->assert('276.865.775-11'),
    '"276.865.775-11" must not be a valid CPF number',
));

test('Scenario #3', expectFullMessage(
    fn() => v::cpf()->assert('your mother'),
    '- "your mother" must be a valid CPF number',
));

test('Scenario #4', expectFullMessage(
    fn() => v::not(v::cpf())->assert('61836182848'),
    '- "61836182848" must not be a valid CPF number',
));
