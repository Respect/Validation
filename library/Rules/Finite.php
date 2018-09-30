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

use function is_finite;
use function is_numeric;

/**
 * Validates if the input is a finite number.
 *
 * @author Danilo Correa <danilosilva87@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class Finite extends AbstractRule
{
    /**
     * {@inheritdoc}
     */
    public function validate($input): bool
    {
        return is_numeric($input) && is_finite((float) $input);
    }
}
