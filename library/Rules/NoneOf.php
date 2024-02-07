<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Attributes\ExceptionClass;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Message\Template;
use Respect\Validation\Result;
use Respect\Validation\Rule;

use function array_map;
use function array_reduce;
use function count;

#[ExceptionClass(NestedValidationException::class)]
#[Template(
    'None of these rules must pass for {{name}}',
    'All of these rules must pass for {{name}}',
)]
final class NoneOf extends AbstractComposite
{
    public function evaluate(mixed $input): Result
    {
        $children = array_map(static fn (Rule $rule) => $rule->evaluate($input)->withInvertedMode(), $this->getRules());
        $valid = array_reduce($children, static fn (bool $carry, Result $result) => $carry && $result->isValid, true);

        return (new Result($valid, $input, $this))->withChildren(...$children);
    }

    public function assert(mixed $input): void
    {
        try {
            parent::assert($input);
        } catch (NestedValidationException $exception) {
            if (count($exception->getChildren()) !== count($this->getRules())) {
                throw $exception;
            }
        }
    }

    public function validate(mixed $input): bool
    {
        foreach ($this->getRules() as $rule) {
            if ($rule->validate($input)) {
                return false;
            }
        }

        return true;
    }
}
