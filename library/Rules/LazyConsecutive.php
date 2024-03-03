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

use function array_merge;

final class LazyConsecutive extends Standard
{
    use CanBindEvaluateRule;

    /** @var non-empty-array<callable> */
    private array $ruleCreators;

    /**
     * @param callable(mixed): Validatable $ruleCreator
     * @param callable(mixed): Validatable ...$ruleCreators
     */
    public function __construct(callable $ruleCreator, callable ...$ruleCreators)
    {
        $this->ruleCreators = array_merge([$ruleCreator], $ruleCreators);
    }

    public function evaluate(mixed $input): Result
    {
        foreach ($this->ruleCreators as $key => $ruleCreator) {
            $rule = $ruleCreator($input);
            if (!$rule instanceof Validatable) {
                throw new ComponentException(
                    'LazyConsecutive failed because it could not create rule #' . ($key + 1)
                );
            }

            $result = $this->bindEvaluate($rule, $this, $input);
            if (!$result->isValid) {
                return $result;
            }
        }

        return $result;
    }
}
