<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Transformers;

use function array_key_exists;
use function trigger_error;

use const E_USER_DEPRECATED;

final class DeprecatedKey implements Transformer
{
    public function __construct(
        private readonly Transformer $next
    ) {
    }

    public function transform(RuleSpec $ruleSpec): RuleSpec
    {
        if ($ruleSpec->name !== 'key') {
            return $this->next->transform($ruleSpec);
        }

        $name = $ruleSpec->name;
        $arguments = $ruleSpec->arguments;

        if (!array_key_exists(1, $arguments)) {
            trigger_error(
                'Calling key() without a second parameter has been deprecated, ' .
                'and will be not be allowed in the next major version. Use keyExists() instead.',
                E_USER_DEPRECATED
            );
            $name = 'keyExists';
        } elseif (array_key_exists(2, $arguments)) {
            $name = $arguments[2] ? 'key' : 'keyOptional';
            unset($arguments[2]);

            if ($name === 'keyOptional') {
                trigger_error(
                    'Calling key() with a third parameter has been deprecated, ' .
                    'and will be not be allowed in the next major version. Use keyOptional() instead.',
                    E_USER_DEPRECATED
                );
            }

            if ($name === 'key') {
                trigger_error(
                    'Calling key() with a third parameter has been deprecated, ' .
                    'and will be not be allowed in the next major version. Use key() without the third parameter.',
                    E_USER_DEPRECATED
                );
            }
        }

        return new RuleSpec($name, $arguments);
    }
}
