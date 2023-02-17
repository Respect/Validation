<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use function is_string;
use function mb_strlen;
use function preg_match;

/**
 * Validate if a string is Base64-encoded.
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Jens Segers <segers.jens@gmail.com>
 * @author William Espindola <oi@williamespindola.com.br>
 */
final class Base64 extends AbstractRule
{
    /**
     * {@inheritDoc}
     */
    public function validate($input): bool
    {
        if (!is_string($input)) {
            return false;
        }

        if (!preg_match('#^[A-Za-z0-9+/\n\r]+={0,2}$#', $input)) {
            return false;
        }

        return mb_strlen($input) % 4 === 0;
    }
}
