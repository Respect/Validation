<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Helpers\CanBindEvaluateRule;
use Respect\Validation\Result;
use Respect\Validation\Rule;
use Respect\Validation\Rules\Core\KeyRelated;
use Respect\Validation\Rules\Core\Wrapper;

final class Key extends Wrapper implements KeyRelated
{
    use CanBindEvaluateRule;

    public function __construct(
        private readonly int|string $key,
        Rule $rule,
    ) {
        $rule->setName($rule->getName() ?? (string) $key);
        parent::__construct($rule);
    }

    public function getKey(): int|string
    {
        return $this->key;
    }

    public function evaluate(mixed $input): Result
    {
        $keyExistsResult = $this->bindEvaluate(new KeyExists($this->key), $this, $input);
        if (!$keyExistsResult->isValid) {
            return $keyExistsResult;
        }

        $child = $this->rule
            ->evaluate($input[$this->key])
            ->withId((string) $this->key);

        return (new Result($child->isValid, $input, $this))
            ->withChildren($child)
            ->withId((string) $this->key)
            ->withNameIfMissing($this->rule->getName() ?? (string) $this->key);
    }
}
