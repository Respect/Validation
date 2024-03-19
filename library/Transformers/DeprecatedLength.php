<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Transformers;

use Respect\Validation\Rules\Between;
use Respect\Validation\Rules\BetweenExclusive;
use Respect\Validation\Rules\Equals;
use Respect\Validation\Rules\GreaterThan;
use Respect\Validation\Rules\GreaterThanOrEqual;
use Respect\Validation\Rules\LessThan;
use Respect\Validation\Rules\LessThanOrEqual;
use Respect\Validation\Validatable;

use function Respect\Stringifier\stringify;
use function sprintf;
use function trigger_error;

use const E_USER_DEPRECATED;

final class DeprecatedLength implements Transformer
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

        if (isset($ruleSpec->arguments[0]) && $ruleSpec->arguments[0] instanceof Validatable) {
            return $this->next->transform($ruleSpec);
        }

        $minValue = $ruleSpec->arguments[0] ?? null;
        $maxValue = $ruleSpec->arguments[1] ?? null;
        $inclusive = $ruleSpec->arguments[2] ?? true;

        $message = 'Calling length() with scalar values has been deprecated, ' .
            'and will not be allowed in the next major version. ';

        if (!$minValue) {
            trigger_error(
                sprintf(
                    $message . 'Use length(%s(%s)) instead.',
                    $inclusive ? 'lessThanOrEqual' : 'lessThan',
                    stringify($maxValue),
                ),
                E_USER_DEPRECATED
            );

            return new RuleSpec(
                'length',
                [$inclusive ? new LessThanOrEqual($maxValue) : new LessThan($maxValue)]
            );
        }

        if (!$maxValue) {
            trigger_error(
                sprintf(
                    $message . 'Use length(%s(%s)) instead.',
                    $inclusive ? 'greaterThanOrEqual' : 'greaterThan',
                    stringify($minValue),
                ),
                E_USER_DEPRECATED
            );

            return new RuleSpec(
                'length',
                [$inclusive ? new GreaterThanOrEqual($minValue) : new GreaterThan($minValue)]
            );
        }

        if ($minValue === $maxValue) {
            trigger_error(
                sprintf($message . 'Use length(equals(%s)) instead.', stringify($minValue)),
                E_USER_DEPRECATED
            );

            return new RuleSpec('length', [new Equals($minValue)]);
        }

        trigger_error(
            sprintf(
                $message . 'Use length(%s(%s, %s)) instead.',
                $inclusive ? 'between' : 'betweenExclusive',
                stringify($minValue),
                stringify($maxValue),
            ),
            E_USER_DEPRECATED
        );

        return new RuleSpec(
            'length',
            [$inclusive ? new Between($minValue, $maxValue) : new BetweenExclusive($minValue, $maxValue)]
        );
    }
}
