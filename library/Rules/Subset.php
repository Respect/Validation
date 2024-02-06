<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Message\Template;

use function array_diff;
use function is_array;

#[Template(
    '{{name}} must be subset of {{superset}}',
    '{{name}} must not be subset of {{superset}}',
)]
final class Subset extends AbstractRule
{
    /**
     * @param mixed[] $superset
     */
    public function __construct(
        private readonly array $superset
    ) {
    }

    public function validate(mixed $input): bool
    {
        if (!is_array($input)) {
            return false;
        }

        return array_diff($input, $this->superset) === [];
    }

    /**
     * @return array<string, mixed>
     */
    public function getParams(): array
    {
        return ['superset' => $this->superset];
    }
}
