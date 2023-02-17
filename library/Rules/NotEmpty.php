<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use function is_string;
use function trim;

/**
 * Validates whether the input is not empty
 *
 * @author Alexandre Gomes Gaigalas <alganet@gmail.com>
 * @author Bram Van der Sype <bram.vandersype@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class NotEmpty extends AbstractRule
{
    /**
     * {@inheritDoc}
     */
    public function validate($input): bool
    {
        if (is_string($input)) {
            $input = trim($input);
        }

        return !empty($input);
    }
}
