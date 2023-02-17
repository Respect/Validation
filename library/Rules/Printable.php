<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use function ctype_print;

/**
 * Validates whether an input is printable character(s).
 *
 * @author Alexandre Gomes Gaigalas <alganet@gmail.com>
 * @author Andre Ramaciotti <andre@ramaciotti.com>
 * @author Emmerson Siqueira <emmersonsiqueira@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Nick Lombard <github@jigsoft.co.za>
 */
final class Printable extends AbstractFilterRule
{
    /**
     * {@inheritDoc}
     */
    protected function validateFilteredInput(string $input): bool
    {
        return ctype_print($input);
    }
}
