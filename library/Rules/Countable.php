<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Countable as CountableInterface;

use function is_array;

/**
 * Validates if the input is countable.
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author João Torquato <joao.otl@gmail.com>
 * @author William Espindola <oi@williamespindola.com.br>
 */
final class Countable extends AbstractRule
{
    /**
     * {@inheritDoc}
     */
    public function validate($input): bool
    {
        return is_array($input) || $input instanceof CountableInterface;
    }
}
