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

use Respect\Validation\Helpers\ComparisonHelper;

/**
 * Validates whether the input is greater than or equal to a value.
 *
 * @author Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class Min extends AbstractRule
{
    use ComparisonHelper;

    /**
     * @var mixed
     */
    private $compareTo;

    /**
     * Initializes the rule by setting the value to be compared to the input.
     *
     * @param mixed $compareTo
     */
    public function __construct($compareTo)
    {
        $this->compareTo = $compareTo;
    }

    /**
     * {@inheritdoc}
     */
    public function validate($input): bool
    {
        return $this->toComparable($input) >= $this->toComparable($this->compareTo);
    }
}
