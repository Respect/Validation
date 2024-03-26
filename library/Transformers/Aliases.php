<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Transformers;

use function array_keys;
use function in_array;

final class Aliases implements Transformer
{
    private const ALIASES = [
        'nullable' => 'nullOr',
        'optional' => 'undefOr',
    ];

    public function __construct(
        private readonly Transformer $next
    ) {
    }

    public function transform(RuleSpec $ruleSpec): RuleSpec
    {
        if (!in_array($ruleSpec->name, array_keys(self::ALIASES), true)) {
            return $this->next->transform($ruleSpec);
        }

        return new RuleSpec(self::ALIASES[$ruleSpec->name], $ruleSpec->arguments);
    }
}
