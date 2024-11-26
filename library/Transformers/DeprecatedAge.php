<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Transformers;

use Respect\Validation\Rules\GreaterThanOrEqual;
use Respect\Validation\Rules\LessThanOrEqual;

use function in_array;
use function sprintf;
use function trigger_error;

use const E_USER_DEPRECATED;

final class DeprecatedAge implements Transformer
{
    public function __construct(
        private readonly Transformer $next
    ) {
    }

    public function transform(RuleSpec $ruleSpec): RuleSpec
    {
        if (!in_array($ruleSpec->name, ['minAge', 'maxAge'])) {
            return $this->next->transform($ruleSpec);
        }

        trigger_error(
            sprintf(
                'The %s() rule has been deprecated and will be removed in the next major version. ' .
                'Use dateTimeDiff() instead.',
                $ruleSpec->name
            ),
            E_USER_DEPRECATED,
        );

        if ($ruleSpec->name === 'minAge') {
            return new RuleSpec('dateTimeDiff', [
                'years',
                new GreaterThanOrEqual($ruleSpec->arguments[0]),
            ]);
        }

        return new RuleSpec('dateTimeDiff', [
            'years',
            new LessThanOrEqual($ruleSpec->arguments[0]),
        ]);
    }
}
