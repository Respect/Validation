<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Countable as PhpCountable;
use Respect\Validation\Helpers\CanBindEvaluateRule;
use Respect\Validation\Message\Template;
use Respect\Validation\Result;
use Respect\Validation\Rules\Core\Wrapper;

use function count;
use function is_string;
use function mb_strlen;

#[Template('The length of', 'The length of')]
final class Length extends Wrapper
{
    use CanBindEvaluateRule;

    public function evaluate(mixed $input): Result
    {
        $typeResult = $this->bindEvaluate(new OneOf(new StringType(), new Countable()), $this, $input);
        if (!$typeResult->isValid) {
            return Result::failed($input, $this)->withNextSibling($this->rule->evaluate($input));
        }

        $result = $this->rule->evaluate($this->extractLength($input))->withInput($input);

        return (new Result($result->isValid, $input, $this))->withNextSibling($result);
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
