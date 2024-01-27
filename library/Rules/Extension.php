<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use SplFileInfo;

use function is_string;
use function pathinfo;

use const PATHINFO_EXTENSION;

final class Extension extends AbstractRule
{
    public function __construct(
        private readonly string $extension
    ) {
    }

    public function validate(mixed $input): bool
    {
        if ($input instanceof SplFileInfo) {
            return $this->extension === $input->getExtension();
        }

        if (!is_string($input)) {
            return false;
        }

        return $this->extension === pathinfo($input, PATHINFO_EXTENSION);
    }
}
