<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Test\Stubs;

use Countable;

final class CountableStub implements Countable
{
    /** @param positive-int $value */
    public function __construct(
        private readonly int $value,
    ) {
    }

    /** @return positive-int */
    public function count(): int
    {
        return $this->value;
    }
}
