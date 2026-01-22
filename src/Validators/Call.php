<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Emmerson Siqueira <emmersonsiqueira@gmail.com>
 * SPDX-FileContributor: Graham Campbell <graham@mineuk.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: Nick Lombard <github@jigsoft.co.za>
 * SPDX-FileContributor: Pathum Harshana De Silva <pathumhdes@gmail.com>
 * SPDX-FileContributor: Kir Kolyshkin <kolyshkin@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use Attribute;
use ErrorException;
use Respect\Validation\Message\Template;
use Respect\Validation\Result;
use Respect\Validation\Validator;
use Throwable;

use function call_user_func;
use function restore_error_handler;
use function set_error_handler;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::TARGET_CLASS | Attribute::IS_REPEATABLE)]
#[Template(
    '{{input}} must be a suitable argument for {{callable}}',
    '{{input}} must not be a suitable argument for {{callable}}',
)]
final class Call implements Validator
{
    /** @var callable */
    private $callable;

    public function __construct(
        callable $callable,
        private readonly Validator $validator,
    ) {
        $this->callable = $callable;
    }

    public function evaluate(mixed $input): Result
    {
        set_error_handler(static function (int $severity, string $message, string|null $filename, int $line): void {
            throw new ErrorException($message, 0, $severity, $filename, $line);
        });

        try {
            $result = $this->validator->evaluate(call_user_func($this->callable, $input));
        } catch (Throwable) {
            $result = Result::failed($input, $this, ['callable' => $this->callable]);
        }

        restore_error_handler();

        return $result;
    }
}
