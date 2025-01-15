<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Transformers\Deprecated;

use Respect\Validation\Rule;
use Respect\Validation\Transformers\RuleSpec;
use Respect\Validation\Transformers\Transformer;

use function in_array;
use function sprintf;
use function trigger_error;

use const E_USER_DEPRECATED;

final class MinAndMaxArguments implements Transformer
{
    public function __construct(
        private readonly Transformer $next
    ) {
    }

    public function transform(RuleSpec $ruleSpec): RuleSpec
    {
        if (!in_array($ruleSpec->name, ['min', 'max'])) {
            return $this->next->transform($ruleSpec);
        }

        if (isset($ruleSpec->arguments[0]) && $ruleSpec->arguments[0] instanceof Rule) {
            return $this->next->transform($ruleSpec);
        }

        $name = match ($ruleSpec->name) {
            'min' => 'greaterThanOrEqual',
            'max' => 'lessThanOrEqual',
        };

        trigger_error(
            sprintf(
                'Calling %s() with a scalar value has been deprecated, ' .
                'and will be not allows in the next major version. Use %s() instead.',
                $ruleSpec->name,
                $name,
            ),
            E_USER_DEPRECATED
        );

        return new RuleSpec($name, $ruleSpec->arguments);
    }
}
