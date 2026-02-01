<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

use Respect\Validation\Exceptions\ValidationException;

test('It should not throw an exception when a single validator passes', function (): void {
    v::intType()->check(42);
})->throwsNoExceptions();

test('It should not throw an exception when all chained validators pass', function (): void {
    v::intType()->positive()->check(42);
})->throwsNoExceptions();

test('It should throw an exception when a single validator fails', catchMessage(
    fn() => v::intType()->check('not an integer'),
    fn(string $message) => expect($message)->toBe('"not an integer" must be an integer'),
));

test('It should stop at the first failure with multiple validators', catchMessage(
    fn() => v::intType()->positive()->check('not valid'),
    fn(string $message) => expect($message)->toBe('"not valid" must be an integer'),
));

test('It should report the second validator when only it fails', catchMessage(
    fn() => v::intType()->positive()->check(-5),
    fn(string $message) => expect($message)->toBe('-5 must be a positive number'),
));

test('It should only report the first failing key', catchMessage(
    fn() => v::key('name', v::stringType())->key('age', v::intType())->check(['name' => 123, 'age' => 'old']),
    fn(string $message) => expect($message)->toBe('`.name` must be a string'),
));

test('It should report the second key when the first passes', catchMessage(
    fn() => v::key('name', v::stringType())->key('age', v::intType())->check(['name' => 'John', 'age' => 'old']),
    fn(string $message) => expect($message)->toBe('`.age` must be an integer'),
));

test('It should use a string template to override the message', catchMessage(
    fn() => v::intType()->check('test', 'The input must be a number'),
    fn(string $message) => expect($message)->toBe('The input must be a number'),
));

test('It should use an array template to override specific validator messages', catchMessage(
    fn() => v::intType()->positive()->check('test', ['intType' => 'Must be a whole number']),
    fn(string $message) => expect($message)->toBe('Must be a whole number'),
));

test('It should throw a custom Throwable when provided as template', function (): void {
    $exception = new RuntimeException('Custom error');

    expect(fn() => v::intType()->check('test', $exception))->toThrow($exception);
});

test('It should not throw a custom Throwable when validation passes', function (): void {
    v::intType()->check(42, new RuntimeException('Custom error'));
})->throwsNoExceptions();

test('It should use a callable template to transform the exception', function (): void {
    expect(fn() => v::intType()->check(
        'test',
        fn(ValidationException $e) => new DomainException($e->getMessage()),
    ),)->toThrow(new DomainException('"test" must be an integer'));
});

test('It should provide full message with single failure', catchFullMessage(
    fn() => v::intType()->check('test'),
    fn(string $fullMessage) => expect($fullMessage)->toBe('- "test" must be an integer'),
));

test('It should provide messages array with single failure', catchMessages(
    fn() => v::intType()->check('test'),
    fn(array $messages) => expect($messages)->toBe(['intType' => '"test" must be an integer']),
));

test('It should provide all exception details on short-circuited failure', catchAll(
    fn() => v::intType()->positive()->check('test'),
    fn(string $message, string $fullMessage, array $messages) => expect()
        ->and($message)->toBe('"test" must be an integer')
        ->and($fullMessage)->toBe('- "test" must be an integer')
        ->and($messages)->toBe(['intType' => '"test" must be an integer']),
));

test('It should not throw when validating a present key', function (): void {
    v::key('name', v::stringType())->check(['name' => 'John']);

    expect(true)->toBeTrue();
});

test('It should throw when a required key is missing', catchMessage(
    fn() => v::key('name', v::stringType())->check([]),
    fn(string $message) => expect($message)->toBe('`.name` must be present'),
));

test('It should work with named validators', catchMessage(
    fn() => v::named('user age', v::intType())->check('old'),
    fn(string $message) => expect($message)->toBe('user age must be an integer'),
));

test('It should work with negated validators', catchMessage(
    fn() => v::not(v::intType())->check(42),
    fn(string $message) => expect($message)->toBe('42 must not be an integer'),
));
