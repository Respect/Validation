<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Test\Stubs;

use Respect\Validation\Validators as Rule;

final class WithRelativeDate
{
    public function __construct(
        #[Rule\DateTimeDiff('years', new Rule\Equals(7))]
        public string $since,
    ) {
    }
}
