<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Attribute;
use Respect\Validation\Result;
use Respect\Validation\Rule;
use Respect\Validation\Rules\Core\KeyRelated;
use Respect\Validation\Rules\Core\Nameable;
use Respect\Validation\Rules\Core\Wrapper;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
final class Key extends Wrapper implements KeyRelated
{
    public function __construct(
        private readonly int|string $key,
        Rule $rule,
    ) {
        parent::__construct($rule);
    }

    public function getKey(): int|string
    {
        return $this->key;
    }

    public function evaluate(mixed $input): Result
    {
        $keyExistsResult = (new KeyExists($this->key))->evaluate($input);
        if (!$keyExistsResult->isValid) {
            return $keyExistsResult->withName($this->getName());
        }

        return $this->rule
            ->evaluate($input[$this->key])
            ->withName($this->getName())
            ->withUnchangeableId((string) $this->key);
    }

    private function getName(): string
    {
        if ($this->rule instanceof Nameable) {
            return $this->rule->getName() ?? ((string) $this->key);
        }

        return (string) $this->key;
    }
}
