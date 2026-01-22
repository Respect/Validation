<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Graham Campbell <graham@mineuk.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: Hugo Hamon <hugo.hamon@sensiolabs.com>
 * SPDX-FileContributor: Nick Lombard <github@jigsoft.co.za>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use Attribute;
use Respect\Validation\Message\Template;
use Respect\Validation\Result;
use Respect\Validation\Validator;

use function is_scalar;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must be equal to {{compareTo}}',
    '{{subject}} must not be equal to {{compareTo}}',
)]
final readonly class Equals implements Validator
{
    public function __construct(
        private mixed $compareTo,
    ) {
    }

    public function evaluate(mixed $input): Result
    {
        $parameters = ['compareTo' => $this->compareTo];
        if (is_scalar($input) === is_scalar($this->compareTo)) {
            return Result::of($input == $this->compareTo, $input, $this, $parameters);
        }

        return Result::failed($input, $this, $parameters);
    }
}
