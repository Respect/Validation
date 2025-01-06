<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Directory as NativeDirectory;
use SplFileInfo;

use function is_dir;
use function is_scalar;

/**
 * Validates if the given path is a directory.
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author William Espindola <oi@williamespindola.com.br>
 */
final class Directory extends AbstractRule
{
    /**
     * @deprecated Calling `validate()` directly from rules is deprecated. Please use {@see \Respect\Validation\Validator::isValid()} instead.
     */
    public function validate($input): bool
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
