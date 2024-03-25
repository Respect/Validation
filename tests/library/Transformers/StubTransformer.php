<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Test\Transformers;

use Respect\Validation\Transformers\RuleSpec;
use Respect\Validation\Transformers\Transformer;

final class StubTransformer implements Transformer
{
    public function transform(RuleSpec $ruleSpec): RuleSpec
    {
        return $ruleSpec;
    }
}
