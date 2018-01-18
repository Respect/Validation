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

/**
 * Validates the given input with a defined rule when input is not NULL.
 *
 * @author Jens Segers <segers.jens@gmail.com>
 */
final class Nullable extends AbstractWrapper
{
    /**
     * {@inheritdoc}
     */
    public function assert($input): void
    {
        if (null === $input) {
            return;
        }

        parent::assert($input);
    }

    /**
     * {@inheritdoc}
     */
    public function check($input): void
    {
        if (null === $input) {
            return;
        }

        parent::check($input);
    }

    /**
     * {@inheritdoc}
     */
    public function validate($input): bool
    {
        if (null === $input) {
            return true;
        }

        return parent::validate($input);
    }
}
