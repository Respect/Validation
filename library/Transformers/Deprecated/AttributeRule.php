<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Transformers\Deprecated;

use Respect\Validation\Transformers\RuleSpec;
use Respect\Validation\Transformers\Transformer;

use function array_key_exists;
use function trigger_error;

use const E_USER_DEPRECATED;

final class AttributeRule implements Transformer
{
    public function __construct(
        private readonly Transformer $next
    ) {
    }

    public function transform(RuleSpec $ruleSpec): RuleSpec
    {
        if ($ruleSpec->name !== 'attribute') {
            return $this->next->transform($ruleSpec);
        }

        $arguments = $ruleSpec->arguments;
        $firstMessage = 'The attribute() rule has been deprecated and will be removed in the next major version.';
        if (!array_key_exists(1, $arguments)) {
            trigger_error(
                $firstMessage . ' Use propertyExists() instead.',
                E_USER_DEPRECATED
            );
            $name = 'propertyExists';
        } elseif (array_key_exists(2, $arguments)) {
            $name = $arguments[2] ? 'property' : 'propertyOptional';
            unset($arguments[2]);

            if ($name === 'propertyOptional') {
                trigger_error(
                    $firstMessage . ' Use propertyOptional() instead.',
                    E_USER_DEPRECATED
                );
            }

            if ($name === 'property') {
                trigger_error(
                    $firstMessage . ' Use property() instead.',
                    E_USER_DEPRECATED
                );
            }
        } else {
            trigger_error(
                $firstMessage . ' Use property() instead.',
                E_USER_DEPRECATED
            );
            $name = 'property';
        }

        return new RuleSpec($name, $arguments);
    }
}
