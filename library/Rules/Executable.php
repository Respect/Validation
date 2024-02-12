<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Message\Template;
use SplFileInfo;

use function is_executable;
use function is_scalar;

#[Template(
    '{{name}} must be an executable file',
    '{{name}} must not be an executable file',
)]
final class Executable extends Simple
{
    public function validate(mixed $input): bool
    {
        if ($input instanceof SplFileInfo) {
            return $input->isExecutable();
        }

        if (!is_scalar($input)) {
            return false;
        }

        return is_executable((string) $input);
    }
}
