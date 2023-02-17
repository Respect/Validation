<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use function array_map;

/**
 * Validates if the input contains at least one of defined values
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Kirill Dlussky <kirill@dlussky.ru>
 */
final class ContainsAny extends AbstractEnvelope
{
    /**
     * Initializes the rule.
     *
     * @param mixed[] $needles At least one of the values provided must be found in input string or array
     * @param bool $identical Defines whether the value should be compared strictly, when validating array
     */
    public function __construct(array $needles, bool $identical = false)
    {
        parent::__construct(
            new AnyOf(...$this->getRules($needles, $identical)),
            ['needles' => $needles]
        );
    }

    /**
     * @param mixed[] $needles
     *
     * @return Contains[]
     */
    private function getRules(array $needles, bool $identical): array
    {
        return array_map(
            static function ($needle) use ($identical): Contains {
                return new Contains($needle, $identical);
            },
            $needles
        );
    }
}
