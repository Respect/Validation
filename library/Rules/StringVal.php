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

use Respect\Validation\Result;
use Respect\Validation\Rule;

/**
 * Validates whether the input can be used as a string.
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 *
 * @since 2.0.0
 */
final class StringVal implements Rule
{
    /**
     * {@inheritdoc}
     */
    public function apply($input): Result
    {
        $isValid = is_scalar($input) || (is_object($input) && method_exists($input, '__toString'));

        return new Result($isValid, $input, $this);
    }
}
