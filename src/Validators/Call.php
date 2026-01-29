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
use Respect\Validation\Result;
use Respect\Validation\Validator;

use function call_user_func;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::TARGET_CLASS | Attribute::IS_REPEATABLE)]
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
        return $this->validator->evaluate(call_user_func($this->callable, $input));
    }
}
