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
    public function __construct(
        private readonly int $value
    ) {
    }

    public function count(): int
    {
        return $this->value;
    }
}
