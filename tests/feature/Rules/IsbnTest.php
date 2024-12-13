<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', expectMessage(
    fn() => v::isbn()->assert('ISBN-12: 978-0-596-52068-7'),
    '"ISBN-12: 978-0-596-52068-7" must be a valid ISBN',
));

test('Scenario #2', expectMessage(
    fn() => v::not(v::isbn())->assert('ISBN-13: 978-0-596-52068-7'),
    '"ISBN-13: 978-0-596-52068-7" must not be a valid ISBN',
));

test('Scenario #3', expectFullMessage(
    fn() => v::isbn()->assert('978 10 596 52068 7'),
    '- "978 10 596 52068 7" must be a valid ISBN',
));

test('Scenario #4', expectFullMessage(
    fn() => v::not(v::isbn())->assert('978 0 596 52068 7'),
    '- "978 0 596 52068 7" must not be a valid ISBN',
));
