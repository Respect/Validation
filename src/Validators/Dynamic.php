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
final class Dynamic implements Validator
{
    /** @var callable(mixed): Validator */
    private $factory;

    /** @param callable(mixed): Validator $factory */
    public function __construct(callable $factory)
    {
        $this->factory = $factory;
    }

    public function evaluate(mixed $input): Result
    {
        $validator = call_user_func($this->factory, $input);
        if (!$validator instanceof Validator) {
            throw new ComponentException('Dynamic failed because it could not create the rule');
        }

        return $validator->evaluate($input);
    }
}
