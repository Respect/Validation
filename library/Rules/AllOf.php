<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Attributes\ExceptionClass;
use Respect\Validation\Attributes\Template;
use Respect\Validation\Exceptions\NestedValidationException;

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
class AllOf extends AbstractComposite
{
    public const TEMPLATE_NONE = 'none';
    public const TEMPLATE_SOME = 'some';

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

    public function getTemplate(mixed $input): string
    {
        return $this->template ?? self::TEMPLATE_SOME;
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
}
