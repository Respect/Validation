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

/**
 * @author Samuel Heinzmann <samuel.heinzman@swisscom.com>
 */
class Fibonacci extends AbstractRule
{
    /**
     * {@inheritdoc}
     */
    public function validate($input)
    {
        if (!is_numeric($input)) {
            return false;
        }

        $sequence = [0, 1];
        $position = 1;
        while ($input > $sequence[$position]) {
            ++$position;
            $sequence[$position] = $sequence[$position - 1] + $sequence[$position - 2];
        }

        return $sequence[$position] === (int) $input;
    }
}
