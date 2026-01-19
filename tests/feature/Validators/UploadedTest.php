<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(
    function (): void {
        set_mock_is_uploaded_file_return(false);
        v::uploaded()->assert('filename');
    },
    fn(string $message) => expect($message)->toBe('"filename" must be an uploaded file'),
));

test('Scenario #2', catchMessage(
    function (): void {
        set_mock_is_uploaded_file_return(true);
        v::not(v::uploaded())->assert('filename');
    },
    fn(string $message) => expect($message)->toBe('"filename" must not be an uploaded file'),
));

test('Scenario #3', catchFullMessage(
    function (): void {
        set_mock_is_uploaded_file_return(false);
        v::uploaded()->assert('filename');
    },
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "filename" must be an uploaded file'),
));

test('Scenario #4', catchFullMessage(
    function (): void {
        set_mock_is_uploaded_file_return(true);
        v::not(v::uploaded())->assert('filename');
    },
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "filename" must not be an uploaded file'),
));
