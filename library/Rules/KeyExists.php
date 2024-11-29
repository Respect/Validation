<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use ArrayAccess;
use Respect\Validation\Message\Template;
use Respect\Validation\Result;
use Respect\Validation\Rules\Core\KeyRelated;
use Respect\Validation\Rules\Core\Standard;

use function array_key_exists;
use function is_array;

#[Template(
    '{{name}} must be present',
    '{{name}} must not be present',
)]
final class KeyExists extends Standard implements KeyRelated
{
    public function __construct(
        private readonly int|string $key
    ) {
    }

    public function getKey(): int|string
    {
        return $this->key;
    }

    public function evaluate(mixed $input): Result
    {
        return new Result($this->hasKey($input), $input, $this, name: (string) $this->key, id: (string) $this->key);
    }

    private function hasKey(mixed $input): bool
    {
        if (is_array($input)) {
            return array_key_exists($this->key, $input);
        }

        if ($input instanceof ArrayAccess) {
            return $input->offsetExists($this->key);
        }

        return false;
    }
}
