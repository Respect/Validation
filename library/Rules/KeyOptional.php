<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Helpers\CanBindEvaluateRule;
use Respect\Validation\Result;
use Respect\Validation\Rules\Core\Wrapper;
use Respect\Validation\Validatable;

final class KeyOptional extends Wrapper
{
    use CanBindEvaluateRule;

    public function __construct(
        private readonly int|string $key,
        Validatable $rule,
    ) {
        $rule->setName($rule->getName() ?? (string) $key);
        parent::__construct($rule);
    }

    public function evaluate(mixed $input): Result
    {
        $keyExistsResult = $this->bindEvaluate(new KeyExists($this->key), $this, $input);
        if (!$keyExistsResult->isValid) {
            return $keyExistsResult->withInvertedMode();
        }

        $child = $this->rule->evaluate($input[$this->key]);

        return (new Result($child->isValid, $input, $this))
            ->withChildren($child)
            ->withNameIfMissing($this->rule->getName() ?? (string) $this->key);
    }
}
