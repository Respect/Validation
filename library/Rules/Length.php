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

use function array_map;
use function count;
use function is_array;
use function is_string;
use function mb_strlen;
use function ucfirst;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    'The length of',
    'The length of',
    self::TEMPLATE_STANDARD
)]
#[Template(
    '{{name}} must be a countable value or a string',
    '{{name}} must not be a countable value or a string',
    self::TEMPLATE_WRONG_TYPE
)]
final class Length extends Wrapper
{
    public const TEMPLATE_WRONG_TYPE = '__wrong_type__';

    public function evaluate(mixed $input): Result
    {
        $length = $this->extractLength($input);
        if ($length === null) {
            return Result::failed($input, $this, [], self::TEMPLATE_WRONG_TYPE)
                ->withId('length' . ucfirst($this->rule->evaluate($input)->id));
        }

        return $this->enrichResult($input, $this->rule->evaluate($length));
    }

    private function enrichResult(mixed $input, Result $result): Result
    {
        if (!$result->allowsSubsequent()) {
            return $result
                ->withInput($input)
                ->withChildren(
                    ...array_map(fn(Result $child) => $this->enrichResult($input, $child), $result->children)
                );
        }

        return (new Result($result->isValid, $input, $this, id: $result->id))
            ->withPrefixedId('length')
            ->withSubsequent($result->withInput($input));
    }

    private function extractLength(mixed $input): ?int
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
