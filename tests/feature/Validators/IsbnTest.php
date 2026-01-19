<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    fn() => v::isbn()->assert('ISBN-12: 978-0-596-52068-7'),
    fn(string $message) => expect($message)->toBe('"ISBN-12: 978-0-596-52068-7" must be a valid ISBN'),
));

test('Scenario #2', catchMessage(
    fn() => v::not(v::isbn())->assert('ISBN-13: 978-0-596-52068-7'),
    fn(string $message) => expect($message)->toBe('"ISBN-13: 978-0-596-52068-7" must not be a valid ISBN'),
));

test('Scenario #3', catchFullMessage(
    fn() => v::isbn()->assert('978 10 596 52068 7'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "978 10 596 52068 7" must be a valid ISBN'),
));

test('Scenario #4', catchFullMessage(
    fn() => v::not(v::isbn())->assert('978 0 596 52068 7'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "978 0 596 52068 7" must not be a valid ISBN'),
));
