<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Test\Stubs\MyValidator;

test('Should overwrite file and line in the Validator class', function (): void {
    try {
        v::intType()->assert('string');
    } catch (ValidationException $e) {
        expect($e->getFile())->toBe(__FILE__);
        expect($e->getLine())->toBe(__LINE__ - 3);
    }
});

test('Should overwrite file and line in ValidationException', function (): void {
    try {
        MyValidator::assertIntType('string');
    } catch (ValidationException $e) {
        expect($e->getFile())->toBe(__FILE__);
        expect($e->getLine())->toBe(__LINE__ - 3);
    }
});

test('Should not overwrite file and line when created manually', function (): void {
    try {
        throw new ValidationException('message', 'fullMessage', ['id' => 'message']);
    } catch (ValidationException $e) {
        expect($e->getFile())->toBe(__FILE__);
        expect($e->getLine())->toBe(__LINE__ - 3);
    }
});


test('Should not overwrite file and line when file cannot be ever traced', function (): void {
    try {
        throw new ValidationException('message', 'fullMessage', ['id' => 'message'], ['/tmp/unknown']);
    } catch (ValidationException $e) {
        expect($e->getFile())->toBe(__FILE__);
        expect($e->getLine())->toBe(__LINE__ - 3);
    }
});


test('Should go not overwrite file and line when it runs out of choices', function (): void {
    try {
        $trace = array_unique(
            array_filter(
                array_map(
                    fn($trace) => $trace['file'] ?? null,
                    debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS),
                ),
            ),
        );
        $trace[] = __FILE__;

        throw new ValidationException('message', 'fullMessage', ['id' => 'message'], $trace);
    } catch (ValidationException $e) {
        expect($e->getFile())->toBe(__FILE__);
        expect($e->getLine())->toBe(__LINE__ - 3);
    }
});
