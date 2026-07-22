<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Helpers\CanCompareValues;

/**
 * Validates whether the input is between two other values, excluding the boundaries.
 *
 * @author Alexandre Gomes Gaigalas <alganet@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class BetweenExclusive extends AbstractEnvelope
{
    use CanCompareValues;

    /**
     * Initializes the rule.
     *
     * @param mixed $minValue
     * @param mixed $maxValue
     *
     * @throws ComponentException
     */
    public function __construct($minValue, $maxValue)
    {
        if ($this->toComparable($minValue) >= $this->toComparable($maxValue)) {
            throw new ComponentException('Minimum cannot be less than or equals to maximum');
        }

        parent::__construct(
            new AllOf(
                new GreaterThan($minValue),
                new LessThan($maxValue)
            ),
            [
                'minValue' => $minValue,
                'maxValue' => $maxValue,
            ]
        );
    }
}
