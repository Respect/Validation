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

use function is_file;
use function is_string;

#[Template(
    '{{name}} must be a valid file',
    '{{name}} must be an invalid file',
)]
final class File extends Simple
{
    protected function isValid(mixed $input): bool
    {
        if ($input instanceof SplFileInfo) {
            return $input->isFile();
        }

        return is_string($input) && is_file($input);
    }
}
