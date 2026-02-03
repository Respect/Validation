<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use Attribute;
use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Result;
use Respect\Validation\Validator;

use function call_user_func;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::TARGET_CLASS | Attribute::IS_REPEATABLE)]
final class Factory implements Validator
{
    /** @var callable(mixed): Validator */
    private $validatorCreator;

    /** @param callable(mixed): Validator $factory */
    public function __construct(callable $factory)
    {
        $this->validatorCreator = $factory;
    }

    public function evaluate(mixed $input): Result
    {
        $validator = call_user_func($this->validatorCreator, $input);
        if (!$validator instanceof Validator) {
            throw new ComponentException('Factory could not create validator');
        }

        return $validator->evaluate($input);
    }
}
