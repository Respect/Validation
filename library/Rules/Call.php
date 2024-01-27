<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Validatable;
use Throwable;

use function call_user_func;
use function restore_error_handler;
use function set_error_handler;

final class Call extends AbstractRule
{
    /**
     * @var callable
     */
    private $callable;

    public function __construct(callable $callable, private Validatable $rule)
    {
        $this->callable = $callable;
    }

    public function assert(mixed $input): void
    {
        $this->setErrorHandler($input);

        try {
            $this->rule->assert(call_user_func($this->callable, $input));
        } catch (ValidationException $exception) {
            throw $exception;
        } catch (Throwable $throwable) {
            throw $this->reportError($input);
        } finally {
            restore_error_handler();
        }
    }

    public function check(mixed $input): void
    {
        $this->setErrorHandler($input);

        try {
            $this->rule->check(call_user_func($this->callable, $input));
        } catch (ValidationException $exception) {
            throw $exception;
        } catch (Throwable $throwable) {
            throw $this->reportError($input);
        } finally {
            restore_error_handler();
        }
    }

    public function validate(mixed $input): bool
    {
        try {
            $this->check($input);
        } catch (ValidationException $exception) {
            return false;
        }

        return true;
    }

    private function setErrorHandler(mixed $input): void
    {
        set_error_handler(function () use ($input): void {
            throw $this->reportError($input);
        });
    }
}
