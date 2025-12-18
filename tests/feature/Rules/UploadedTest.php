<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

test('Scenario #1', catchMessage(function (): void {
    uopz_set_return('is_uploaded_file', false);
    v::uploaded()->assert('filename');
},
fn(string $message) => expect($message)->toBe('"filename" must be an uploaded file')))->skip(extension_loaded('uopz') == false, 'Extension "uopz" is required to test "Uploaded" rule');

test('Scenario #2', catchMessage(function (): void {
    uopz_set_return('is_uploaded_file', true);
    v::not(v::uploaded())->assert('filename');
},
fn(string $message) => expect($message)->toBe('"filename" must not be an uploaded file')))->skip(extension_loaded('uopz') == false, 'Extension "uopz" is required to test "Uploaded" rule');

test('Scenario #3', catchFullMessage(function (): void {
    uopz_set_return('is_uploaded_file', false);
    v::uploaded()->assert('filename');
},
fn(string $fullMessage) => expect($fullMessage)->toBe('- "filename" must be an uploaded file')))->skip(extension_loaded('uopz') == false, 'Extension "uopz" is required to test "Uploaded" rule');

test('Scenario #4', catchFullMessage(function (): void {
    uopz_set_return('is_uploaded_file', true);
    v::not(v::uploaded())->assert('filename');
},
fn(string $fullMessage) => expect($fullMessage)->toBe('- "filename" must not be an uploaded file')))->skip(extension_loaded('uopz') == false, 'Extension "uopz" is required to test "Uploaded" rule');
