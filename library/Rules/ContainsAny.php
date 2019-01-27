<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
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
     * @param array $needles At least one of the values provided must be found in input string or array
     * @param bool $identical Defines whether the value should be compared strictly, when validating array
     */
    public function __construct(array $needles, bool $identical = false)
    {
        parent::__construct(
            new AnyOf(...$this->getRules($needles, $identical)),
            ['needles' => $needles]
        );
    }

    private function getRules(array $needles, bool $identical): array
    {
        return array_map(
            function ($needle) use ($identical): Contains {
                return new Contains($needle, $identical);
            },
            $needles
        );
    }
}
