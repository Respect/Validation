<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Test\Functions;

use NonExistentClass123;

function functionWithNonExistentType(NonExistentClass123 $x): bool
{
    return true;
}
