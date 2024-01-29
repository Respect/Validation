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
    'None of these rules must pass for {{name}}',
    'All of these rules must pass for {{name}}',
)]
final class NoneOf extends AbstractComposite
{
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
