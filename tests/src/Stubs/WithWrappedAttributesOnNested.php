<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Test\Stubs;

use Respect\Validation\Validators as Rule;

final class WithWrappedAttributesOnNested
{
    public function __construct(
        #[Rule\NullOr(new Rule\Attributes())]
        public NestedAddress|null $address = null,
    ) {
    }
}
