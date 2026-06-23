<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Test\Stubs;

use Respect\Validation\Validators as Rule;

final class NestedValidated implements Nested
{
    public function __construct(
        #[Rule\StringType]
        #[Rule\Not(new Rule\Undef())]
        public string $value,
    ) {
    }
}
