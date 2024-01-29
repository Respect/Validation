<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use function is_scalar;
use function mb_strtoupper;

final class Equivalent extends AbstractRule
{
    public function __construct(
        private readonly mixed $compareTo
    ) {
    }

    public function validate(mixed $input): bool
    {
        if (is_scalar($input)) {
            return $this->isStringEquivalent((string) $input);
        }

        return $input == $this->compareTo;
    }

    /**
     * @return array<string, mixed>
     */
    public function getParams(): array
    {
        return ['compareTo' => $this->compareTo];
    }

    private function isStringEquivalent(string $input): bool
    {
        if (!is_scalar($this->compareTo)) {
            return false;
        }

        return mb_strtoupper((string) $input) === mb_strtoupper((string) $this->compareTo);
    }
}
