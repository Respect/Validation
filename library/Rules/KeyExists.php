<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use ArrayAccess;
use Attribute;
use Respect\Validation\Message\Template;
use Respect\Validation\Path;
use Respect\Validation\Result;
use Respect\Validation\Rule;
use Respect\Validation\Rules\Core\KeyRelated;

use function array_key_exists;
use function is_array;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must be present',
    '{{subject}} must not be present',
)]
final class KeyExists implements Rule, KeyRelated
{
    public function __construct(
        private readonly int|string $key,
    ) {
    }

    public function getKey(): int|string
    {
        return $this->key;
    }

    public function evaluate(mixed $input): Result
    {
        return Result::of($this->hasKey($input), $input, $this)->withPath(new Path($this->key));
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
