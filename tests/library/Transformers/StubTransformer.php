<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
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
