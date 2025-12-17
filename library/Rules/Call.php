<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Attribute;
use ErrorException;
use Respect\Validation\Message\Template;
use Respect\Validation\Result;
use Respect\Validation\Rule;
use Throwable;

use function call_user_func;
use function restore_error_handler;
use function set_error_handler;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::TARGET_CLASS | Attribute::IS_REPEATABLE)]
#[Template(
    '{{input}} must be a suitable argument for {{callable}}',
    '{{input}} must not be a suitable argument for {{callable}}',
)]
final class Call implements Rule
{
    /**
     * @var callable
     */
    private $callable;

    public function __construct(
        callable $callable,
        private readonly Rule $rule
    ) {
        $this->callable = $callable;
    }

    public function evaluate(mixed $input): Result
    {
        set_error_handler(static function (int $severity, string $message, ?string $filename, int $line): void {
            throw new ErrorException($message, 0, $severity, $filename, $line);
        });

        try {
            $result = $this->rule->evaluate(call_user_func($this->callable, $input));
        } catch (Throwable) {
            $result = Result::failed($input, $this, ['callable' => $this->callable]);
        }

        restore_error_handler();

        return $result;
    }
}
