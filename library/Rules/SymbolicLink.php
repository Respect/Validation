<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use SplFileInfo;

use function is_link;
use function is_string;

/**
 * Validates if the given input is a symbolic link.
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Gus Antoniassi <gus.antoniassi@gmail.com>
 */
final class SymbolicLink extends AbstractRule
{
    /**
     * {@inheritDoc}
     */
    public function validate($input): bool
    {
        if ($input instanceof SplFileInfo) {
            return $input->isLink();
        }

        return is_string($input) && is_link($input);
    }
}
