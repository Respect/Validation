<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Helpers\CanBindEvaluateRule;
use Respect\Validation\Result;
use Respect\Validation\Rules\Core\Standard;
use Respect\Validation\Validatable;

use function call_user_func;

final class Lazy extends Standard
{
    use CanBindEvaluateRule;

    /** @var callable(mixed): Validatable */
    private $ruleCreator;

    /**
     * @param callable(mixed): Validatable $ruleCreator
     */
    public function __construct(callable $ruleCreator)
    {
        $this->ruleCreator = $ruleCreator;
    }

    public function evaluate(mixed $input): Result
    {
        $rule = call_user_func($this->ruleCreator, $input);
        if (!$rule instanceof Validatable) {
            throw new ComponentException('Lazy failed because it could not create the rule');
        }

        return $this->bindEvaluate($rule, $this, $input);
    }
}
