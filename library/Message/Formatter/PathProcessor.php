<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Message\Formatter;

use Respect\Validation\Result;

trait PathProcessor
{
    private function overwritePath(Result $parent, Result $child): Result
    {
        if ($parent->path !== null && $child->path !== null && $child->path !== $parent->path) {
            return $child->withPath($parent->path);
        }

        if ($parent->path !== null && $child->path === null) {
            return $child->withPath($parent->path);
        }

        return $child;
    }
}
