<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Graham Campbell <graham@mineuk.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: Hugo Hamon <hugo.hamon@sensiolabs.com>
 * SPDX-FileContributor: Nick Lombard <github@jigsoft.co.za>
 * SPDX-FileContributor: William Espindola <oi@williamespindola.com.br>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use Attribute;
use Respect\Validation\Message\Template;
use Respect\Validation\Result;
use Respect\Validation\Validator;

use function end;
use function is_array;
use function mb_strlen;
use function mb_strrpos;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must end with {{endValue}}',
    '{{subject}} must not end with {{endValue}}',
)]
final readonly class EndsWith implements Validator
{
    public function __construct(
        private mixed $endValue,
    ) {
    }

    public function evaluate(mixed $input): Result
    {
        $parameters = ['endValue' => $this->endValue];

        return Result::of($this->validateIdentical($input), $input, $this, $parameters);
    }

    private function validateIdentical(mixed $input): bool
    {
        if (is_array($input)) {
            return end($input) === $this->endValue;
        }

        return mb_strrpos($input, $this->endValue) === mb_strlen($input) - mb_strlen($this->endValue);
    }
}
