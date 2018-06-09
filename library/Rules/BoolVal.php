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

use const FILTER_NULL_ON_FAILURE;
use const FILTER_VALIDATE_BOOLEAN;
use function filter_var;
use function is_bool;

/**
 * Validates if the input results in a boolean value.
 *
 * @author Emmerson <emmersonsiqueira@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author William Espindola <oi@williamespindola.com.br>
 */
final class BoolVal extends AbstractRule
{
    /**
     * {@inheritdoc}
     */
    public function validate($input): bool
    {
        return is_bool(filter_var($input, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE));
    }
}
