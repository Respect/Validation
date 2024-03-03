<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Message\Template;
use Respect\Validation\Rules\Core\Simple;
use SplFileInfo;

use function file_exists;
use function is_string;

#[Template(
    '{{name}} must exist',
    '{{name}} must not exist',
)]
final class Exists extends Simple
{
    public function validate(mixed $input): bool
    {
        if ($input instanceof SplFileInfo) {
            $input = $input->getPathname();
        }

        return is_string($input) && file_exists($input);
    }
}
