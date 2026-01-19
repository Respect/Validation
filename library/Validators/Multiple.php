<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Danilo Benevides <danilobenevides01@gmail.com>
 * SPDX-FileContributor: Graham Campbell <graham@mineuk.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: Jean Pimentel <jeanfap@gmail.com>
 * SPDX-FileContributor: Nick Lombard <github@jigsoft.co.za>
 * SPDX-FileContributor: Kir Kolyshkin <kolyshkin@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use Attribute;
use Respect\Validation\Message\Template;
use Respect\Validation\Result;
use Respect\Validation\Validator;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must be a multiple of {{multipleOf}}',
    '{{subject}} must not be a multiple of {{multipleOf}}',
)]
final readonly class Multiple implements Validator
{
    public function __construct(
        private int $multipleOf,
    ) {
    }

    public function evaluate(mixed $input): Result
    {
        $parameters = ['multipleOf' => $this->multipleOf];
        if ($this->multipleOf == 0) {
            return Result::of($input == 0, $input, $this, $parameters);
        }

        return Result::of($input % $this->multipleOf == 0, $input, $this, $parameters);
    }
}
