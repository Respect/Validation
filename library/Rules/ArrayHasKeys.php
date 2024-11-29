<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Helpers\CanBindEvaluateRule;
use Respect\Validation\Message\Template;
use Respect\Validation\Result;
use Respect\Validation\Rules\Core\Standard;

use function array_diff;
use function array_keys;
use function count;

#[Template(
    'Must have keys {{keys}} in {{name}}',
    'Must not have keys {{keys}} in {{name}}'
)]
final class ArrayHasKeys extends Standard
{
    use CanBindEvaluateRule;

    /** @var array<string|int> */
    private readonly array $keys;

    public function __construct(int|string ...$keys)
    {
        $this->keys = $keys;
    }

    public function evaluate(mixed $input): Result
    {
        $result = $this->bindEvaluate(new ArrayType(), $this, $input);
        if (!$result->isValid) {
            return $result;
        }

        if (count(array_diff($this->keys, array_keys($input))) > 0) {
            return Result::failed($input, $this, ['keys' => $this->keys]);
        }

        return Result::passed($input, $this, ['keys' => $this->keys]);
    }
}
