<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Helpers\CanValidateUndefined;

/**
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class Optional extends AbstractWrapper
{
    use CanValidateUndefined;

    /**
     * {@inheritDoc}
     */
    public function assert($input): void
    {
        if ($this->isUndefined($input)) {
            return;
        }

        parent::assert($input);
    }

    /**
     * {@inheritDoc}
     */
    public function check($input): void
    {
        if ($this->isUndefined($input)) {
            return;
        }

        parent::check($input);
    }

    /**
     * {@inheritDoc}
     */
    public function validate($input): bool
    {
        if ($this->isUndefined($input)) {
            return true;
        }

        return parent::validate($input);
    }
}
