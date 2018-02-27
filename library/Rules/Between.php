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
use function Respect\Stringifier\stringify;

/**
 * Validates whether the input is between two other values.
 *
 * @author Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class Between extends AbstractRule
{
    use ComparisonHelper;

    /**
     * @var mixed
     */
    private $minimum;

    /**
     * @var mixed
     */
    private $maximum;

    /**
     * @var bool
     */
    private $inclusive;

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
            throw new ComponentException(stringify($minimum).' cannot be less than or equals to '.stringify($maximum));
        }

        $this->minimum = $minimum;
        $this->maximum = $maximum;
        $this->inclusive = $inclusive;
    }

    /**
     * {@inheritdoc}
     */
    public function validate($input): bool
    {
        $rule = new AllOf(
            new Min($this->minimum, $this->inclusive),
            new Max($this->maximum, $this->inclusive)
        );

        return $rule->validate($input);
    }
}
