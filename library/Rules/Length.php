<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Attribute;
use Countable as PhpCountable;
use Respect\Validation\Message\Template;
use Respect\Validation\Result;
use Respect\Validation\Rules\Core\Wrapper;

use function count;
use function is_array;
use function is_string;
use function mb_strlen;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    'The length of',
    'The length of',
    self::TEMPLATE_STANDARD,
)]
#[Template(
    '{{subject}} must be a countable value or a string',
    '{{subject}} must not be a countable value or a string',
    self::TEMPLATE_WRONG_TYPE,
)]
final class Length extends Wrapper
{
    public const string TEMPLATE_WRONG_TYPE = '__wrong_type__';

    public function evaluate(mixed $input): Result
    {
        $length = $this->extractLength($input);
        if ($length === null) {
            return Result::failed($input, $this, [], self::TEMPLATE_WRONG_TYPE)
                ->withId($this->rule->evaluate($input)->id->withPrefix('length'));
        }

        return Result::fromAdjacent($input, 'length', $this, $this->rule->evaluate($length));
    }

    private function extractLength(mixed $input): int|null
    {
        if (is_string($input)) {
            return (int) mb_strlen($input);
        }

        if ($input instanceof PhpCountable || is_array($input)) {
            return count($input);
        }

        return null;
    }
}
