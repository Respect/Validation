<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Test\Transformers;

use Respect\Validation\Transformers\Transformer;
use Respect\Validation\Transformers\ValidatorSpec;

final class StubTransformer implements Transformer
{
    public function transform(ValidatorSpec $validatorSpec): ValidatorSpec
    {
        return $validatorSpec;
    }
}
