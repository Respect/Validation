<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Transformers\Deprecated;

use Respect\Validation\Message\Placeholder\Quoted;
use Respect\Validation\Rules\AlwaysInvalid;
use Respect\Validation\Rules\Key;
use Respect\Validation\Rules\KeyExists;
use Respect\Validation\Rules\Lazy;
use Respect\Validation\Rules\Templated;
use Respect\Validation\Transformers\RuleSpec;
use Respect\Validation\Transformers\Transformer;
use Respect\Validation\Validator;
use Throwable;

use function trigger_error;

use const E_USER_DEPRECATED;

final class KeyValueRule implements Transformer
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
                        return new Templated(
                            new AlwaysInvalid(),
                            '{{baseKey}} must be valid to validate {{comparedKey}}',
                            ['comparedKey' => Quoted::fromPath($comparedKey), 'baseKey' => Quoted::fromPath($baseKey)]
                        );
                    }
                }
            ),
        ]);
    }
}
