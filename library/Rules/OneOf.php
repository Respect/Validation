<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\OneOfException;
use Respect\Validation\Exceptions\ValidationException;

use function array_shift;
use function count;

final class OneOf extends AbstractComposite
{
    public function assert(mixed $input): void
    {
        try {
            parent::assert($input);
        } catch (OneOfException $exception) {
            if (count($exception->getChildren()) !== count($this->getRules()) - 1) {
                throw $exception;
            }
        }
    }

    public function validate(mixed $input): bool
    {
        $rulesPassedCount = 0;
        foreach ($this->getRules() as $rule) {
            if (!$rule->validate($input)) {
                continue;
            }

            ++$rulesPassedCount;
        }

        return $rulesPassedCount === 1;
    }

    public function check(mixed $input): void
    {
        $exceptions = [];
        $rulesPassedCount = 0;
        foreach ($this->getRules() as $rule) {
            try {
                $rule->check($input);

                ++$rulesPassedCount;
            } catch (ValidationException $exception) {
                $exceptions[] = $exception;
            }
        }

        if ($rulesPassedCount === 1) {
            return;
        }

        throw array_shift($exceptions) ?: $this->reportError($input);
    }
}
