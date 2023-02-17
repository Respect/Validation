<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Test\Rules;

use Respect\Validation\Rules\AbstractRule;

/**
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class Valid extends AbstractRule
{
    /**
     * {@inheritDoc}
     */
    public function validate($input): bool
    {
        return true;
    }
}
