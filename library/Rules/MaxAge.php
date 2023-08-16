<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

/**
 * Validates a maximum age for a given date.
 *
 * @author Emmerson Siqueira <emmersonsiqueira@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class MaxAge extends AbstractAge
{
    /**
     * {@inheritDoc}
     */
    protected function compare(int $baseDate, int $givenDate): bool
    {
        return $baseDate <= $givenDate;
    }
}
