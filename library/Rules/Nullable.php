<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

/**
 * Validates the given input with a defined rule when input is not NULL.
 *
 * @author Jens Segers <segers.jens@gmail.com>
 */
final class Nullable extends AbstractWrapper
{
    /**
     * {@inheritDoc}
     */
    public function assert($input): void
    {
        if ($input === null) {
            return;
        }

        parent::assert($input);
    }

    /**
     * {@inheritDoc}
     */
    public function check($input): void
    {
        if ($input === null) {
            return;
        }

        parent::check($input);
    }

    /**
     * {@inheritDoc}
     */
    public function validate($input): bool
    {
        if ($input === null) {
            return true;
        }

        return parent::validate($input);
    }
}
