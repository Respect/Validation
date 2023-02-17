<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use function floor;
use function is_numeric;
use function sqrt;

/**
 * Validates whether the input is a perfect square.
 *
 * @author Danilo Benevides <danilobenevides01@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Kleber Hamada Sato <kleberhs007@yahoo.com>
 * @author Nick Lombard <github@jigsoft.co.za>
 */
final class PerfectSquare extends AbstractRule
{
    /**
     * {@inheritDoc}
     */
    public function validate($input): bool
    {
        return is_numeric($input) && floor(sqrt((float) $input)) == sqrt((float) $input);
    }
}
