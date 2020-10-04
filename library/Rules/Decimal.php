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

use function is_numeric;
use function is_string;
use function number_format;
use function preg_replace;
use function var_export;

/**
 * Validates the decimal
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class Decimal extends AbstractRule
{
    /**
     * @var int
     */
    private $decimals;

    public function __construct(int $decimals)
    {
        $this->decimals = $decimals;
    }

    /**
     * {@inheritDoc}
     */
    public function validate($input): bool
    {
        if (!is_numeric($input)) {
            return false;
        }

        return $this->toFormattedString($input) === $this->toRawString($input);
    }

    /**
     * @param mixed $input
     */
    private function toRawString($input): string
    {
        if (is_string($input)) {
            return $input;
        }

        return var_export($input, true);
    }

    /**
     * @param mixed $input
     */
    private function toFormattedString($input): string
    {
        $formatted = number_format((float) $input, $this->decimals, '.', '');
        if (is_string($input)) {
            return $formatted;
        }

        return preg_replace('/^(\d.\d)0*/', '$1', $formatted);
    }
}
