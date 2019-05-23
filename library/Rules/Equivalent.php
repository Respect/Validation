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

use function is_scalar;
use function mb_strtoupper;

/**
 * Validates if the input is equivalent to some value.
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class Equivalent extends AbstractRule
{
    /**
     * @var mixed
     */
    private $compareTo;

    /**
     * Initializes the rule.
     *
     * @param mixed $compareTo
     */
    public function __construct($compareTo)
    {
        $this->compareTo = $compareTo;
    }

    /**
     * {@inheritDoc}
     */
    public function validate($input): bool
    {
        if (is_scalar($input)) {
            return $this->isStringEquivalent((string) $input);
        }

        return $input == $this->compareTo;
    }

    private function isStringEquivalent(string $input): bool
    {
        if (!is_scalar($this->compareTo)) {
            return false;
        }

        return mb_strtoupper((string) $input) === mb_strtoupper((string) $this->compareTo);
    }
}
