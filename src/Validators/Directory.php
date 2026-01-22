<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Graham Campbell <graham@mineuk.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: Nick Lombard <github@jigsoft.co.za>
 * SPDX-FileContributor: William Espindola <oi@williamespindola.com.br>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use Attribute;
use Directory as NativeDirectory;
use Respect\Validation\Message\Template;
use Respect\Validation\Validators\Core\Simple;
use SplFileInfo;

use function is_dir;
use function is_scalar;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must be a directory',
    '{{subject}} must not be a directory',
)]
final class Directory extends Simple
{
    public function isValid(mixed $input): bool
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
