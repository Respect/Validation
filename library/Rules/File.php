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
    '{{name}} must be a file',
    '{{name}} must not be a file',
)]
final class File extends Simple
{
    public function validate(mixed $input): bool
    {
        if ($input instanceof SplFileInfo) {
            return $input->isFile();
        }

        return is_string($input) && is_file($input);
    }
}
