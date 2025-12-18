<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

use Respect\Validation\Exceptions\ValidationException;

function catchAll(Closure $try, Closure $catch): Closure
{
    return function () use ($try, $catch): void {
        try {
            $try->call($this);
            test()->expectException(ValidationException::class);
        } catch (ValidationException $e) {
            $catch->call($this, $e->getMessage(), $e->getFullMessage(), $e->getMessages());
        }
    };
}

function catchMessage(Closure $try, Closure $catch): Closure
{
    return function () use ($try, $catch): void {
        try {
            $try->call($this);
            test()->expectException(ValidationException::class);
        } catch (ValidationException $e) {
            $catch->call($this, $e->getMessage());
        }
    };
}

function catchFullMessage(Closure $try, Closure $catch): Closure
{
    return function () use ($try, $catch): void {
        try {
            $try->call($this);
            test()->expectException(ValidationException::class);
        } catch (ValidationException $e) {
            $catch->call($this, $e->getFullMessage());
        }
    };
}

function catchMessages(Closure $try, Closure $catch): Closure
{
    return function () use ($try, $catch): void {
        try {
            $try->call($this);
            test()->expectException(ValidationException::class);
        } catch (ValidationException $e) {
            $catch->call($this, $e->getMessages());
        }
    };
}

function expectDeprecation(Closure $callback, string $error): Closure
{
    return function () use ($callback, $error): void {
        $lastError = null;
        set_error_handler(static function (int $errno, string $errstr) use (&$lastError): bool {
            if ($errno !== E_USER_DEPRECATED) {
                return false;
            }
            $lastError = $errstr;

            return true;
        });

        $callback->call($this);
        restore_error_handler();
        expect($lastError)->toBe($error);
    };
}

function expectMessageAndDeprecation(Closure $callback, string $message, string $error): Closure
{
    return function () use ($callback, $message, $error): void {
        $lastError = null;
        set_error_handler(static function (int $errno, string $errstr) use (&$lastError): bool {
            if ($errno !== E_USER_DEPRECATED) {
                return false;
            }
            $lastError = $errstr;

            return true;
        });
        try {
            $callback->call($this);
            test()->expectException(ValidationException::class);
        } catch (ValidationException $e) {
            expect($e->getMessage())->toBe($message, 'Validation message does not match');
        }
        restore_error_handler();
        expect($lastError)->toBe($error);
    };
}
