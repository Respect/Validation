<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

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
        $fib[0] = 0;
        $fib[1] = 1;
        $n = 1;
        while ($input > $fib[$n]) {
            $n++;
            $fib[$n] = $fib[$n - 1] + $fib[$n - 2];
        }

        return $fib[$n] === (int)$input && is_numeric($input);
    }
}
