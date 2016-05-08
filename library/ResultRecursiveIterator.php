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

namespace Respect\Validation;

use RecursiveIterator;

final class ResultRecursiveIterator extends ResultIterator implements RecursiveIterator
{
    public function hasChildren(): bool
    {
        $current = $this->current();
        if (null === $current) {
            return false;
        }

        return $current->hasChildren();
    }

    public function getChildren(): ? self
    {
        $current = $this->current();
        if (null === $current) {
            return null;
        }

        return new self($current);
    }
}
