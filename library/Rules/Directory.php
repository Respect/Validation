<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Directory as NativeDirectory;
use Respect\Validation\Message\Template;
use Respect\Validation\Rules\Core\Simple;
use SplFileInfo;

use function is_dir;
use function is_scalar;

#[Template(
    '{{name}} must be a directory',
    '{{name}} must not be a directory',
)]
final class Directory extends Simple
{
    public function validate(mixed $input): bool
    {
        if ($input instanceof SplFileInfo) {
            return $input->isDir();
        }

        if ($input instanceof NativeDirectory) {
            return true;
        }

        if (!is_scalar($input)) {
            return false;
        }

        return is_dir((string) $input);
    }
}
