<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Test\Stubs;

final class WithOverlappingUnionTypeNested
{
    public function __construct(
        public NestedWithAttributes|Nested $address,
    ) {
    }
}
