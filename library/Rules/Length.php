<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Countable as PhpCountable;
use Respect\Validation\Message\Template;
use Respect\Validation\Result;
use Respect\Validation\Rules\Core\Binder;
use Respect\Validation\Rules\Core\Wrapper;

use function count;
use function is_string;
use function mb_strlen;
use function ucfirst;

#[Template('The length of', 'The length of')]
final class Length extends Wrapper
{
    public function evaluate(mixed $input): Result
    {
        $typeResult = (new Binder($this, new OneOf(new StringType(), new Countable())))->evaluate($input);
        if (!$typeResult->isValid) {
            $result = $this->rule->evaluate($input);

            return Result::failed($input, $this)->withSubsequent($result)->withId('length' . ucfirst($result->id));
        }

        $result = $this->rule->evaluate($this->extractLength($input))->withInput($input)->withPrefixedId('length');

        return (new Result($result->isValid, $input, $this, id: $result->id))->withSubsequent($result);
    }

    /** @param array<mixed>|PhpCountable|string $input */
    private function extractLength(array|PhpCountable|string $input): int
    {
        if (is_string($input)) {
            return (int) mb_strlen($input);
        }

        return count($input);
    }
}
