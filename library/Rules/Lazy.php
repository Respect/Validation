<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Attribute;
use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Result;
use Respect\Validation\Rule;
use Respect\Validation\Rules\Core\Standard;

use function call_user_func;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
final class Lazy extends Standard
{
    /** @var callable(mixed): Rule */
    private $ruleCreator;

    /** @param callable(mixed): Rule $ruleCreator */
    public function __construct(callable $ruleCreator)
    {
        $this->ruleCreator = $ruleCreator;
    }

    public function evaluate(mixed $input): Result
    {
        $rule = call_user_func($this->ruleCreator, $input);
        if (!$rule instanceof Rule) {
            throw new ComponentException('Lazy failed because it could not create the rule');
        }

        return $rule->evaluate($input);
    }
}
