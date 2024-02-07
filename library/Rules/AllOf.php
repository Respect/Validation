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

use function array_filter;
use function array_map;
use function array_reduce;
use function count;

#[ExceptionClass(NestedValidationException::class)]
#[Template(
    'These rules must pass for {{name}}',
    'These rules must not pass for {{name}}',
    self::TEMPLATE_SOME,
)]
#[Template(
    'All of the required rules must pass for {{name}}',
    'None of these rules must pass for {{name}}',
    self::TEMPLATE_NONE,
)]
final class AllOf extends AbstractComposite
{
    public const TEMPLATE_NONE = '__none__';
    public const TEMPLATE_SOME = '__some__';

    public function evaluate(mixed $input): Result
    {
        $children = array_map(static fn (Rule $rule) => $rule->evaluate($input), $this->getRules());
        $valid = array_reduce($children, static fn (bool $carry, Result $result) => $carry && $result->isValid, true);
        $failed = array_filter($children, static fn (Result $result): bool => !$result->isValid);
        $template = self::TEMPLATE_SOME;
        if (count($children) === count($failed)) {
            $template = self::TEMPLATE_NONE;
        }

        return (new Result($valid, $input, $this, $template))->withChildren(...$children);
    }

    public function assert(mixed $input): void
    {
        try {
            parent::assert($input);
        } catch (NestedValidationException $exception) {
            if (count($exception->getChildren()) === count($this->getRules()) && !$exception->hasCustomTemplate()) {
                $exception->updateTemplate(self::TEMPLATE_NONE);
            }

            throw $exception;
        }
    }

    public function check(mixed $input): void
    {
        foreach ($this->getRules() as $rule) {
            $rule->check($input);
        }
    }

    public function validate(mixed $input): bool
    {
        foreach ($this->getRules() as $rule) {
            if (!$rule->validate($input)) {
                return false;
            }
        }

        return true;
    }

    protected function getStandardTemplate(mixed $input): string
    {
        return self::TEMPLATE_SOME;
    }
}
