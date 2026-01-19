<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Carlos André Ferrari <caferrari@gmail.com>
 * SPDX-FileContributor: Graham Campbell <graham@mineuk.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: Nick Lombard <github@jigsoft.co.za>
 * SPDX-FileContributor: William Espindola <oi@williamespindola.com.br>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use Attribute;
use Respect\Validation\Exceptions\InvalidValidatorException;
use Respect\Validation\Message\Template;
use Respect\Validation\Result;
use Respect\Validation\Validator;

use function mb_strlen;
use function mb_substr;
use function preg_match;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must be a number in base {{base|raw}}',
    '{{subject}} must not be a number in base {{base|raw}}',
)]
final readonly class Base implements Validator
{
    public function __construct(
        private int $base,
        private string $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
    ) {
        $max = mb_strlen($this->chars);
        if ($base > $max) {
            throw new InvalidValidatorException('a base between 1 and %s is required', (string) $max);
        }
    }

    public function evaluate(mixed $input): Result
    {
        return Result::of(
            (bool) preg_match('@^[' . mb_substr($this->chars, 0, $this->base) . ']+$@', (string) $input),
            $input,
            $this,
            ['base' => $this->base],
        );
    }
}
