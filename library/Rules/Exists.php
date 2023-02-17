<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use SplFileInfo;

use function file_exists;
use function is_string;

/**
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author William Espindola <oi@williamespindola.com.br>
 */
final class Exists extends AbstractRule
{
    /**
     * {@inheritDoc}
     */
    public function validate($input): bool
    {
        if ($input instanceof SplFileInfo) {
            $input = $input->getPathname();
        }

        return is_string($input) && file_exists($input);
    }
}
