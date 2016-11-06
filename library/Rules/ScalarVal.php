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

use Respect\Validation\Result;
use Respect\Validation\Rule;

/**
 * Validates if the input is a scalar value.
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 *
 * @since 1.0.0
 */
final class ScalarVal implements Rule
{
    /**
     * {@inheritdoc}
     */
    public function validate($input): Result
    {
        return new Result(is_scalar($input), $input, $this);
    }
}
