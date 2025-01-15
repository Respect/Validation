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

use function Respect\Stringifier\stringify;
use function sprintf;
use function trigger_error;

use const E_USER_DEPRECATED;

final class LengthArguments implements Transformer
{
    public function __construct(
        private readonly Transformer $next
    ) {
    }

    public function transform(RuleSpec $ruleSpec): RuleSpec
    {
        if ($ruleSpec->name !== 'length' || $ruleSpec->arguments === []) {
            return $this->next->transform($ruleSpec);
        }

        if (isset($ruleSpec->arguments[0]) && $ruleSpec->arguments[0] instanceof Rule) {
            return $this->next->transform($ruleSpec);
        }

        $minValue = $ruleSpec->arguments[0] ?? null;
        $maxValue = $ruleSpec->arguments[1] ?? null;
        $inclusive = $ruleSpec->arguments[2] ?? true;

        $message = 'Calling length() with scalar values has been deprecated, ' .
            'and will not be allowed in the next major version. ';

        if (!$minValue) {
            $name = $inclusive ? 'LessThanOrEqual' : 'LessThan';
            trigger_error(
                sprintf($message . 'Use length%s(%s) instead.', $name, stringify($maxValue)),
                E_USER_DEPRECATED
            );

            return new RuleSpec($name, [$maxValue], new RuleSpec('length'));
        }

        if (!$maxValue) {
            $name = $inclusive ? 'GreaterThanOrEqual' : 'GreaterThan';
            trigger_error(
                sprintf($message . 'Use length%s(%s) instead.', $name, stringify($minValue)),
                E_USER_DEPRECATED
            );

            return new RuleSpec($name, [$minValue], new RuleSpec('length'));
        }

        if ($minValue === $maxValue) {
            trigger_error(
                sprintf($message . 'Use lengthEquals(%s) instead.', stringify($minValue)),
                E_USER_DEPRECATED
            );

            return new RuleSpec('equals', [$minValue], new RuleSpec('length'));
        }

        $name = $inclusive ? 'Between' : 'BetweenExclusive';
        trigger_error(
            sprintf($message . 'Use length%s(%s, %s) instead.', $name, stringify($minValue), stringify($maxValue)),
            E_USER_DEPRECATED
        );

        return new RuleSpec($name, [$minValue, $maxValue], new RuleSpec('length'));
    }
}
