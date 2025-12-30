<?php

declare(strict_types=1);

namespace Respect\Validation\Transformers;

interface Transformer
{
    public function transform(RuleSpec $ruleSpec): RuleSpec;
}
