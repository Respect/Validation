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

use function is_float;

/**
 * Validates whether the characters in the input are uppercase.
 *
 * @author Alexandre <alexandre@gaigalas.net>
 * @author Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 * @author Danilo Benevides <danilobenevides01@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Jayson Reis <santosdosreis@gmail.com>
 */
final class FloatVal extends AbstractRule
{
    /**
    * {@inheritdoc}
    */
    public function validate($input): bool
    {
        return is_float(filter_var($input, FILTER_VALIDATE_FLOAT));
    }
}
