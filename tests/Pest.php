<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

use Respect\Validation\Exceptions\ValidationException;
use Symfony\Component\VarExporter\VarExporter;

use function PHPUnit\Framework\assertStringMatchesFormat;

/** @param array<string, mixed> $messages */
function expectAll(callable $callback, string $message, string $fullMessage, array $messages): Closure
{
    return function () use ($callback, $message, $fullMessage, $messages): void {
        try {
            $callback();
            test()->expectException(ValidationException::class);
        } catch (ValidationException $e) {
            expect($e->getMessage())->toBe($message)
            ->and($e->getFullMessage())->toBe($fullMessage)
            ->and($e->getMessages())->toBe($messages);
        }
    };
}

/** @param array<string, mixed> $messages */
function expectAllToMatch(callable $callback, string $message, string $fullMessage, array $messages): Closure
{
    return function () use ($callback, $message, $fullMessage, $messages): void {
        try {
            $callback();
            test()->expectException(ValidationException::class);
        } catch (ValidationException $e) {
            assertStringMatchesFormat($message, $e->getMessage(), 'Validation message does not match');
            assertStringMatchesFormat($fullMessage, $e->getFullMessage(), 'Validation full message does not match');
            assertStringMatchesFormat(
                VarExporter::export($messages),
                VarExporter::export($e->getMessages()),
                'Validation messages do not match'
            );
        }
    };
}

function expectMessage(callable $callback, string $message): Closure
{
    return function () use ($callback, $message): void {
        try {
            $callback();
            test()->expectException(ValidationException::class);
        } catch (ValidationException $e) {
            expect($e->getMessage())->toBe($message, 'Validation message does not match');
        }
    };
}

function expectFullMessage(callable $callback, string $fullMessage): Closure
{
    return function () use ($callback, $fullMessage): void {
        try {
            $callback();
            test()->expectException(ValidationException::class);
        } catch (ValidationException $exception) {
            expect($exception->getFullMessage())->toBe($fullMessage, 'Validation full message does not match');
        }
    };
}

/** @param array<string, mixed> $messages */
function expectMessages(callable $callback, array $messages): Closure
{
    return function () use ($callback, $messages): void {
        try {
            $callback();
            test()->expectException(ValidationException::class);
        } catch (ValidationException $exception) {
            expect($exception->getMessages())->toBe($messages, 'Validation messages do not match');
        }
    };
}

function expectMessageAndError(Closure $callback, string $message, string $error): Closure
{
    return function () use ($callback, $message, $error): void {
        $lastError = null;
        set_error_handler(static function (int $errno, string $errstr) use (&$lastError): bool {
            $lastError = $errstr;

            return true;
        });
        try {
            $callback();
            test()->expectException(ValidationException::class);
        } catch (ValidationException $e) {
            expect($e->getMessage())->toBe($message, 'Validation message does not match');
        }
        restore_error_handler();
        expect($lastError)->toBe($error);
    };
}
