<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use function abs;
use function is_integer;
use function is_numeric;

/**
 * Validates if the input is a factor of the defined dividend.
 *
 * @author Danilo Correa <danilosilva87@gmail.com>
 * @author David Meister <thedavidmeister@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class Factor extends AbstractRule
{
    /**
     * @var int
     */
    private $dividend;

    /**
     * Initializes the rule.
     */
    public function __construct(int $dividend)
    {
        $this->dividend = $dividend;
    }

    /**
     * {@inheritDoc}
     */
    public function validate($input): bool
    {
        // Every integer is a factor of zero, and zero is the only integer that
        // has zero for a factor.
        if ($this->dividend === 0) {
            return true;
        }

        // Factors must be integers that are not zero.
        if (!is_numeric($input) || (int) $input != $input || $input == 0) {
            return false;
        }

        $input = (int) abs((int) $input);
        $dividend = (int) abs($this->dividend);

        // The dividend divided by the input must be an integer if input is a
        // factor of the dividend.
        return is_integer($dividend / $input);
    }
}
