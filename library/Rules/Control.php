<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use function ctype_cntrl;

/**
 * Validates if all of the characters in the provided string, are control characters.
 *
 * @author Andre Ramaciotti <andre@ramaciotti.com>
 * @author Danilo Correa <danilosilva87@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Nick Lombard <github@jigsoft.co.za>
 */
final class Control extends AbstractFilterRule
{
    /**
     * {@inheritDoc}
     */
    protected function validateFilteredInput(string $input): bool
    {
        return ctype_cntrl($input);
    }
}
