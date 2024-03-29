<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use ErrorException;
use Respect\Validation\Message\Template;
use Respect\Validation\Result;
use Respect\Validation\Rules\Core\Standard;
use Respect\Validation\Validatable;
use Throwable;

use function call_user_func;
use function restore_error_handler;
use function set_error_handler;

#[Template(
    '{{input}} must be valid when executed with {{callable}}',
    '{{input}} must not be valid when executed with {{callable}}',
)]
final class Call extends Standard
{
    /**
     * @var callable
     */
    private $callable;

    public function __construct(
        callable $callable,
        private readonly Validatable $rule
    ) {
        $this->callable = $callable;
    }

    public function evaluate(mixed $input): Result
    {
        set_error_handler(static function (int $severity, string $message, ?string $filename, int $line): void {
            throw new ErrorException($message, 0, $severity, $filename, $line);
        });

        try {
            return $this->rule->evaluate(call_user_func($this->callable, $input));
        } catch (Throwable) {
            restore_error_handler();

            return Result::failed($input, $this, ['callable' => $this->callable]);
        }
    }
}
