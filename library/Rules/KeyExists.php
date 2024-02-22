<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Message\Template;
use Respect\Validation\Result;
use Respect\Validation\Rules\Core\Standard;

use function array_key_exists;
use function is_array;

#[Template(
    '{{name}} must be present',
    '{{name}} must not be present',
)]
final class KeyExists extends Standard
{
    public function __construct(
        private readonly int|string $key
    ) {
    }

    public function evaluate(mixed $input): Result
    {
        return new Result($this->hasKey($input), $input, $this, name: (string) $this->key);
    }

    private function hasKey(mixed $input): bool
    {
        return is_array($input) && array_key_exists($this->key, $input);
    }
}
