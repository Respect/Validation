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

use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Helpers\ComparisonHelper;

/**
 * Validates whether the input is between two other values.
 *
 * @author Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class Between extends AbstractEnvelope
{
    use ComparisonHelper;

    /**
     * Initializes the rule.
     *
     * @param mixed $minimum
     * @param mixed $maximum
     * @param bool $inclusive
     *
     * @throws ComponentException
     */
    public function __construct($minimum, $maximum, bool $inclusive = true)
    {
        if ($this->toComparable($minimum) >= $this->toComparable($maximum)) {
            throw new ComponentException('Minimum cannot be less than or equals to maximum');
        }

        parent::__construct(
            new AllOf(
                new Min($minimum, $inclusive),
                new Max($maximum, $inclusive)
            ),
            [
                'minimum' => $minimum,
                'maximum' => $maximum,
                'inclusive' => $inclusive,
            ]
        );
    }
}
