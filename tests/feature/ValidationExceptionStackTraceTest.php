<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\ResultQuery;
use Respect\Validation\Test\Builders\ResultBuilder;
use Respect\Validation\Test\Message\TestingArrayFormatter;
use Respect\Validation\Test\Message\TestingMessageRenderer;
use Respect\Validation\Test\Message\TestingStringFormatter;
use Respect\Validation\Test\Stubs\MyValidator;

$resultQuery = new ResultQuery(
    (new ResultBuilder())->build(),
    new TestingMessageRenderer(),
    new TestingStringFormatter(),
    new TestingStringFormatter(),
    new TestingArrayFormatter(),
    [],
);

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

test('Should not overwrite file and line when created manually', function () use ($resultQuery): void {
    try {
        throw new ValidationException('message', $resultQuery);
    } catch (ValidationException $e) {
        expect($e->getFile())->toBe(__FILE__);
        expect($e->getLine())->toBe(__LINE__ - 3);
    }
});


test('Should not overwrite file and line when file cannot be ever traced', function () use ($resultQuery): void {
    try {
        throw new ValidationException('message', $resultQuery, '/tmp/unknown');
    } catch (ValidationException $e) {
        expect($e->getFile())->toBe(__FILE__);
        expect($e->getLine())->toBe(__LINE__ - 3);
    }
});


test('Should go not overwrite file and line when it runs out of choices', function () use ($resultQuery): void {
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

        throw new ValidationException('message', $resultQuery, ...$trace);
    } catch (ValidationException $e) {
        expect($e->getFile())->toBe(__FILE__);
        expect($e->getLine())->toBe(__LINE__ - 3);
    }
});
