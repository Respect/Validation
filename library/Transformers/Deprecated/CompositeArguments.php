<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Transformers\Deprecated;

use Respect\Validation\Rules\AlwaysInvalid;
use Respect\Validation\Rules\AlwaysValid;
use Respect\Validation\Transformers\RuleSpec;
use Respect\Validation\Transformers\Transformer;

use function count;
use function in_array;
use function sprintf;
use function trigger_error;

use const E_USER_DEPRECATED;

final class CompositeArguments implements Transformer
{
    public function __construct(
        private readonly Transformer $next
    ) {
    }

    public function transform(RuleSpec $ruleSpec): RuleSpec
    {
        if (!in_array($ruleSpec->name, ['allOf', 'anyOf', 'noneOf', 'oneOf'])) {
            return $this->next->transform($ruleSpec);
        }

        $arguments = $ruleSpec->arguments;
        if (count($arguments) >= 2) {
            return $this->next->transform($ruleSpec);
        }

        if (count($arguments) === 0) {
            trigger_error(
                sprintf(
                    'Calling %s() without any arguments has been deprecated, ' .
                    'and will be not be allowed in the next major version. Use it with at least 2 arguments.',
                    $ruleSpec->name
                ),
                E_USER_DEPRECATED
            );

            return match ($ruleSpec->name) {
                'allOf', 'noneOf' => new RuleSpec('alwaysValid'),
                'anyOf', 'oneOf' => new RuleSpec('alwaysInvalid'),
            };
        }

        trigger_error(
            sprintf(
                'Calling %s() with a single argument has been deprecated, ' .
                'and will be not be allowed in the next major version. Use it with at least 2 arguments.',
                $ruleSpec->name
            ),
            E_USER_DEPRECATED
        );

        $arguments[] = match ($ruleSpec->name) {
            'allOf' => new AlwaysValid(),
            'anyOf', 'noneOf', 'oneOf' => new AlwaysInvalid(),
        };

        return new RuleSpec($ruleSpec->name, $arguments);
    }
}
