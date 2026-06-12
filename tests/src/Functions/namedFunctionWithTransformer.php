<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Test\Functions;

use Respect\Validation\Transformers\Transformer;

function namedFunctionWithTransformer(string $name, Transformer $transformer): bool
{
    return true;
}
