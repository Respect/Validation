<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
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
final class Lazy implements Validator
{
    /** @var callable(mixed): Validator */
    private $validatorCreator;

    /** @param callable(mixed): Validator $validatorCreator */
    public function __construct(callable $validatorCreator)
    {
        $this->validatorCreator = $validatorCreator;
    }

    public function evaluate(mixed $input): Result
    {
        $validator = call_user_func($this->validatorCreator, $input);
        if (!$validator instanceof Validator) {
            throw new ComponentException('Lazy failed because it could not create the rule');
        }

        return $validator->evaluate($input);
    }
}
