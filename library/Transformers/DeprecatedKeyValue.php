<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Transformers;

use Respect\Validation\Rules\AlwaysInvalid;
use Respect\Validation\Rules\Key;
use Respect\Validation\Rules\KeyExists;
use Respect\Validation\Rules\Lazy;
use Respect\Validation\Validator;
use Throwable;

use function sprintf;
use function trigger_error;

use const E_USER_DEPRECATED;

final class DeprecatedKeyValue implements Transformer
{
    public function __construct(
        private readonly Transformer $next
    ) {
    }

    public function transform(RuleSpec $ruleSpec): RuleSpec
    {
        if ($ruleSpec->name !== 'keyValue') {
            return $this->next->transform($ruleSpec);
        }

        trigger_error(
            'The keyValue() rule has been deprecated and will be removed in the next major version. ' .
            'Use nested lazy() instead.',
            E_USER_DEPRECATED
        );

        [$comparedKey, $ruleName, $baseKey] = $ruleSpec->arguments;

        return new RuleSpec('circuit', [
            new KeyExists($comparedKey),
            new KeyExists($baseKey),
            new Lazy(
                static function ($input) use ($comparedKey, $ruleName, $baseKey) {
                    try {
                        return new Key($comparedKey, Validator::__callStatic($ruleName, [$input[$baseKey]]));
                    } catch (Throwable) {
                        $rule = new AlwaysInvalid();
                        $rule->setName($comparedKey);
                        $rule->setTemplate(sprintf(
                            '%s must be valid to validate %s',
                            $baseKey,
                            $comparedKey,
                        ));

                        return $rule;
                    }
                }
            ),
        ]);
    }
}
