<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

use Respect\Validation\Exceptions\ValidationException;

test('Should overwrite stack trace when in Validator', function (): void {
    try {
        v::intType()->assert('string');
    } catch (ValidationException $e) {
        expect($e->getFile())->toBe(__FILE__);
        expect($e->getLine())->toBe(__LINE__ - 3);
    }
});

test('Should not overwrite stack trace when created manually', function (): void {
    try {
        throw new ValidationException('message', 'fullMessage', ['id' => 'message']);
    } catch (ValidationException $e) {
        expect($e->getFile())->toBe(__FILE__);
        expect($e->getLine())->toBe(__LINE__ - 3);
    }
});
