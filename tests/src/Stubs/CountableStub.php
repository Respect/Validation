<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Emmerson Siqueira <emmersonsiqueira@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
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
